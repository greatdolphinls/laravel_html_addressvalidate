@extends('layout.user')

@section('content')

    @if($data['plan'] == 'Free')
        <div class="col-lg-12 paddingzero col-sm-12 col-xs-12">
            <div class="col-md-12 first_div col-xs-12 padsmzero">
                <div class="first_div_inner">
                    <div class="col-md-3 col-sm-6">
                        <h3 class="colorlightblue">Useful Information</h3>
                    </div>
                    <div class="col-md-9 col-sm-6">
                        <div class="col-md-3 pull-right paddingzero width300px">
                            <div class="borderbottomdrop paddingzero current_plan">
                                <a href="account#Plans">
                                    <button type="button" class="btn btn-trans btn-lg cursorhand editicon">Current Plan&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">{{$data['plan']}}</span></button>
                                </a>
                                <!--
                                <div class="col-md-6">
                                    <label class="colordropdown">Current Plan</label>
                                </div>
                                <div class="col-md-6 paddingzero">
                                    <div id="downgrade">
                                        <select class="selectpicker">
                                            <option>Free</option>
                                            <option>Business</option>
                                            <option>Enterprise</option>
                                        </select>
                                    </div>
                                </div>
                                -->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 call_status col-xs-12">
                <div class="col-md-8 paddingzero">
                    <div class="bggray call_status_left userc">
                        <div class="col-md-12 col-sm-12 paddingzero">
                            <a href="#"><img src="images/three_dots.png" /></a>
                        </div>
                        <div class="col-md-12 col-sm-12 middle_div">
                            <div class="col-md-8 col-sm-8 paddingzero">
                                <img src="images/call.png" class="call_image" />
                                <h1 class="colorgreen call_value">{{$data['transaction_cnt']}}</h1>
                                <div class="call_text">
                                    <h2 class="colorwhite">Total Calls</h2>
                                    <h4 class="colorlightblue">This Month</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 paddingzero mart25px">
                                <div class="call_status_right">
                                    <h2 class="colorwhite display_inlineb">{{$data['remain_cnt']}}</h2>
                                    <h4 class="colorlightblue display_inlineb">Calls Left</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 paddingzero status_progress">
                            <div class="progress">
                                <div class="progress-bar " role="progressbar" aria-valuenow="{{$data['transaction_cnt']}}" style="width:{{$data['percent']}}%"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="bggray call_status_bottom userbottom">
                        <img src="images/average.png" class="average_icon" />
                        <h1 class="colorwhite display_inlineb">{{$data['average']}}</h1>
                        <h2 class="colorwhite display_inlineb">Average Calls <span class="colorlightblue">/ Day</span></h2>
                    </div>
                </div>
                <div class="col-md-4 paddingrightzero marginsmtop padsmzero">
                    <div class="col-md-12 paddingzero bggray view_today" id="view_today">
                        <img src="images/log_1.png" />
                        <h2 class="colorgreen view_today_text">View Today</h2>
                        <h2 class="colorwhite">Transaction Logs</h2>
                    </div>
                    <div class="col-md-12 paddingzero bggray mart10px view_today" id="view_complete">
                        <img src="images/log_2.png" />
                        <h2 class="colorgreen view_today_text">View Complete</h2>
                        <h2 class="colorwhite">Transaction Logs</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 track_calls col-xs-12">
                <div class="track_calls_inner">
                    <div class="col-md-3 paddingzero">
                        <h3 class="colorlightblue">Tracking of Calls</h3>
                    </div>
                    <div class="col-md-9 paddingzero">
                        <div class="col-md-3 pull-right paddingzero">
                            <div class="paddingzero pull-right">
                                <button type="button" class="btn btn-trans btn-lg cursorhand">Date Filter&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">20.08.16 - 25.08.16</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 gragh_wrap col-xs-12">
                <div class="col-md-8 bggray left_graph">
                    <div class="" id="graph1"></div>
                </div>
                <div class="col-md-4 right_graph paddingrightzero marginsmtop padsmzero">
                    <div class="col-md-12 bggray" id="graph2"></div>
                </div>
            </div>
        </div>
    @elseif($data['plan'] == 'Business-Monthly' || $data['plan'] == 'Business-Yealy')
        <div class="col-lg-12 paddingzero col-sm-12 col-xs-12">
            <div class="col-md-12 first_div col-xs-12 padsmzero">
                <div class="first_div_inner">
                    <div class="col-md-3 col-sm-6">
                        <h3 class="colorlightblue">Useful Information</h3>
                    </div>
                    <div class="col-md-9 col-sm-6">
                        <div class="col-md-3 pull-right paddingzero width300px">
                            <div class="borderbottomdrop paddingzero current_plan">
                                <a href="account#Plans">
                                    <button type="button" class="btn btn-trans btn-lg cursorhand editicon">Current Plan&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">{{ $data['plan'] }}</span></button>
                                </a>
                                <!--
                                <div class="col-md-6">
                                    <label class="colordropdown">Current Plan</label>
                                </div>
                                <div class="col-md-6 paddingzero">
                                    <div id="downgrade">
                                        <select class="selectpicker">
                                            <option>Free</option>
                                            <option>Business</option>
                                            <option>Enterprise</option>
                                        </select>
                                    </div>
                                </div>
                                -->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 call_status col-xs-12">
                <div class="col-md-8 paddingzero col-xs-12">
                    <div class="bggray call_status_left userc userm">
                        <div class="col-md-12 col-sm-12 paddingzero">
                            <a href="#"><img src="images/three_dots.png" /></a>
                        </div>
                        <div class="col-md-12 col-sm-12 middle_div">
                            <div class="col-md-8 col-sm-8 paddingzero">
                                <img src="images/calendar_pending.png" class="call_image" />
                                <h1 class="colorgreen call_value">{{ $data['lastdays'] }}</h1>
                                <div class="call_text">
                                    <h2 class="colorwhite">Days</h2>
                                    <h4 class="colorlightblue">Used</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 paddingzero mart25px">
                                <div class="call_status_right">
                                    <h2 class="colorwhite display_inlineb">{{ $data['remaindays'] }} </h2>
                                    <h4 class="colorlightblue display_inlineb">Days Remaining</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 paddingzero status_progress">
                            <div class="progress">
                                <div class="progress-bar " role="progressbar" style="width:{{ $data['percent'] }}%"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="bggray call_status_bottom monthlyb">
                        <div class="col-lg-3 col-md-6 paddingzero">
                            <img src="images/total.png" class="average_icon" />
                            <h1 class="colorwhite display_inlineb">{{ $data['transaction_cnt'] }}</h1>
                            <h4 class="colorwhite display_inlineb vbottom">Total <br />Calls</h4>
                        </div>
                        <div class="col-lg-3 col-md-6 paddingzero">
                            <img src="images/average.png" class="average_icon" />
                            <h1 class="colorwhite display_inlineb">{{ $data['average'] }}</h1>
                            <h4 class="colorwhite display_inlineb vbottom">Average <br />Calls</h4>
                        </div>
                        <div class="col-lg-6 col-md-12 contract_expires">
                            <img src="images/calendar_exp.png" class="average_icon" />
                            <h3 class="colorwhite display_inlineb vbottom lineheight24px">{{ $data['end_time'] }} </h3>
                            <h3><span class="colorlightblue">Contract Expires Date</span></h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 paddingrightzero marginsmtop padsmzero col-xs-12">
                    <div class="col-md-12 paddingzero bggray view_today" id="view_today">
                        <img src="images/log_1.png" />
                        <h2 class="colorgreen view_today_text">View Today</h2>
                        <h2 class="colorwhite">Transaction Logs</h2>
                    </div>
                    <div class="col-md-12 paddingzero bggray mart10px view_today" id="view_complete">
                        <img src="images/log_2.png" />
                        <h2 class="colorgreen view_today_text">View Complete</h2>
                        <h2 class="colorwhite">Transaction Logs</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 track_calls col-xs-12">
                <div class="track_calls_inner">
                    <div class="col-md-3 paddingzero col-xs-12">
                        <h3 class="colorlightblue">Tracking of Calls</h3>
                    </div>
                    <div class="col-md-9 paddingzero col-xs-12">
                        <div class="col-md-3 pull-right paddingzero col-xs-12">
                            <div class="paddingzero pull-right">
                                <button type="button" class="btn btn-trans btn-lg cursorhand">Date Filter&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">20.08.16 - 25.08.16</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 gragh_wrap col-xs-12">
                <div class="col-md-8 bggray left_graph">
                    <div class="" id="graph1"></div>
                </div>
                <div class="col-md-4 right_graph paddingrightzero marginsmtop padsmzero">
                    <div class="col-md-12 bggray" id="graph2"></div>
                </div>
            </div>
        </div>
    @elseif($data['plan'] == 'Enterprise')
        <div class="col-lg-12 paddingzero col-sm-12 col-xs-12">
            <div class="col-md-12 first_div col-xs-12 padsmzero">
                <div class="first_div_inner">
                    <div class="col-md-3 col-sm-6">
                        <h3 class="colorlightblue">Useful Information</h3>
                    </div>
                    <div class="col-md-9 col-sm-6">
                        <div class="col-md-3 pull-right paddingzero width300px">
                            <div class="borderbottomdrop paddingzero current_plan">
                                <a href="account#Plans">
                                    <button type="button" class="btn btn-trans btn-lg cursorhand editicon">Current Plan&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">{{ $data['plan'] }}</span></button>
                                </a>
                                <!--
                                <div class="col-md-6">
                                    <label class="colordropdown">Current Plan</label>
                                </div>
                                <div class="col-md-6 paddingzero">
                                    <div id="downgrade">
                                        <select class="selectpicker">
                                            <option>Free</option>
                                            <option>Business</option>
                                            <option>Enterprise</option>
                                        </select>
                                    </div>
                                </div>
-->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 call_status col-xs-12">
                <div class="col-md-8 paddingzero">
                    <div class="col-md-6 paddingright8px padsmzero">
                        <div class="bggray call_status_left enterprise_top">
                            <div class="col-md-12 paddingzero col-xs-12">
                                <a href="#"><img src="images/three_dots.png" /></a>
                            </div>
                            <div class="col-md-12 enterprise_block">
                                <div class="col-md-12 paddingzero mart15perc">
                                    <img src="images/call.png" class="call_image" />
                                    <h1 class="colorgreen call_value enterprise_value">{{ $data['transaction_cnt'] }}</h1>
                                    <div class="call_text enterprise_text">
                                        <h2 class="colorwhite">Total Calls</h2>
                                        <h4 class="colorlightblue">This Month</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="bggray call_status_bottom enterprise_bottom">
                            <img src="images/average.png" class="average_icon" />
                            <h1 class="colorwhite display_inlineb">{{ $data['average'] }}</h1>
                            <h2 class="colorwhite display_inlineb">Average Calls <span class="colorlightblue">/ Day</span></h2>
                        </div>
                    </div>
                    <div class="col-md-6 paddingleft7px padsmzero marginsmtop">
                        <div class="bggray call_status_left enterprise_top">
                            <div class="col-md-12 paddingzero">
                                <a href="#"><img src="images/three_dots.png" /></a>
                            </div>
                            <div class="col-md-12 enterprise_block">
                                <div class="col-md-12 paddingzero mart15perc">
                                    <img src="images/calendar_pending.png" class="call_image" />
                                    <h1 class="colorgreen call_value enterprise_value">{{ $data['lastdays'] }}</h1>
                                    <div class="call_text enterprise_text">
                                        <h2 class="colorwhite">Days Pending</h2>
                                        <h4 class="colorlightblue">Till License Expires</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="bggray call_status_bottom enterprise_bottom">
                            <img src="images/calendar_exp.png" class="average_icon" />
                            <h1 class="colorwhite display_inlineb average_calls">{{ $data['end_time'] }} </h1>
                            <h2 class="colorwhite display_inlineb"><span class="colorlightblue">Contract Expires Date</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 paddingrightzero marginsmtop padsmzero">
                    <div class="col-md-12 paddingzero bggray view_today" id="view_today">
                        <img src="images/log_1.png" />
                        <h2 class="colorgreen view_today_text">View Today</h2>
                        <h2 class="colorwhite">Transaction Logs</h2>
                    </div>
                    <div class="col-md-12 paddingzero bggray mart10px view_today" id="view_complete">
                        <img src="images/log_2.png" />
                        <h2 class="colorgreen view_today_text">View Complete</h2>
                        <h2 class="colorwhite">Transaction Logs</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 track_calls col-xs-12">
                <div class="track_calls_inner col-xs-12">
                    <div class="col-md-3 paddingzero">
                        <h3 class="colorlightblue">Tracking of Calls</h3>
                    </div>
                    <div class="col-md-9 paddingzero">
                        <div class="col-md-3 pull-right paddingzero">
                            <div class="paddingzero pull-right">
                                <button type="button" class="btn btn-trans btn-lg cursorhand">Date Filter&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">20.08.16 - 25.08.16</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 gragh_wrap col-xs-12">
                <div class="col-md-8 bggray left_graph">
                    <div class="" id="graph1"></div>
                </div>
                <div class="col-md-4 right_graph paddingrightzero marginsmtop padsmzero">
                    <div class="col-md-12 bggray" id="graph2"></div>
                </div>
            </div>
        </div>
    @endif

    <div class="clearfix"></div>
    <input type="hidden" id="receive_location" value="" />
    <input type="hidden" id="receive_username" value="{{$data['username']}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

    <script>
        $(document).ready(function () {
            $('.view_today').click(function () {
                $('.view_today,.mart10px.view_today').removeClass('active_view_today');
                $(this).addClass('active_view_today');
            });
            $('#view_today').click(function() {
                location.href = 'summary_today';
            });
            $('#view_complete').click(function() {
                location.href = 'summary_complete';
            });
        });
    </script>

    {{--<script src="https://code.highcharts.com/highcharts.js"></script>--}}
    {{--<script src="https://code.highcharts.com/modules/exporting.js"></script>--}}

    {{--<script type="text/javascript">--}}
        {{--$(function () {--}}
            {{--Highcharts.theme = {--}}
                {{--colors: ['#01AF5A']--}}
            {{--};--}}
            {{--var highchartsOptions = Highcharts.setOptions(Highcharts.theme);--}}
            {{--$('#graph1').highcharts({--}}
                {{--chart: {--}}
                    {{--type: 'areaspline',--}}
                    {{--backgroundColor: 'rgba(255,255,255,0)',--}}
                    {{--borderRadius: 10--}}
                {{--},--}}
                {{--title: {--}}
                    {{--text: ''--}}
                {{--},--}}
                {{--legend: {--}}
                    {{--layout: 'vertical',--}}
                    {{--align: 'left',--}}
                    {{--verticalAlign: 'top',--}}
                    {{--x: 150,--}}
                    {{--y: 100,--}}
                    {{--floating: true,--}}
                    {{--borderWidth: 1,--}}
                    {{--enabled: false,--}}
                    {{--backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'--}}
                {{--},--}}
                {{--xAxis: {--}}
                    {{--categories: [--}}
                        {{--'20.08.2016',--}}
                        {{--'21.08.2016',--}}
                        {{--'22.08.2016',--}}
                        {{--'23.08.2016',--}}
                        {{--'24.08.2016',--}}
                        {{--'25.08.2016',--}}
                        {{--'26.08.2016'--}}
                    {{--],--}}
                    {{--gridLineWidth: 1,--}}
                    {{--gridLineColor: '#4B5A61',--}}
                    {{--lineColor: '#4B5A61',--}}
                    {{--labels: {--}}
                        {{--style: {--}}
                            {{--color: '#607D8B'--}}
                        {{--}--}}
                    {{--}--}}
                {{--},--}}
                {{--yAxis: {--}}
                    {{--title: {--}}
                        {{--text: ''--}}
                    {{--},--}}
                    {{--gridLineWidth: 1,--}}
                    {{--gridLineColor: '#4B5A61',--}}
                    {{--labels: {--}}
                        {{--style: {--}}
                            {{--color: '#607D8B'--}}
                        {{--}--}}
                    {{--},--}}
                    {{--min: 0,--}}
                    {{--max: 500,--}}
                    {{--tickInterval: 100--}}
                {{--},--}}
                {{--tooltip: {--}}
                    {{--pointFormat: '<span style="font-size:16px">{point.y:,.0f} Calls</span><br /><span style="font-size:12px">2.30 PM</span>',--}}
                    {{--backgroundColor: '#01AF5A',--}}
                    {{--borderRadius: 20,--}}
                    {{--style: {--}}
                        {{--color: '#fff'--}}
                    {{--}--}}
                {{--},--}}
                {{--credits: {--}}
                    {{--enabled: false--}}
                {{--},--}}
                {{--plotOptions: {--}}
                    {{--areaspline: {--}}
                        {{--fillColor: 'rgba(41,98,83,0.5)'--}}
                    {{--},--}}
                    {{--series: {--}}
                        {{--marker: {--}}
                            {{--enabled: false,--}}
                            {{--symbol: 'circle',--}}
                            {{--radius: 4,--}}
                            {{--fillColor: '#FFFFFF',--}}
                            {{--states: {--}}
                                {{--hover: {--}}
                                    {{--enabled: true--}}
                                {{--}--}}
                            {{--}--}}
                        {{--}--}}
                    {{--}--}}
                {{--},--}}
                {{--series: [{--}}
                    {{--name: 'John',--}}
                    {{--data: [40, 99, 124, 350, 400, 440, 490]--}}
                {{--}]--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
    {{--<script type="text/javascript">--}}
        {{--$(function () {--}}
            {{--$(document).ready(function () {--}}
                {{--Highcharts.theme = {--}}
                    {{--colors: ['#4CB050', '#8CC34B', '#CDDC39', '#FFEB3C', '#FEC107', '#FF9801']--}}
                {{--};--}}
                {{--var highchartsOptions = Highcharts.setOptions(Highcharts.theme);--}}
                {{--// Build the chart--}}
                {{--$('#graph2').highcharts({--}}
                    {{--chart: {--}}
                        {{--plotBackgroundColor: null,--}}
                        {{--plotBorderWidth: null,--}}
                        {{--plotShadow: false,--}}
                        {{--backgroundColor: 'rgba(255, 255, 255, 0)',--}}
                        {{--type: 'pie',--}}
                    {{--},--}}
                    {{--title: {--}}
                        {{--text: ''--}}
                    {{--},--}}
                    {{--credits: {--}}
                        {{--enabled: false--}}
                    {{--},--}}
                    {{--tooltip: {--}}
                        {{--pointFormat: '<b>{point.percentage:.1f}%</b>'--}}
                    {{--},--}}
                    {{--legend: {--}}
                        {{--itemStyle: {--}}
                            {{--color: 'white'--}}
                        {{--}--}}
                    {{--},--}}
                    {{--plotOptions: {--}}
                        {{--pie: {--}}
                            {{--allowPointSelect: true,--}}
                            {{--cursor: 'pointer',--}}
                            {{--dataLabels: {--}}
                                {{--enabled: false,--}}
                                {{--distance: -15,--}}
                                {{--style: {--}}
                                    {{--fontWeight: 'bold',--}}
                                    {{--color: '#36474F',--}}
                                    {{--textShadow: 'none'--}}
                                {{--}--}}
                            {{--},--}}
                            {{--showInLegend: true,--}}
                            {{--startAngle: 0,--}}
                            {{--endAngle: 360--}}
                        {{--}--}}
                    {{--},--}}
                    {{--series: [{--}}
                        {{--borderWidth: 0,--}}
                        {{--name: 'EMP',--}}
                        {{--innerSize: '50%',--}}
                        {{--colorByPoint: true,--}}
                        {{--data: [{--}}
                            {{--name: 'NSW',--}}
                            {{--y: 20--}}
                        {{--}, {--}}
                            {{--name: 'QLD',--}}
                            {{--y: 34.03,--}}
                            {{--sliced: true,--}}
                            {{--selected: true--}}
                        {{--}, {--}}
                            {{--name: 'WA',--}}
                            {{--y: 10.38--}}
                        {{--}, {--}}
                            {{--name: 'ACT',--}}
                            {{--y: 24.77--}}
                        {{--}, {--}}
                            {{--name: 'VIC',--}}
                            {{--y: 14.77--}}
                        {{--}, {--}}
                            {{--name: 'TAS',--}}
                            {{--y: 20.77--}}
                        {{--}]--}}
                    {{--}]--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}


@endsection