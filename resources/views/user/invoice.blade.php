
@extends('layout.user')

@section('content')

    <div class="col-lg-12 col-sm-12 content_user paddingzero col-xs-12">
        <div class="col-md-12 first_div">
            <div class="first_div_inner">
                <div class="col-md-3 paddingzero col-xs-12">
                    <h3 class="colorlightblue">Invoices</h3>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="btn-group inline pull-right">
                        <button type="button" class="btn btn-trans btn-lg choosebg cursorhand" data-toggle="modal" data-target="#Choose-date">Date&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">From date - To date</span></button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="usertable">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Billing Period</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Download</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @forelse($data['main'] as $dt)
                <tr>


                            <td>{{ date('d/m/y', strtotime($dt['start_time'])) }} - {{ date('d/m/y', strtotime($dt['end_time'])) }}</td>
                            <td>$ {{ round($dt['amount']*100)/100 }}</td>
                            <td class="{{ $dt['status']=='OVERDUE'?'redtxt':($dt['status']=='DUE'?'yellowtxt':'greentxt') }}">
                                <span class="widthspan">{{ $dt['status'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                @if($dt['status'] !='PAID')
                                    <button type="button" class="btn btn-invoice cursorhand" data-toggle="modal" data-target="#Pay_Now_{{ $dt['id'] }}" data-backdrop="static" data-keyboard="false">PAY NOW</button>
                                @endif
                            </td>
                            <td>{{ $dt['pay_url'] }}</td>
                            <td><img class="dashboardmenu_icons cursorhand" src="images/download.png"></td>


                     </tr>
                <div id="Pay_Now_{{ $dt['id'] }}" class="modal fade Pay_Now" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <form role="form" action="pay_now" method="POST" name="myForm" id="myForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" class="text" name="invoice_id" value="{{$dt->id}}"/>
                            <div class="modal-content">
                                <div class="modal-header modalbg poppay">
                                    <h4 class="modal-title modalheader">Pay Now</h4>
                                </div>
                                <div class="modal-body modalbgwhite paddingmodalcomplete">
                                    <div class="col-md-12 col-xs-12 modalbodypaddingdropdown">
                                        <div class="col-md-12 col-xs-12 borderbottomdrop paddingzero">
                                            <input class="form-control text-center colorblack font34 placebig" type="number" name="card_number" value="{{ $data['card_number'] }}"> </div>
                                        <div class="col-md-12 col-xs-12 margintop paddingzero">
                                            <div class="col-md-6 col-xs-12">
                                                <h4 class="colorlightblue margintop">Use Credit Card on File</h4></div>
                                            <div class="col-md-6 col-xs-12">
                                                <button type="button" class="btn btn-trans btn-lg choosecard cursorhand pull-right" data-toggle="modal" data-target="#Different_card_{{ $dt['id'] }}" data-backdrop="static" data-keyboard="false" data-dismiss="modal">USE DIFFERENT CARD</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal-footer footerbordertop">
                                <div class="col-md-6">
                                    <h3 class="colorlightblue pull-left font34 mt15">Total Price:&nbsp;&nbsp;&nbsp;<span class="greentxt">${{ round($dt['amount']*100)/100 }}</span></h3></div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn buttongreen pull-right">PAY NOW</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--  Different_card  -->
                <div id="Different_card_{{ $dt['id'] }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <form role="form" action="save_pay" method="POST" name="myForm" id="myForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" class="text" name="invoice_id" value="{{$dt->id}}"/>
                            <div class="modal-content">
                                <div class="modal-header modalbg popcardplus">
                                    <h4 class="modal-title modalheader colorpay">Pay Now<span class="colorwhite"> > Different Card</span></h4>
                                </div>
                                <div class="modal-body modalbgwhite paddingmodalcomplete">
                                    <div class="col-md-12 col-xs-12 modalbodypaddingdropdown">
                                        <div class="col-md-12 col-xs-12 paddingzero">
                                            <div class="col-md-5 col-xs-12 marginsmtop">
                                                <div class="borderbottomdrop">
                                                    <h4 class="colorlightblue">Card Number</h4>
                                                    <input class="form-control colorblack" type="number" name = "card_number" placeholder="1234 - 5678 - 9012 - 3456">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12 marginsmtop">
                                                <div class="borderbottomdrop" id="dropbtnselect">
                                                    <h4 class="colorlightblue">Expires</h4>
                                                    <select class="selectpicker width49 pull-left" name="expires1">
                                                        <option>00</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                    </select>
                                                    <select class="selectpicker width49 pull-left" name="expires2">
                                                        <option>00</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12 marginsmtop">
                                                <div class="borderbottomdrop">
                                                    <h4 class="colorlightblue">Security Code</h4>
                                                    <input class="form-control colorblack quebg paddingright15" type="number" name= "security_code" placeholder="0000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 paddingzero margintop30">
                                            <div class="col-md-2 col-xs-12">
                                                <div class="borderbottomdrop" id="dropbtnselect">
                                                    <h4 class="colorlightblue">Salutation</h4>
                                                    <select class="selectpicker width100 pull-left" name="salutation">
                                                        <option>Mr.</option>
                                                        <option>Mrs.</option>
                                                        <option>Ms</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-xs-12 marginsmtop">
                                                <div class="borderbottomdrop" id="dropbtnselect">
                                                    <h4 class="colorlightblue">First Name</h4>
                                                    <input class="form-control colorblack" type="text" name="firstname" placeholder="First Name">
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-xs-12 marginsmtop">
                                                <div class="borderbottomdrop">
                                                    <h4 class="colorlightblue">Last Name</h4>
                                                    <input class="form-control colorblack" type="text" name="lastname" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal-footer footerbordertop">
                                    <div class="col-md-6">
                                        <h3 class="colorlightblue pull-left font34 mt15">Total Price:&nbsp;&nbsp;&nbsp;<span class="greentxt">$35.50</span></h3></div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn buttongreen pull-right" >SAVE CARD & PAY NOW</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                @empty
                    <tr><td>No Invoice</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <!--  pay now  -->


    <input type="hidden" id="receive_location" value=" > Invoices" />
    <input type="hidden" id="receive_username" value="{{$data['username']}}" />
    <!--  Choose date  -->
    <div id="Choose-date" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="invoice_during" method="post" name="frm_date">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="modal-header modalbg popchoose">
                        <h4 class="modal-title modalheader">Choose Date</h4>
                    </div>
                    <div class="modal-body modalbgwhite paddingmodalcomplete">
                        <div class="col-md-12 modalbodypaddingdropdown">
                            <div class="col-md-6 borderbottomdrop paddingzero width49">
                                <div class="col-md-4">
                                    <label class="colordropdown_reset">Date From</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control bgcalinput" type="text" id="from" name="from" readonly='true'>
                                </div>
                            </div>
                            <div class="col-md-6 borderbottomdrop paddingzero">
                                <div class="col-md-4">
                                    <label class="colordropdown_reset">Date To</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control bgcalinput" type="text" id="to" name="to" readonly='true'>
                                </div>
                            </div>
                            <h4 class="paddd col-md-12">NOTE: We only store 30 days of transactions. Period after this only contains total count of that time.</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer footerbordertop">
                        <button type="button" class="btn buttonwhitedown" data-dismiss="modal" >CANCEL</button>
                        <button type="submit" class="btn buttonwhitedown" >REFINE DATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var dateFormat = "mm/dd/yy",
                    from = $("#from")
                            .datepicker({
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1
                            })
                            .on("change", function () {
                                to.datepicker("option", "minDate", getDate(this));
                            }),
                    to = $("#to")
                            .datepicker({
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1
                            })
                            .on("change", function () {
                                from.datepicker("option", "maxDate", getDate(this));
                            });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }
                return date;
            }
        });
    </script>
@endsection