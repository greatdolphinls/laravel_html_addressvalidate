@extends('layout.app')

@section('content')
	<div class="header" id="header">
		<div class="col-lg-10 col-md-10 col-sm-12 center-block ">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 logo">
				<a href="./"><img alt="logo" src="{{asset('images/logo2.png')}}" /></a>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 menus">

			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="signup" id="signup">
		<div class="col-lg-4 col-md-6 col-sm-8 center-block">
			<h3 class="signin_title">Reset Your Password</h3>
			<p style="color: red">{{Session::get('password_error')}}</p>
			<form class="signup_form text-center" role="form" action="reset_password" id="myfrm" method="POST" >
				<div class="message">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
					<input type="hidden" class="text" name="email" value="{{$email}}"/>
					<input type="password" class="text" name="password" placeholder="New Password" required />
					<input type="password" class="text" name="retype_password" placeholder="Retype Password" required />
					<input type="button" class="more_btn" id="btn_reset" value="Reset Password" />
				</div>
			</form>
		</div>
	</div>

	<!--
    <div class="col-md-6 col-sm-12 col-xs-12 pull-right pricing_siri signin_siri">
        <img src="images/siri-like.gif" class="img-responsive" />
    </div>
-->

	<div id="c-mask" class="c-mask"></div>
	<!-- /c-mask -->
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
	<script>
		$(document).ready(function() {
			$('input#btn_reset').click(function() {
				if($("input[name='password']").val() != $("input[name='retype_password']").val())
				{
					alert('Your changing information is wrong.');
					return;
				}

				$("#myfrm").submit();

			});
		});
	</script>
@endsection
