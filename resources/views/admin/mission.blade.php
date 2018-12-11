<!DOCTYPE html>
<html class="height100">

<head>
	<title>Valid Address Landing</title>
	<!-- For-Mobile-Apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />

	<!-- //For-Mobile-Apps -->
	<!-- Custom-Stylesheet-Links -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{asset('js/bootstrap-datepicker/css/datepicker.css')}}" type="text/css">

	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('js/modernizr.custom.97074.js')}}"></script>
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	{{--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
</head>

<body class="bg_dashboard">
<div class="header greenbg">
	<div class="col-lg-10 col-md-12 col-sm-12 center-block col-xs-12 padsmzero">
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 logo padsmzero logo_img">
			<a href=""><img class="mission_logo" src="{{ asset('images/logo.png')}}" /></a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 marginsmtop paddingzero">
			<!--                <a href="#" class="search_input"><input type="text" /><img class="dashboardmenu_icons pull-right" src="images/search.png"></a>-->
			<form class="searchbox">
				<input type="search" placeholder="Search......" name="search" class="searchbox-input bg_input" onkeyup="buttonUp();" required>
				<input class="searchbox-submit">
				<span class="searchbox-icon"><img class="dashboardmenu_icons_search pull-right" src="images/search.png"></span>
			</form>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-2 col-xs-3 marginsmtop pull-right paddingzero">
			<img class="dashboardmenu_icons marginright30 cursorhand pull-right" data-toggle="modal" data-target="#logout" data-backdrop="static" data-keyboard="false" src="images/logout.png">
			<!--                <img class="dashboardmenu_icons" src="images/version_info.png">-->
		</div>
		<h2 class="text-center col-md-12 col-sm-12 col-xs-12 margin2bottomtop white">Mission Control</h2>
		<div class="clearfix"></div>
	</div>
</div>
<div class="col-md-12 heightmissiontable borderbottab col-xs-12">
	<!--        <img class="new_client" src="images/new_client.png">-->
	<div class="col-lg-10 col-md-12 col-sm-12 center-block padding06 col-xs-12" id="dashtable">
		<table class="table table-hover">
			<thead>
			<tr>
				<th></th>
				<th>Client Name</th>
				<th>Plan Type</th>
				<th>Billing Date</th>
				<th>Avg Calls (Daily)</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody id="myTable">
				@forelse($missions as $mission)
					<tr>
						<td>
							<div class="responsive-circle {{$mission->img}}-circle">
								<div class="circle-inner">{{$mission->img}}</div>
							</div>
						</td>
						<td>{{$mission->company_name}}</td>
						<td>{{$mission->plan}}</td>
						<td>
							@if($mission->plan =='Free')
								N/A
							@else
								<span class="span150">
										@if(!is_null($mission->billing_time))
											{{ date_format($mission->billing_time, 'y-m-d')}} - {{$mission->pay_method}}
										@endif
								</span>
								@if($mission->status=='OVERDUE')
									<button type="button" class="btn btn-danger button_table_td">{{$mission->status}}</button>
								@elseif($mission->status=='DUE')
									<button type="button" class="btn btn-info button_table_td">{{$mission->status}}</button>
								@elseif($mission->status=='PAID')
									<button type="button" class="btn btn-success button_table_td">EXPIRED</button>
								@endif
							@endif

						</td>
						<td>{{$mission->count}}</td>
						<td>
							<div class="dropdown" id="dropdashboard">
								<a href="#" data-toggle="dropdown" class="dropdown-toggle"><img class="dashboardmenu_icons_dots" src="images/dots.png"></a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('viewStatistic', $mission->id)}}">View Statistics </a></li>
									<li><a href="{{ url('viewTransactions', $mission->id)}}">View Transactions </a></li>
									<li><a href="{{ url('editClient', $mission->id)}}">Edit Client Details</a></li>
									<li><a href="#" class="cursorhand" data-toggle="modal" data-target="#suspend_user_{{$mission->id}}" data-backdrop="static" data-keyboard="false">Suspend Client</a>
									</li>
									<li><a href="#" class="cursorhand" data-toggle="modal" data-target="#invoice_client_{{$mission->id}}" data-backdrop="static" data-keyboard="false">View Invoices</a></li>
									<li><a href="{{ url('editBilling', $mission->id)}}">Edit/Change Billing Details</a></li>
									<li><a href="#" class="cursorhand" data-toggle="modal" data-target="#downgrade_{{$mission->id}}" data-backdrop="static" data-keyboard="false">Edit/Upgrade/Downgrade Plan</a></li>
									@if(!empty($mission->status))
									
									<li><a href="#" class="cursorhand" data-toggle="modal" data-target="#api_expiry_{{$mission->id}}" data-backdrop="static" data-keyboard="false">Change API Expiry Date</a></li>
									
									@endif
									
									<li><a href="#" class="cursorhand" data-toggle="modal" data-target="#reset_password_{{$mission->id}}" data-backdrop="static" data-keyboard="false">Reset Account Password</a></li>
									<li><a href="#" class="cursorhand" data-toggle="modal" data-target="#remove_client_{{$mission->id}}" data-backdrop="static" data-keyboard="false">Remove Client</a></li>
								</ul>
							</div>
						</td>
						<div id="suspend_user_{{$mission->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header modalbg popupbg">
										<h4 class="modal-title modalheader">Suspend User / Calls for {{$mission->company_name}}</h4>
									</div>
									<div class="modal-body modalbodypaddingdropdown modalbgwhite">
										<div class="col-md-6">
											<a href="{{ url('suspendClient', $mission->id)}}" type="button" class="btn buttonred buttonsusback">Suspend {{$mission->company_name}}</a>
											<h4>Suspending the user will block them from accessing the web Panel.</h4>
											<div class="clearfix"></div>
										</div>
										<div class="col-md-6">
											<a href="{{ url('suspendAllAPi', $mission->id)}}" type="button" class="btn buttonorange buttonsusback">Suspend All API's</a>
											<h4>Suspending API's will deactivate the ability for the clients to make API calls and get a response.</h4>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="modal-footer footerbordertop">
										<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CANCEL</button>
										<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CONFIRM</button>
									</div>
								</div>
							</div>
						</div>
						<div id="downgrade_{{$mission->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
								<!-- Modal content-->
								<div class="modal-content">

										<div class="modal-header modalbg popupbg">
											<h4 class="modal-title modalheader">Edit / Downgrade Plan for Client Name</h4>
										</div>
									<form role="form" action="downgrade" method="POST" name="myForm" id="myForm{{$mission->id}}">
										<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
										<input type="hidden" class="text" name="id" value="{{$mission->id}}"/>

										<div class="modal-body modalbodypaddingdropdown modalbgwhite">
												<div class="col-md-6 padsmzero">
													<div class=" borderbottomdrop paddingzero">
														<div class="col-md-4">
															<label class="colordropdown">Current Plan</label>
														</div>
														<div class="col-md-8">
															<div id="downgrade">
																<select class="selectpicker" name="level{{$mission->id}}" form="myForm{{$mission->id}}">
																	<option>Business</option>
																	<option>Enterprise</option>
																	<option>Free</option>
																</select>
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
												<div class="col-md-6 borderbottomdrop paddingzero">
													<div class="col-md-4">
														<label class="colordropdown">Billing Period</label>
													</div>
													<div class="col-md-8">
														<div id="downgrade">
															<select class="selectpicker" name="period{{$mission->id}}" form="myForm{{$mission->id}}">
																<option>Monthly</option>
																<option>Yearly</option>
															</select>
														</div>
													</div>
												</div>
												<div class="clearfix"></div>

										</div>
										<div class="modal-footer footerbordertop">
											<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CANCEL</button>
											<button type="submit" class="btn buttonwhitedown">SUBMIT</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="remove_client_{{$mission->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content modalbgremove">
									<div class="modal-body modalbodypadding removebg">
										<h2 class="colorwhite headermodal">Remove {{$mission->company_name}}</h2>
										<h4 class="colorwhite headermodal">Are you sure you wish to remove {{$mission->company_name}}?</h4>
									</div>
									<div class="modal-footer footerbordertop">
										<button type="button" class="btn buttonwhiteremove" data-dismiss="modal">CANCEL</button>
										<a href="{{ url('removeClient', $mission->id)}}" type="button" class="btn buttonwhiteremove" >REMOVE</a>
									</div>
								</div>
							</div>
						</div>
						<!--  Reset Password  -->
						<div id="reset_password_{{$mission->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
								<!-- Modal content-->
								<form role="form" action="resetPassword" method="POST" name="myForm" id="myForm">
									<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
									<input type="hidden" class="text" name="id" value="{{$mission->id}}"/>
									<div class="modal-content">
									<div class="modal-header modalbg popupbg">
										<h4 class="modal-title modalheader">Reset Account Password for Client Name</h4>
									</div>
									<div class="modal-body modalbodypaddingdropdown modalbgwhite">
										<div class=" borderbottomdrop paddingzero">
											<div class="col-md-4 padsmzero">
												<label class="colordropdown_reset">Clients Email Address</label>
											</div>
											<div class="col-md-8 padsmzero">
												<input class="form-control bgsaveinput" name="email" type="email" value="{{$mission->email}}">
											</div>
											<div class="clearfix"></div>
										</div>
										<h4 class="paddd">Confirm the email address which will be sent to the Client’s account</h4>
										<div class="clearfix"></div>
									</div>
									<div class="modal-footer footerbordertop">
										<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CANCEL</button>
										<button type="submit" class="btn buttonwhitedown" onclick="confirm('Are you sure you wish to send a reset password email to the client \'{{$mission->company_name}}\' to the email address \'{{$mission->email}}\'?')" >SEND</button>
									</div>
								</div>
								</form>
							</div>
						</div>
						<!--  API expiry date  -->
						<div id="api_expiry_{{$mission->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">

								<form role="form" action="apiExpiry" method="POST" name="myForm" id="myForm">
									<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
									<input type="hidden" class="text" name="id" value="{{$mission->id}}"/>
									<!-- Modal content-->
									<div class="modal-content">
									<div class="modal-header modalbg popupbg">
										<h4 class="modal-title modalheader">Change API Expiry Date for {{$mission->company_name}}</h4>
									</div>
									<div class="modal-body modalbgwhite paddingmodalcomplete">
										<div class="col-md-12 padapi">
											<div class="col-md-6">
												<div class="col-md-7 paddingzero">
													<label class="colordropdown_reset">Current Start Date</label>
												</div>
												<div class="col-md-5">
													<p class="colordropdown_reset colorblack">{{ $mission->start_time}}</p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="col-md-7 paddingzero">
													<label class="colordropdown_reset">Current Expiry Date</label>
												</div>
												<div class="col-md-5">
													<p class="colordropdown_reset colorblack">{{ $mission->end_time}}</div>
											</div>
										</div>
										<div class="col-md-12 modalbodypaddingdropdown bgcolorapi">
											<div class="col-md-6 borderbottomdrop paddingzero width49">
												<div class="col-md-5">
													<label class="colordropdown_reset">New Start Date</label>
												</div>
												<div class="col-md-7">
													<input class="form-control bgcalinput" type="text"  id="from{{$mission->id}}" name="start_time{{$mission->id}}" readonly='true'>
												</div>
											</div>
											<div class="col-md-6 borderbottomdrop paddingzero">
												<div class="col-md-5">
													<label class="colordropdown_reset">New Expiry Date</label>
												</div>
												<div class="col-md-7">
													<input class="form-control bgcalinput" type="text" id="to{{$mission->id}}" name="end_time{{$mission->id}}" readonly='true'>
												</div>
											</div>
											<h4 class="paddd col-md-12">Amend the Start and End Date by using the date picker next to each corresponding start and expiry field.</h4>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="modal-footer footerbordertop">
										<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CANCEL</button>
										<button type="submit" class="btn buttonwhitedown" >CONFIRM</button>
									</div>
								</div>
								</form>
							</div>
						</div>

					</tr>
					<script>
						$(function () {
							var dateFormat = "mm/dd/yy",
									from = $("#from{{$mission->id}}")
											.datepicker({
												defaultDate: "+1w",
												changeMonth: true,
												numberOfMonths: 1
											})
											.on("change", function () {
												to.datepicker("option", "minDate", getDate(this));
											}),
									to = $("#to{{$mission->id}}")
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

				@empty
					<li>No User</li>
				@endforelse

			</tbody>
		</table>
	</div>
</div>
<div class="col-lg-11 col-md-8 col-sm-12 col-xs-12">
	<div class="col-lg-5 col-md-8 pull-right col-xs-12 padsmzero" id="pagedrop">
		<label class="textrows margintop">Rows per page:</label>
		<select class="selectpicker">
			<option>3</option>
			<option>8</option>
			<option>10</option>
		</select>
		<label class="textrows">1 - 8 of 200</label>
            <span class="pull-right margintop12">
                <img class="display_inlineb dashboardmenu_icons " src="images/prev.png">
                <img class="display_inlineb dashboardmenu_icons marginleft20" src="images/next.png">
                </span>
		<!--                <ul class="pagination pagination-lg pager pull-right width30" id="myPager"></ul>-->
	</div>
	<div class="clearfix"></div>
</div>



<script>
	$(document).ready(function () {
		var submitIcon = $('.searchbox-icon');
		var inputBox = $('.searchbox-input');
		var searchBox = $('.searchbox');
		var isOpen = false;
		submitIcon.click(function () {
			if (isOpen == false) {
				searchBox.addClass('searchbox-open');
				inputBox.focus();
				isOpen = true;
			} else {
				searchBox.removeClass('searchbox-open');
				inputBox.focusout();
				isOpen = false;
			}
		});
		submitIcon.mouseup(function () {
			return false;
		});
		searchBox.mouseup(function () {
			return false;
		});
		$(document).mouseup(function () {
			if (isOpen == true) {
				$('.searchbox-icon').css('display', 'block');
				submitIcon.click();
			}
		});
	});

	function buttonUp() {
		var inputVal = $('.searchbox-input').val();
		inputVal = $.trim(inputVal).length;
		if (inputVal !== 0) {
			$('.searchbox-icon').css('display', 'none');
		} else {
			$('.searchbox-input').val('');
			$('.searchbox-icon').css('display', 'block');
		}
	}
</script>

<div class="clearfix"></div>
<!--  logout  -->
<div id="logout" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content modalbg">
			<form role="form" action="logout" method="GET">
				<div class="modal-body modalbodypadding logoutbg">
					<h2 class="colorwhite headermodal">Logout</h2>
					<h4 class="colorwhite headermodal">Are you sure you wish to log out of Mission Control?</h4>
				</div>
				<div class="modal-footer footerbordertop">
					<button type="button" class="btn buttonwhite" data-dismiss="modal">CANCEL</button>
					<button type="submit" class="btn buttonwhite">LOGOUT</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Remove Client   -->
<!--  invoice USer -->
@forelse($missions as $mission)
	<div id="invoice_client_{{$mission->id}}" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header modalbg popupbg">
				<h4 class="modal-title modalheader">Client Invoice for {{$mission->company_name}}</h4>
			</div>
			<div class="modal-body modalbgwhite">
				<div class="height500" id="dashtable_modal">
					<table class="table table-hover">
						<thead>
						<tr>
							<th>Billing Period</th>
							<th>Amount</th>
							<th>Payment Status</th>
							<th>Download</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@forelse($mission->invoices as $invoice)

							<tr>
								<td>{{$invoice->start_time}} - {{$invoice->end_time}}</td>
								<td>$ {{$invoice->amount}}</td>
								@if($invoice->status=='PAID')
									<td class="greentxt">Paid</td>
								@else
									<td class="redtxt">OVERDUE&nbsp;&nbsp;&nbsp;&nbsp;<span class="greentxt font14 cursorhand"> Mark As Paid</span></td>
								@endif
									<td>JUN2016.pdf</td>
								<td><img class="dashboardmenu_icons cursorhand" src="images/download.png"></td>
							</tr>

						@empty

						@endforelse


						</tbody>
					</table>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="modal-footer footerbordertop">
				<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CANCEL</button>
				<button type="button" class="btn buttonwhitedown" data-dismiss="modal">CONFIRM</button>
			</div>
		</div>
	</div>
	</div>
@empty
	<li>No User</li>
@endforelse
</body>

</html>