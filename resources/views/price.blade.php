
@extends('layout.app')

@section('content')

    <!-- Header -->
    <div class="header" id="header">
        <div class="col-lg-10 col-md-10 col-sm-12 center-block ">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 logo">
                <a href="./"><img src="images/logo2.png" /></a>
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
                    <!-- This is the general container and content that makes up the navbar itself -->
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
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="product"><span>Product</span></a></li>
                                <li class="active"><a href="price"><span>Pricing</span></a></li>
                                <li><a href="contact"><span>Contact</span></a></li>
                                <li><a href="signup"><span>Sign Up</span></a></li>
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
    <!-- //Header -->
    <div class="price" id="pricing_wrap">
        <div class="col-lg-7 col-md-9 col-sm-11 col-xs-12 center-block">
            <h3>Pricing</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            <div class="col-md-4 col-sm-4 price_free" href="{{ url('price_free')}}">
                <div class="pricing_content">
                    <div class="pricing_label">Free</div>
                    <div class="pricing_image">
                        <img src="images/price_image1.png" />
                    </div>
                    <div class="pricing_features">
                        <ul>
                            <li><span>500 Calls/Month</span></li>
                            <li><span>API Access</span></li>
                            <li><span>Street, Unit, Level Validation</span></li>
                            <li><span>Auto Correct</span></li>
                            <li><span>GeoCoding</span></li>
                            <li><span>Auto Complete</span></li>
                            <li><span>Reporting</span></li>
                            <li><span>P.O Boxes</span></li>
                            <li class="opacity_zero"><span>P.O Boxes</span></li>
                            <li><span>Server Power: </span><span class="black_text">LOW</span></li>
                            <div class="progress pricing_progress">
                                <div class="progress-bar progress_bar1" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="price_tag_wrap">
                        <div class="pricing_tag">
                            <div class="col-md-6 pull-right pricing_tag_right">
                                <div class="free">
                                    <h2>Free</h2></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="price_select">
                            Select
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 price_business" href="{{ url('price_business')}}">
                <div class="pricing_content">
                    <div class="pricing_label">Business</div>
                    <div class="pricing_image">
                        <img src="images/price_image2.png" />
                    </div>
                    <div class="pricing_features">
                        <ul>
                            <li><span>Unlimited Calls</span></li>
                            <li><span>API Access</span></li>
                            <li><span>Street, Unit, Level Validation</span></li>
                            <li><span>Auto Correct</span></li>
                            <li><span>GeoCoding</span></li>
                            <li><span>Auto Complete</span></li>
                            <li><span>Reporting</span></li>
                            <li><span>P.O Boxes</span></li>
                            <li class="opacity_zero"><span>P.O Boxes</span></li>
                            <li><span>Server Power: </span><span class="black_text">High</span></li>
                            <div class="progress pricing_progress">
                                <div class="progress-bar progress_bar2" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                    <span class="sr-only">70% Complete</span>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="price_tag_wrap">
                        <div class="pricing_tag">
                            <div class="col-md-5 col-sm-5 col-xs-5 pricing_tag_left">
                                <span>Monthly</span>
                                <h2><span>$</span>99</h2>
                                <h4>Inc GST</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 pull-right pricing_tag_right green_border">
                                <div>
                                    <span><span class="black_text">Save $118 </span>Yearly</span>
                                    <h2><span>$</span>1.000</h2>
                                    <h4>Inc GST</h4>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="price_select">
                            Select
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 price_enterprise" href="{{ url('price_enterprise')}}">
                <div class="pricing_content">
                    <div class="pricing_label">Enterprise</div>
                    <div class="pricing_image">
                        <img src="images/price_image3.png" />
                    </div>
                    <div class="pricing_features">
                        <ul>
                            <li><span>Unlimited Calls</span></li>
                            <li><span>API Access</span></li>
                            <li><span>Street, Unit, Level Validation</span></li>
                            <li><span>Auto Correct</span></li>
                            <li><span>GeoCoding</span></li>
                            <li><span>Auto Complete</span></li>
                            <li><span>Reporting</span></li>
                            <li><span>P.O Boxes</span></li>
                            <li class="opacity_zero"><span>P.O Boxes</span></li>
                            <li><span>Server Power: </span><span class="green_text">Extreme</span></li>
                            <div class="progress pricing_progress">
                                <div class="progress-bar progress_bar3" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                    <span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="price_tag_wrap">
                        <div class="pricing_tag">
                            <div class="col-md-6 pull-right pricing_tag_right">
                                <div>
                                    <span>Yearly</span>
                                    <h2><span>$</span>2.000</h2>
                                    <h4>Inc GST</h4>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="price_select">
                            Select
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('.price_free').click(function () {
                $('.price_free .price_select').removeClass('activeSelect');
                $('.price_free .pricing_content').removeClass('activeContent');
                $(this).find('.price_select').addClass('activeSelect');
                $(this).find('.pricing_content').addClass('activeContent');
                location.href = 'price_free';
            });
            $('.price_business').click(function () {
                $('.price_business .price_select').removeClass('activeSelect');
                $('.price_business .pricing_content').removeClass('activeContent');
                $(this).find('.price_select').addClass('activeSelect');
                $(this).find('.pricing_content').addClass('activeContent');
                location.href = 'price_business';
            });
            $('.price_enterprise').click(function () {
                $('.price_enterprise .price_select').removeClass('activeSelect');
                $('.price_enterprise .pricing_content').removeClass('activeContent');
                $(this).find('.price_select').addClass('activeSelect');
                $(this).find('.pricing_content').addClass('activeContent');
                location.href = 'price_enterprise';
            });
        });
    </script>

@endsection