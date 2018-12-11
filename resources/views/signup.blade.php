@extends('layout.app')

@section('content')

	<div class="header" id="header">
		<div class="col-lg-10 col-md-10 col-sm-12 center-block ">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 logo">
				<a href="./"><img alt="logo" src="images/logo2.png" /></a>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 menus">
				<div class="top-navg visible-xs">
					<div id="toggle_m_nav" href="#">
						<div id="m_nav_menu" class="m_nav">
							<div class="m_nav_ham" id="m_ham_1"></div>
							<div class="m_nav_ham" id="m_ham_2"></div>
							<div class="m_nav_ham" id="m_ham_3"></div>
						</div>
					</div>
					<!-- This is the general container and content that makes up the navbar itself
                 -->
					<nav id="c-menu--slide-right" class="col-lg-3 col-md-5 col-sm-6 col-xs-6 c-menu c-menu--slide-right">
						<a class="c-menu__close"></a>
						<ul class="c-menu__items">
							<li class="c-menu__item"><a href="product" class="c-menu__link">Product</a></li>
							<li class="c-menu__item"><a href="price" class="c-menu__link">Pricing</a></li>
							<li class="c-menu__item"><a href="contact_us" class="c-menu__link">Contact</a></li>
							<li class="c-menu__item"><a href="signup" class="c-menu__link">Sign Up</a></li>
							<li class="c-menu__item"><a href="signin" class="c-menu__link">Sign In</a></li>
						</ul>
					</nav>
					<!-- /c-menu slide-right -->
				</div>
				<nav class="navbar navbar-default hidden-xs">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right" id="site_menus">
								<li><a href="product"><span>Product</span></a></li>
								<li><a href="price"><span>Pricing</span></a></li>
								<li><a href="contact"><span>Contact</span></a></li>
								<li class="active"><a href="signup"><span>Sign Up</span></a></li>
								<li><a href="signin"><span>Sign In</span></a></li>
							</ul>
						</div>
						<!-- /.navbar-collapse -->
					</div>
					<!-- /.container-fluid -->
				</nav>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="signup" id="signup">
		<div class="col-lg-4 col-md-6 col-sm-8 center-block">
			<h3>Get Started Now!</h3>
			<form class="signup_form text-center" role="form" action="signup" method="POST" name="frm">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<div class="message">

					<div id="choose_plan">
						<select class="selectpicker" name="choose_plan">
							<option value="{{Session::get('plan')}}">Choose Your Plan</option>
							<option value="Free">Free</option>
							<option value="Business-Monthly">Business-Monthly</option>
							<option value="Business-Yearly">Business-Yearly</option>
							<option value="Enterprise">Enterprise</option>
						</select>
					</div>
					<input type="text" class="text" name="company_name" placeholder="Company Name" required />
					<input type="password" class="text" name="password" placeholder="Password must be 7 Digits with One uppercase. (i.e: A1234567)" required />
					<input type="text" class="text" name="website_domain" placeholder="Website Domain" required />
					<input type="text" class="text" name="contact" placeholder="Contact Person" required />
					<input type="email" class="text" name="email" id="email" placeholder="Email Address" required />
					<input type="number" class="text" name="phone_number" placeholder="Phone Number" required />
				</div>
			</form>
			<button class="more_btn" id="_submit" value="Sign up">Sign up</button>
		</div>
	</div>

	<!--
    <div class="col-md-6 col-sm-12 col-xs-12 pull-right pricing_siri">
        <img src="images/siri-like.gif" class="img-responsive" />
    </div>
    -->
	<div id="c-mask" class="c-mask"></div>
	<!-- /c-mask -->
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>

	<script>
		$(document).ready(function() {
			$('#_submit').click(function() {
				var frm = document.frm;
				if(
						$('input[name="company_name"]').val() == '' ||
						$('input[name="password"]').val() == '' ||
						$('input[name="website_domain"]').val() == '' ||
						$('input[name="contact"]').val() == '' ||
						$('input[name="email"]').val() == '' ||
						$('input[name="phone_number"]').val() == ''
				) {
					alert('You must fill out all field !!!');
					return;
				}
				if($('input#email').val() != ''){

					$.ajax({
						url: 'check_email',
						type: 'post',
						data: {
							_token: $("input[name='_token']").val(),
							email: $('input#email').val()
						}
					}).success(function (result) {
						alert(result);
						if(result.indexOf('duple') == -1)
							frm.submit();
						return;
					}).error(function (result) {
						alert('error');
						console.log(result);
					});
				}
			});
		});
	</script>

@endsection
