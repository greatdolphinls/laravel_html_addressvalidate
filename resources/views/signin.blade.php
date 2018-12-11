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
							<li class="c-menu__item"><a href="contact" class="c-menu__link">Contact</a></li>
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
								<li><a href="signup"><span>Sign Up</span></a></li>
								<li class="active"><a href="signin"><span>Sign In</span></a></li>
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
			<h3 class="signin_title">Sign Into Your Account</h3>
			<p class="text-center" style="color: red">{{Session::get('error')}}</P>
			<form class="signup_form text-center" role="form" action="signin" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<div class="message">
					<input type="email" class="text" name="email" placeholder="Email Address" required />
					<input type="password" class="text" name="password" placeholder="Password" required />
					<a href="#" class="forgot_password" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#forgotpasswordModal" data-dismiss="modal">Forgot Your Password?</a>
					<input type="submit" class="more_btn" value="Sign In" />
				</div>
			</form>
		</div>
	</div>
	<!--
    <div class="col-md-6 col-sm-12 col-xs-12 pull-right pricing_siri signin_siri">
        <img src="images/siri-like.gif" class="img-responsive" />
    </div>
-->
	<!-- forgot password Modal -->
	<div class="modal fade" id="forgotpasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotpasswordModal" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Forgot Your Password?</h4>
				</div>
				<div class="modal-body">
					<div class="col-md-10 col-sm-12 col-xs-12 center-block forgot_password_form">
						<form role="form" action="forget" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
							<input type="text" name="email" class="text" placeholder="Email Address" required />
							<input type="submit" class="more_btn" value="Send" />
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="c-mask" class="c-mask"></div>
	<!-- /c-mask -->
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
@endsection
