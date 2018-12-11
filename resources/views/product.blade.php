@extends('layout.app')

@section('content')

    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/avs.css" type="text/css" media="screen" charset="utf-8" />

    <script type="text/javascript">
        $(function () {
            $('.gallery-grids a').Chocolat();
        });
    </script>
    <script type="text/javascript" src="js/avs/avs_client.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //$('#map').css('opacity','0');
            $('#address-input').focusin(function () {
                //alert( "Handler for .focus() called." );
                $('#map_video').fadeOut();
                //$('#map').css('opacity','1');
            });
            var options = {
                spellcheck: true,
                synonym: true,
                autocompletion: true,
                randompos: true,
                geopos: true,
                breaking: {
                    value: true,
                    components: {
                        street: "streetnumDiv",
                        suburb: "suburbDiv",
                        postcode: "postcodeDiv",
                        state: "stateDiv"
                    }
                },
                script: "valid_address",
                callback: function (obj) {}
            };
            var avs_json = new AutoSuggest('AVS', 'AVS', 'address-input', options);
        });
        //$('#address-input').focusout(function() {
        //alert( "Handler for .focus() called." );
        //$('#map_video').fadeIn();
        //initMap();
        //});
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll, .navbar li a, .footer li a").click(function (event) {
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
            $('.idea,.idea1').hide();
            $('#auto_fill_text').hide();
            load();
        });
    </script>
    <script defer src="js/jquery.flexslider.js"></script>



    <!-- Header -->
    <div class="home_header" id="home_header">
        <div id="map"></div>
        <div id="map_video">
            <!--<video height="100%" autoplay loop>
               <source src="images/video.mp4" type="video/mp4">
               <source src="images/video.ogg" type="video/ogg"> Your browser does not support the video tag.
            </video>-->
            <div class="marker_wrap">
                <div class="pin1"></div>
                <div class="pin2"></div>
                <div class="pin3"></div>
            </div>
        </div>
        <div class="home_logo">
            <a href="./"><img src="images/logo2.png"></a>
        </div>
        <div class="top-navg">
            <div id="toggle_m_nav" href="#">
                <div id="m_nav_menu" class="m_nav">
                    <div class="m_nav_ham" id="m_ham_1"></div>
                    <div class="m_nav_ham" id="m_ham_2"></div>
                    <div class="m_nav_ham" id="m_ham_3"></div>
                </div>
            </div>
            <!-- This is the general container and content that makes up the navbar itself -->
            <nav id="c-menu--slide-right" class="col-lg-4 col-md-5 col-sm-6 col-xs-6 c-menu c-menu--slide-right">
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
        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-6 home_right_top">
            <div class="col-md-10 center-block home_right_inner">
                <h1>The Most Intelligent, Accurate and Flexible Address Validation Service</h1>
                <input class="type_text" placeholder="Start typing to look up an address" type="text" id="address-input" />
                <div class="sub_wrap">
                    <div class="col-md-6 first_column">
                        <div class="type-wrap2" id="streetnumDiv">Street Number</div>
                    </div>
                    <div class="col-md-6 last_column">
                        <div class="type-wrap2" id="suburbDiv">Suburbs</div>
                    </div>
                </div>
                <div class="sub_wrap">
                    <div class="col-md-6 first_column">
                        <div class="type-wrap2" id="postcodeDiv">Post Code</div>
                    </div>
                    <div class="col-md-6 last_column">
                        <div class="type-wrap2" id="stateDiv">State</div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
    </div>
    <!-- //Header -->
    <!-- About -->
    <div class="about" id="about">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid odd">
                <h4>Auto Correction</h4>
                <h5 class="caption_text">Should the use spell a street or suburb name wrong, we can suggest some close ones</h5>
            </div>
            <div class="col-md-6 col-sm-6 about-grid auto_correction text-center">
                <!--<div class="wrap">
                    <div class="idea">
                        <p style="font-style:italic;color:#B6B6B6;">Did you mean:</p>
                        <h1 style="font-weight:100;color:#232323" id="idea_h3">12 George Street</h1>
                    </div>
                    <div class="type-wrap">
                        <div id="typed-strings">
                            <h3>12 Jorge Street</h3>
                            <h3>12 George Street</h3>
                            <p>It <em>types</em> out sentences.</p>
                            <p>And then deletes them.</p>
                            <p>Try it out!</p>
                        </div>
                        <span id="typed" style="white-space:pre;"></span>
                    </div>
                </div>-->
                <img src="images/spell-correct.gif" />
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //About -->
    <!-- Details -->
    <div class="about" id="details">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid search_autofill text-center details_image">
                <!--<img src="images/Group 3-1.png" />-->
                <!--<div class="wrap">
                    <div class="type-wrap1">
                        <div id="typed-strings4">
                            <h3>12 George Street, Sydney</h3>
                        </div>
                        <span id="typed4" style="white-space:pre;"></span>
                    </div>
                    <div class="sub_wrap">
                        <div class="col-md-6 first_column">
                            <div class="type-wrap2" id="street_number">Street Number</div>
                        </div>
                        <div class="col-md-6 last_column">
                            <div class="type-wrap2" id="suburbs">Suburbs</div>
                        </div>
                    </div>
                    <div class="sub_wrap">
                        <div class="col-md-6 first_column">
                            <div class="type-wrap2" id="post_code">Post Code</div>
                        </div>
                        <div class="col-md-6 last_column">
                            <div class="type-wrap2" id="state">State</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>-->
                <img src="images/auto_fill.gif" />
            </div>
            <div class="col-md-6 col-sm-6 about-grid even details_text">
                <h4>Auto Fill Components</h4>
                <h5 class="caption_text">Each component of the address is broken down. Super handy for filling forms and databases.</h5>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //Details -->
    <!-- Clients -->
    <div class="about" id="synonym">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid synonym_text">
                <h4>Synonym Aware</h4>
                <h5 class="caption_text">People use different words for the same thing. For example Unit and Suite, We take care of this.</h5>
            </div>
            <div class="col-md-6 col-sm-6 about-grid text-center synonym_image search2">
                <!--<img src="images/search-1.png" />-->
                <!--<div class="wrap">
                    <div class="idea1">
                        <p style="font-style:italic;color:#B6B6B6;">Unit 12 &amp; George Street are interchangeable</p>
                        <h1 style="font-weight:100;color:#232323" id="idea_h2">Unit 12, George Street, Sydney</h1>
                    </div>
                    <div class="type-wrap">
                        <div id="typed-strings2">
                            <h3>12 George Street, Sydney</h3>
                            <p>It <em>types</em> out sentences.</p>
                            <p>And then deletes them.</p>
                            <p>Try it out!</p>
                        </div>
                        <span id="typed2" style="white-space:pre;"></span>
                    </div>
                </div>-->
                <img src="images/synonym.gif" />
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //Clients -->
    <!--<div class="col-md-12 col-sm-12 col-xs-12 siri_wrap">
        <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
            <img src="images/siri-like.gif" class="img-responsive" />
        </div>
    </div>-->
    <!-- Clients -->
    <div class="about" id="auto_completion">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid text-center auto_completion_image search1">
                <!--<img src="images/Group 3.png" />-->
                <!--<div class="wrap">
                    <div class="type-wrap1">
                        <div id="typed-strings3">
                            <h3>12 George</h3>
                        </div>
                        <span id="typed3" style="white-space:pre;"></span>
                        <span id="auto_fill_text">Street, Sydney, NSW, 2000</span>
                    </div>
                </div>-->
                <img src="images/auto_completion.gif" />
            </div>
            <div class="col-md-6 col-sm-6 about-grid even auto_completion_text">
                <h4>Auto Completion</h4>
                <h5 class="caption_text">There is no need for the user to type their whole address, we can autocomplete the rest to save time.</h5>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //Clients -->
    <!-- Who -->
    <div class="who" id="start_anywhere">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 who-grid start_anywhere_text">
                <h4>Start Anywhere</h4>
                <h5 class="caption_text">Starts from the suburb, the street or the number. Doesn't matter, the same result will be shown.</h5>
            </div>
            <div class="col-md-6 col-sm-6 who-grid text-center start_anywhere_image search2">
                <!--<img src="images/search.png" />-->
                <!--<div class="wrap">
                    <div class="idea2">
                        <p style="font-style:italic;color:#B6B6B6;">Did you mean:</p>
                        <h1 style="font-weight:100;color:#232323" id="idea_h1">12 George Street, Sydney</h1>
                    </div>
                    <div class="type-wrap">
                        <div id="typed-strings5">
                            <h3>George Street 12 Sydney</h3>
                        </div>
                        <span id="typed5" style="white-space:pre;"></span>
                    </div>
                </div>-->
                <img src="images/start_anywere.gif" />
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //Who -->
    <!-- Details -->
    <div class="about" id="geo">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid text-center search_geo">
                <img src="images/geo-location.gif" />
            </div>
            <div class="col-md-6 col-sm-6 about-grid even geo_text">
                <h4>Geo Coded Addresses</h4>
                <h5 class="caption_text">Each address is Geocoded so the exact map location can be used, referenced or saved without trouble.</h5>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- <div class="col-md-12 col-sm-12 col-xs-12 siri_wrap">
        <div class="col-md-6 col-sm-12 col-xs-12 left_siri">
            <img src="images/siri-like.gif" class="img-responsive" />
        </div>
    </div>-->
    <!-- Details -->
    <div class="about" id="all_encompassing">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid">
                <h4>All Encompassing</h4>
                <h5 class="caption_text">Every address is covered. This includes Post Office Boxes and Unit Numbers</h5>
            </div>
            <div class="col-md-6 col-sm-6 about-grid text-center all_encompassing_img">
                <img src="images/all-encompass.gif" />
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Details -->
    <div class="about" id="sdk_api">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid text-center search_sdk">
                <img src="images/sdk-box.gif">
            </div>
            <div class="col-md-6 col-sm-6 about-grid even sdk_text">
                <h4>SDK and API</h4>
                <h5 class="caption_text">Mobile and Web ready out of the box. Just plug and play with as little development needed</h5>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Details -->
    <div class="about" id="update_regularly">
        <div class="col-lg-10 col-sm-11 col-xs-11 center-block">
            <div class="col-md-6 col-sm-6 about-grid">
                <h4>Updated Regularly</h4>
                <h5 class="caption_text">Our database is checked and updated every three months so that new properties don't get missed.</h5>
            </div>
            <div class="col-md-6 col-sm-6 about-grid text-center search3">
                <img src="images/add-location.gif" />
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--<div class="col-md-12 col-sm-12 col-xs-12 siri_wrap">
        <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
            <img src="images/siri-like.gif" class="img-responsive" />
        </div>
    </div>-->
    <div class="register_now" id="register_now">
        <div class="col-md-5 text-center center-block">
            <h2>Register Now, It's Free</h2>
            <div class="signup_wrap">
                <input class="more_btn" value="Sign up" type="submit" />
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <div class="col-lg-10 col-sm-11 col-xs-12 center-block">
            <div class="col-md-6 copyright">
                <p>Vodlo &copy; 2016. All Rights Reserved</p>
            </div>
            <div class="col-md-6 footer_right">
                <ul>
                    <li><a href="#">Terms &amp; condition</a></li>
                    <li><a href="#">F.A.Q</a></li>
                    <li><a href="#">Contact US</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <a href="#" id="toTop"> <span id="toTopHover"> </span></a>
    <div id="c-mask" class="c-mask"></div>

    <script type="text/javascript">
        /**
         * Slide right instantiation and action.
         */
        var slideRight = new Menu({
            wrapper: '#home_header',
            type: 'slide-right',
            menuOpenerClass: '.m_nav',
            maskId: '#c-mask'
        });
        var slideRightBtn = document.querySelector('#m_nav_menu');
        slideRightBtn.addEventListener('click', function (e) {
            e.preventDefault;
            slideRight.open();
        });
    </script>

@endsection