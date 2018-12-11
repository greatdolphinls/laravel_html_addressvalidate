

@extends('layout.user')

@section('content')

    {{--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    <link rel="stylesheet" href="{{asset('js/jquery-ui/jquery-ui.min.css')}}">

    <div class="col-lg-12 col-md-12 col-sm-12 content_user paddingzero col-xs-12">
        <div class="col-md-12 first_div col-xs-12">
            <div class="first_div_inner">
                <div class="col-md-3 paddingzero col-xs-12">
                    <h3 class="colorlightblue">Useful Information</h3>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="btn-group inline pull-right">
                        <button type="button" class="btn btn-trans btn-lg choosebg cursorhand margin20 btntranpull" data-toggle="modal" data-target="#Choose-date" data-backdrop="static" data-keyboard="false">Choose Date</button>
                        <button type="button" class="btn btn-trans btn-lg downloadbg cursorhand btntranpull marginsmtop" data-toggle="modal" data-target="#Download_records" data-backdrop="static" data-keyboard="false">Download Transaction Rec</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="usertable">
        <table class="table table-hover">
            <thead class="colorth">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>I.P</th>
                    <th>User Location</th>
                    <th class="width20">Postcode of Address</th>
                </tr>
            </thead>
            <tbody id="myTable" class="colorwhite">
                <?php foreach($data['main'] as $dt){ ?>
                <tr>
                    <td>{{ date_format($dt['created_at'], 'd/m/Y') }}</td>
                    <td>{{ date_format($dt['created_at'], 'H:i') }}</td>{{--10.30 AM AEST--}}
                    <td>{{ $dt['ip'] }}</td>
                    <td>{{ $dt['location'] }}</td>
                    <td>{{ $dt['pcode_number'] }}</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="receive_location" value=" > Transaction Logs" />
    <input type="hidden" id="receive_username" value="{{$data['username']}}" />

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
    <script>
        $(function () {
            var dateFormat = "mm/dd/yy",
                    from = $("#from1")
                            .datepicker({
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1
                            })
                            .on("change", function () {
                                to.datepicker("option", "minDate", getDate(this));
                            }),
                    to = $("#to1").datepicker({
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

    <!--  Choose date  -->
    <div id="Choose-date" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="summary_during" method="post" name="frm_date">
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
    <!--  download records  -->
    <div id="Download_records" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modalbg popdownload">
                    <h4 class="modal-title modalheader">Download Transaction Records</h4>
                </div>
                <form action="summary_download" method="post" name="frm_date">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="modal-body modalbgwhite paddingmodalcomplete">
                        <div class="col-md-12 modalbodypaddingdropdown">
                            <div class="col-md-6 borderbottomdrop paddingzero width49">
                                <div class="col-md-4">
                                    <label class="colordropdown_reset">Date From</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control bgcalinput" type="text" id="from1" name="from1">
                                </div>
                            </div>
                            <div class="col-md-6 borderbottomdrop paddingzero">
                                <div class="col-md-4">
                                    <label class="colordropdown_reset">Date To</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control bgcalinput" type="text" id="to1" name="to1">
                                </div>
                            </div>
                            <h4 class="paddd col-md-12">NOTE: We only store 30 days of transactions. Period after this only contains total count of that time.</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer footerbordertop">
                        <button type="button" class="btn buttonwhitedown" data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn buttonwhitedown">DOWNLOAD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection