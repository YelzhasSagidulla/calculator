<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        /**
         * Result arrays
         */
        $total_sum = 0;
        $total_monthly_commissions = 0;
        $payment_sums = [];
        $percents = [];
        $main_debts = [];
        $left_debts = [];
        $monthly_commissions = [];
        $date_months = [];
        $date_years = [];

        if( isset($request->submit) )
        {
            $request->flash();

            /**
             * Pomenyaem zapyatye na tochki
             */
            $request->summa = str_replace(',', '.', $request->summa);
            $request->stavka = str_replace(',', '.', $request->stavka);
            $request->komis_edin = str_replace(',', '.', $request->komis_edin);
            $request->komis_ege = str_replace(',', '.', $request->komis_ege);

            /**
             * Summa
             */
            $sum = $request->summa;

            /**
             * Edinovremennye komissii
             */
            if($request->komis_vid_edin == 2)
                $one_time_commission = $request->komis_edin; //
            else
                $one_time_commission = $sum * $request->komis_edin / 100; //

            /**
             * Srok kredita
             */
            if( $request->permesgod == '1' )
                $months = $request->period; //months
            else
                $months = $request->period * 12; //year

            /**
             * Procentnaia stavka
             */
            if( $request->stavmesgod == 12 )
                $monthly_percent = ( floatval($request->stavka)/100 )/12; //year
            else
                $monthly_percent = floatval($request->stavka)/100; //months

            /**
             * Ezhemesyachnye komissii
             */
            if($request->komis_vid_ege == 2) //procent ot summy
                $monthly_commission = $sum * $request->komis_ege / 100;
            else if($request->komis_vid_ege == 1) //
                $monthly_commission = $request->komis_ege;

            /**
             * Raschet po vidu platezha
             */
            if( $request->platezh_vid == 1 ) // annuity
            {
                $annuity_payment = $sum * ( $monthly_percent + $monthly_percent / ( pow(1+$monthly_percent, $months) - 1 ) );

                //cycle po vsem periodam
                for( $i = 1; $i <= $months; $i++ )
                {
                    $payment_sums[$i] = $annuity_payment;
                    $percents[$i] = $sum * $monthly_percent;
                    $main_debts[$i] = $payment_sums[$i] - $percents[$i];
                    $left_debts[$i] = $sum + $sum * $monthly_percent - $annuity_payment;

                    //date
                    if($i==1)
                    {
                        $date_years[$i] = $request->godstart;
                    }
                    else
                    {
                        $request->messtart++;

                        if( $request->messtart > 12 )
                        {
                            $request->messtart %= 12;
                            $date_years[$i] = $date_years[$i-1] + 1;
                        }
                        else
                        {
                            $date_years[$i] = $date_years[$i-1];
                        }
                    }

                    $date_months[$i] = \DateTime::createFromFormat('!m', $request->messtart)->format('F');

                    /*Ezhemesyachnye komissii*/
                    if($request->komis_vid_ege == 3)
                        $monthly_commission = $left_debts[$i] * $request->komis_ege / 100;

                    $monthly_commissions[$i] = $monthly_commission;

                    //last month debt zero
                    if( $i==$months )
                    {
                        $left_debts[$i] = 0;

                        if($request->komis_vid_ege == 3)
                            $monthly_commissions[$i] = 0;
                    }

                    $sum = $left_debts[$i];

                    $total_sum += $payment_sums[$i];

                    $total_monthly_commissions += $monthly_commissions[$i];
                }
                //
            }
            else // differentiated
            {
                $main_debt = $sum/$months;

                //cycle po vsem periodam
                for( $i = 1; $i <= $months; $i++ )
                {
                    $main_debts[$i] = $main_debt; //
                    $percents[$i] = $sum * $monthly_percent;
                    $payment_sums[$i] = $main_debts[$i] + $percents[$i];
                    $left_debts[$i] = $sum + $sum * $monthly_percent - $payment_sums[$i];

                    //date
                    if($i==1)
                    {
                        $date_years[$i] = $request->godstart;
                    }
                    else
                    {
                        $request->messtart++;

                        if( $request->messtart > 12 )
                        {
                            $request->messtart %= 12;
                            $date_years[$i] = $date_years[$i-1] + 1;
                        }
                        else
                        {
                            $date_years[$i] = $date_years[$i-1];
                        }
                    }

                    $date_months[$i] = \DateTime::createFromFormat('!m', $request->messtart)->format('F');

                    /*Ezhemesyachnye komissii*/
                    if($request->komis_vid_ege == 3)
                        $monthly_commission = $left_debts[$i] * $request->komis_ege / 100;

                    $monthly_commissions[$i] = $monthly_commission;

                    //last month debt zero
                    if( $i==$months )
                    {
                        $left_debts[$i] = 0;

                        if($request->komis_vid_ege == 3)
                            $monthly_commissions[$i] = 0;
                    }

                    $sum = $left_debts[$i];

                    $total_sum += $payment_sums[$i];

                    $total_monthly_commissions += $monthly_commissions[$i];
                }
                //
            }

            $total_sum += $one_time_commission + $total_monthly_commissions;
        }

        return view('welcome', compact('payment_sums', 'percents', 'main_debts',
            'left_debts', 'monthly_commissions', 'total_sum', 'date_months', 'date_years'));
    }
}
