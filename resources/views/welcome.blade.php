<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .results-table, .results-table th, .results-table tr, .results-table td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body  onload="document.form1.komis_vid_edin.options[1].text = document.form1.valuta.options[document.form1.valuta.options.selectedIndex].text ;
				document.form1.komis_vid_ege.options[2].text = document.form1.valuta.options[document.form1.valuta.options.selectedIndex].text">

    <div class="flex-center position-ref full-height">
            <form action="{{ url('/') }}" method="post" id="form1" name="form1">
                {{ csrf_field() }}
                <table width="603" border="0" cellpadding="5" cellspacing="0" class="style3">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="7%" align="center"><img src="/Picts/znak1.gif" alt="" width="36" height="42"></td>
                                            <td width="93%">
                                                <div align="center"><strong>Параметры кредита </strong></div>
                                                <div align="left" class="style2">Настройки калькулятора позволяют задавать дополнительные параметры кредита, но нужно учитывать, что в каждом банке есть свои особенности расчетов </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr size="1" style="color:#FDE293"></td>
                        </tr>
                        <tr>
                            <td width="235" align="left"><strong>Сумма кредита:</strong></td>
                            <td width="348" align="left">
                                <label>
                                    <input name="summa" type="text" id="summa" style="background:#FDE293 ; color:#000000 ;font-size:14px" value="{{ (old('summa')) ? old('summa'):'300000' }}" size="20" maxlength="20">
                                </label>
                                <label>
                                    <select name="valuta" id="valuta" style="background:#FDE293; color:#000000 ;font-size:14px" onchange="document.form1.komis_vid_edin.options[1].text = document.form1.valuta.options[document.form1.valuta.options.selectedIndex].text ;
                        document.form1.komis_vid_ege.options[2].text = document.form1.valuta.options[document.form1.valuta.options.selectedIndex].text ">
                                        <option selected value="1">руб.</option>
                                        <option @if(old('valuta')=='2') selected @endif value="2">$</option>
                                        <option @if(old('valuta')=='3') selected @endif value="3">€</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Срок кредита:</strong></td>
                            <td align="left"><label>
                                    <input name="period" type="number" id="period" value="{{ ( old('period') ) ? old('period') : '24' }}" size="20" style="background:#FDE293; color:#000000 ;font-size:14px">
                                </label>
                                <label>
                                    <select name="permesgod" id="permesgod" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="1">мес.</option>
                                        <option @if(old('permesgod')=='12') selected @endif value="12">лет</option>
                                    </select>
                                </label></td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Процентная ставка:</strong></td>
                            <td align="left">
                                <label>
                                    <input name="stavka" type="text" id="stavka" value="{{ ( old('stavka') ? old('stavka') : '18,5' ) }}" size="20" maxlength="20" style="background:#FDE293;font-size:14px">
                                </label>
                                <label>
                                    <select name="stavmesgod" id="stavmesgod" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="12">%в год</option>
                                        <option @if(old('stavmesgod')=='1') selected @endif value="1">%в мес</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="height:1px"></div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div align="center" class="style2">Дополнительные параметры</div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="height:1px"></div></td>
                        </tr>
                        <tr>
                            <td align="left"><span title="за оформление, за выдачу кредита, за открытие счета и др."><strong>Единовременные комиссии:<sup>?</sup></strong></span></td>
                            <td align="left">
                                <label>
                                    <input name="komis_edin" type="text" id="komis_edin" style="background:#FDE293 ; color:#000000 ;font-size:14px" value="{{ ( old('komis_edin') ) ? old('komis_edin') : '0' }}">
                                </label>
                                <label>
                                    <select name="komis_vid_edin" id="komis_vid_edin" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="2">% от  суммы кредита</option>
                                        <option @if(old('komis_vid_edin')=='1') selected @endif value="1">руб.</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><span title="за ведение счета, за пользование кредитом и др."><strong>Ежемесячные комиссии:<sup>?</sup></strong></span></td>
                            <td align="left">
                                <label>
                                    <input name="komis_ege" type="text" id="komis_ege" style="background:#FDE293; color:#000000 ;font-size:14px" value="{{ ( old('komis_ege') ) ? old('komis_ege') : '0' }}">
                                </label>
                                <label>
                                    <select name="komis_vid_ege" id="komis_vid_ege" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="2">% от суммы кредита</option>
                                        <option @if(old('komis_vid_ege')=='3') selected @endif value="3">% от остатка долга</option>
                                        <option @if(old('komis_vid_ege')=='1') selected @endif value="1">руб.</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><span title="Если платеж каждый месяц одинаковый, выберите - аннуитетный, если уменьшающийся то выберите - дифференцированный"><strong>Вид платежа:<sup>?</sup></strong></span></td>
                            <td align="left"><label>
                                    <select name="platezh_vid" id="platezh_vid" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="1"> аннуитетный </option>
                                        <option @if(old('platezh_vid')=='2') selected @endif value="2">дифференцированный</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Начало выплат:</strong></td>
                            <td align="left">
                                <label>
                                    <select name="messtart" id="messtart" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="1">Январь</option>
                                        <option @if( old('messtart') == '2' ) selected @endif value="2">Февраль</option>
                                        <option @if( old('messtart') == '3' ) selected @endif value="3">Март</option>
                                        <option @if( old('messtart') == '4' ) selected @endif value="4">Апрель</option>
                                        <option @if( old('messtart') == '5' ) selected @endif value="5">Май</option>
                                        <option @if( old('messtart') == '6' ) selected @endif value="6">Июнь</option>
                                        <option @if( old('messtart') == '7' ) selected @endif value="7">Июль</option>
                                        <option @if( old('messtart') == '8' ) selected @endif value="8">Август</option>
                                        <option @if( old('messtart') == '9' ) selected @endif value="9">Сентябрь</option>
                                        <option @if( old('messtart') == '10' ) selected @endif value="10">Октябрь</option>
                                        <option @if( old('messtart') == '11' ) selected @endif value="11">Ноябрь</option>
                                        <option @if( old('messtart') == '12' ) selected @endif value="12">Декабрь</option>
                                    </select>
                                </label>
                                <label>
                                    <select name="godstart" id="godstart" style="background:#FDE293; color:#000000 ;font-size:14px">
                                        <option selected value="2006">2006</option>
                                        @for($i=2007; $i<=2025; $i++)
                                            <option @if( old('godstart') == $i ) selected @endif value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><div style=" width:200"></div></td>
                            <td><div style=" width:330"></div></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left">
                                <label>
                                    <input type="submit" name="submit" value="         Рассчитать         " style="height:30px; font-weight: bold;">
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        @if( count( $payment_sums ) )
            <table class="results-table" align="center">
                <tr>
                    <th>№ платежа</th>
                    <th>Дата платежа</th>
                    <th>Сумма платежа</th>
                    <th>Основной долг</th>
                    <th>Начисленные проценты</th>
                    <th>Ежемесячные комиссии</th>
                    <th>Остаток задолженности</th>
                </tr>
                @for( $i=1; $i<=count( $payment_sums ); $i++ )
                    <tr>
                        <td>{{ $i }}</td>
                        <td>@lang('months.'.$date_months[$i]), {{ $date_years[$i] }}</td>
                        <td>{{ sprintf("%.2f", $payment_sums[$i]) }}</td>
                        <td>{{ sprintf("%.2f", $main_debts[$i]) }}</td>
                        <td>{{ sprintf("%.2f", $percents[$i]) }}</td>
                        <td>{{ sprintf("%.2f", $monthly_commissions[$i]) }}</td>
                        <td>{{ sprintf("%.2f", $left_debts[$i]) }}</td>
                    </tr>
                @endfor
                <tr>
                    <td>Итого по кредиту</td>
                    <td></td>
                    <td>{{ sprintf("%.2f", $total_sum) }}</td>
                    <td>{{ sprintf("%.2f", array_sum( $main_debts ) ) }}</td>
                    <td>{{ sprintf("%.2f", array_sum( $percents ) ) }}</td>
                    <td>{{ sprintf("%.2f", array_sum( $monthly_commissions ) ) }}</td>
                    <td></td>
                </tr>
            </table>
        @endif
        <br/>
        <br/>
        <br/>
    </body>
</html>
