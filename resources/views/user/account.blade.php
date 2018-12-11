@extends('layout.user')

@section('content')

    <div class="col-lg-12 col-md-12 paddingzero userheader col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="col-md-3 paddingzero text-center active col-xs-6 my_custom_tabs" ><a href="#Details" class="colorlightblue" data-toggle="tab">Details / Notification</a></li>
            <li class="col-md-3 paddingzero text-center col-xs-6 my_custom_tabs" id="planTab"><a href="#Plans" class="colorlightblue" data-toggle="tab">Plans</a></li>
            <li class="col-md-3 paddingzero text-center col-xs-6 my_custom_tabs" id="billingTab"><a href="#Billing" class="colorlightblue" data-toggle="tab">Billing</a></li>
            <li class="col-md-3 paddingzero text-center col-xs-6 my_custom_tabs"><a href="#password_management" class="colorlightblue" data-toggle="tab">Password Management</a></li>
        </ul>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="tab-content" id="tabs">
                <div class="tab-pane active" id="Details">
                    <form action="update_account" method="post" name="frm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <h3 class="colorlightblue paddinguserhead borderbottab">Contact Details</h3>
                    <div class="col-md-12 paddingzero col-xs-12">
                        <div class="col-md-6 paddingleftzero width49 col-xs-12 padsmzero">
                            <div class="borderbottabac accountlab">
                                <h4 class="colorlightblue">Company Name</h4>
                                <input class="form-control colorwhite" name="company_name" type="text" placeholder="Vodlo India Pvt Ltd">
                            </div>
                        </div>
                        <div class="col-md-6 paddingzero col-xs-12">
                            <div class="borderbottabac accountlab">
                                <h4 class="colorlightblue">Contact Name</h4>
                                <input class="form-control colorwhite" name="contact_name" type="text" placeholder="Ashish Bhujadi">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 paddingzero col-xs-12">
                        <div class="col-md-6 paddingleftzero width49 col-xs-12 padsmzero">
                            <div class="borderbottabac accountlab">
                                <h4 class="colorlightblue">Phone No.</h4>
                                <input class="form-control colorwhite" name="phone_number" type="number" placeholder="000 - 0000 0000">
                            </div>
                        </div>
                        <div class="col-md-6 paddingzero col-xs-12">
                            <div class="borderbottabac accountlab">
                                <h4 class="colorlightblue">Email Address</h4>
                                <input class="form-control colorwhite" name="email_address" type="email" placeholder="abcd@abcd.com">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h3 class="colorlightblue paddinguserhead borderbottab margintop30">Updates / News Notification settings</h3>
                    <div class="col-md-12 paddingzero col-xs-12">
                        <div class="col-md-6 paddingzero col-xs-12 width49">
                            <h4 class="colorwhite paddinguserhead margintop30">Updates / News Notification settings
                                <input class="pull-right" type="checkbox" value="">
                            </h4>
                        </div>
                        <div class="col-md-6 paddingzero col-xs-12">
                            <div class="borderbottabac accountlab">
                                <h4 class="colorlightblue">Send Update Notifications To</h4>
                                <input class="form-control colorwhite" type="email" placeholder="abcd@abcd.com">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="paddinguserhead">
                        <button type="submit" class="btn buttongreen pull-right" data-dismiss="modal" id="btn_update">UPDATE</button>
                        <div class="clearfix"></div>
                    </div>
                    </form>
                </div>
                <div class="tab-pane" id="Plans">
                    <div class="borderbottab">
                        <h3 class="colorlightblue paddinguserheadaccount col-md-4 display_inlineb">Plan Details</h3>
                        <div class="btn-group inline pull-right margintop12">
                            <a href="support">
                                <button type="button" class="btn btn-trans btn-lg msgbg cursorhand marginbotmob text-left">Downgrade Plan?&nbsp;&nbsp;&nbsp;&nbsp;<span class="colorwhite">Contact Us</span></button>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="price" id="pricing_wrap">
                        <div class="col-lg-9 col-md-9 col-sm-11 col-xs-12 center-block account_plans paddingzero">
                            <div class="col-md-4 col-sm-4 pricing paddingrightzero">
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
                                            <li><span>Server Power: </span><span class="black_text">LOW</span></li>
                                        </ul>
                                    </div>

                                    <div class="progress pricing_progress">
                                        <div class="progress-bar progress_bar1" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                    <div class="price_tag_wrap">
                                        <div class="pricing_tag">
                                            <div class="col-md-6 pull-right pricing_tag_right text-right pricing-tags-can-click" id="pricing-free-button">
                                                <div class="free">
                                                    <h2>Free</h2></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="price_select">
                                            Current Plan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 pricing paddingrightzero">
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
                                            <li><span>Server Power: </span><span class="orange_text">High</span></li>
                                        </ul>
                                    </div>
                                    <div class="progress pricing_progress">
                                        <div class="progress-bar progress_bar2" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                    <div class="price_tag_wrap">
                                        <div class="pricing_tag">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pricing_tag_left pricing-tags-can-click" id="pricing-business-monthly-button">
                                                <span>Monthly</span>
                                                <h2><span>$</span>99</h2>
                                                <h4>Inc GST</h4>
                                            </div>
                                            <div class="col-lg-6 col-md-7 col-sm-6 col-xs-6 pull-right pricing_tag_right pricing-tags-can-click" id="pricing-business-yearly-button">
                                                <div>
                                                    <span><span class="black_text">Save $118 </span>Yearly</span>
                                                    <h2><span>$</span>1.000</h2>
                                                    <h4>Inc GST</h4>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="price_select">
                                            Current Plan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 pricing paddingrightzero">
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
                                            <li><span>Server Power: </span><span class="green_text">Extreme</span></li>
                                        </ul>
                                    </div>
                                    <div class="progress pricing_progress">
                                        <div class="progress-bar progress_bar3" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                            <span class="sr-only">100% Complete</span>
                                        </div>
                                    </div>
                                    <div class="price_tag_wrap">
                                        <div class="pricing_tag">
                                            <div class="col-md-6 pull-right pricing_tag_right text-right pricing-tags-can-click" id="pricing-enterprise-button">
                                                <div>
                                                    <span>Yearly</span>
                                                    <h2><span>$</span>2.000</h2>
                                                    <h4>Inc GST</h4>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="price_select">
                                            Current Plan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="Billing">
                    <form action="change_billing" method="post" name="billingFrm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <h3 class="colorlightblue paddinguserhead borderbottab">Billing Details</h3>
                    <div class="col-md-12 col-xs-12 paddingzero">
                        <div class="col-md-12 col-xs-12 paddingzero">
                            <div class="col-md-12 col-lg-11 col-xs-12">
                                <div class="radio pull-left width55">
                                    <label class="colorwhite radio-inline">
                                        <input type="radio" checked="checked" value="2" class="payment_radio" name="visaRadio"><span class="marginleft4">Credit Card</span></label>
                                    <img class="widthpx marginleft20" src="images/visa.png">
                                    <img class="widthpx" src="images/mastercard.png">
                                    <img class="widthpx" src="images/amex.png">
                                </div>
                                <div class="radio pull-left">
                                    <label class="colorwhite radio-inline">
                                        <input type="radio" value="3" class="payment_radio" name="paypalRadio"><span class="marginleft4">Paypal</span></label>
                                    <img class="widthpx marginleft20" src="images/paypal.png">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="Cars2" class="desc margintop30">
                                <div class="col-md-12 col-lg-9 paddingzero">
                                    <div class="col-md-5 paddingleftzero col-xs-12 padsmzero">
                                        <div class="borderbottomdrop">
                                            <h4 class="colorlightblue">Card Number</h4>
                                            <input class="form-control colorwhite" type="number" name="cardNumber" placeholder="1234 - 5678 - 9012 - 3456">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 marginsmtop padsmzero">
                                        <div class="borderbottomdrop" id="dropaccount">
                                            <h4 class="colorlightblue">Expires</h4>
                                            <select class="selectpicker width49 pull-left col-xs-6" name="expires1" form="billingForm">
                                                <option>00</option>
                                                <option>01</option>
                                                <option>02</option>
                                            </select>
                                            <select class="selectpicker width49 pull-left col-xs-6" name="expires2" form="billingForm">
                                                <option>00</option>
                                                <option>01</option>
                                                <option>02</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 marginsmtop padsmzero">
                                        <div class="borderbottomdrop">
                                            <h4 class="colorlightblue">Security Code</h4>
                                            <input class="form-control colorwhite quebg paddingright15" type="number" placeholder="0000" name="securityCode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11 paddingzero margintop30 col-xs-12">
                                    <div class="col-md-2 paddingleftzero marginsmtop col-xs-12 padsmzero">
                                        <div class="borderbottomdrop" id="dropaccount">
                                            <h4 class="colorlightblue">Salutation</h4>
                                            <select class="selectpicker width100 pull-left col-xs-6" name="gender" form="billingForm">
                                                <option>Mr.</option>
                                                <option>Mrs.</option>
                                                <option>Ms.</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-xs-12 marginsmtop padsmzero">
                                        <div class="borderbottomdrop" id="dropaccount">
                                            <h4 class="colorlightblue">First Name</h4>
                                            <input class="form-control colorwhite" type="text" placeholder="First Name" name="cardFirstName">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-xs-12 marginsmtop padsmzero">
                                        <div class="borderbottomdrop">
                                            <h4 class="colorlightblue">Last Name</h4>
                                            <input class="form-control colorwhite" type="text" placeholder="Last Name" name="cardLastName">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="Cars3" class="desc" style="display:none">
                                <div class="col-md-12 paddingzero margintop30">
                                    <div class="col-md-6 col-xs-12  marginsmtop padsmzero">
                                        <div class="borderbottomdrop" id="dropaccount">
                                            <h4 class="colorlightblue">Paypal Email Address</h4>
                                            <input class="form-control colorwhite" type="email" placeholder="abcd@abcd.com" name="paypalEmail">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12  marginsmtop padsmzero">
                                        <div class="borderbottomdrop">
                                            <h4 class="colorlightblue">Invoice Email Address</h4>
                                            <input class="form-control colorwhite" type="email" placeholder="abcd@abcd.com" name="invoiceEmail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <h3 class="colorlightblue paddinguserhead borderbottab margintop30">Billing Notifications</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12 paddingzero">
                            <div class="col-md-6">
                                <h4 class="colorwhite paddinguserhead margintop30 col-xs-10 col-sm-10">Alert for low account balance or billing requirements</h4>
                                <div class="col-xs-2 col-sm-2 paddinguserhead margintop30">
                                    <input class="pull-right" type="checkbox" value="" name="billingAlert">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-6 paddingzero">
                                <div class="borderbottabac accountlab">
                                    <h4 class="colorlightblue">Send Update Notifications To</h4>
                                    <input class="form-control colorwhite" type="email" placeholder="abcd@abcd.com" name="billingNotificationEMail">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="paddingzero">
                            <div class="col-md-6">
                                <h4 class="colorwhite paddinguserhead margintop30 col-xs-10 col-sm-10">Send Billing alert 7 days before billing required</h4>
                                <div class="col-xs-2 col-sm-2 paddinguserhead margintop30">
                                    <input class="pull-right" type="checkbox" value="" name="sevenDayAlert">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-6">
                                <button type="button" id="billingUpdateButton" class="btn buttongreen pull-right margintop30" data-dismiss="modal">UPDATE</button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!--    <div class="tab-pane" id="ccc">...Contentaaa...</div>-->
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="password_management">
                    <form action="change_password" method="post" name="frm1">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div class="col-md-6 paddingzero col-xs-12 marginsmtop padsmzero">
                            <h3 class="colorlightblue paddinguserhead borderbottab">Enter Your Old Password</h3>
                            <input class="form-control colorwhite borderbottabac margintop30" type="password" name="old_password" placeholder="Old Password">
                            <input class="form-control colorwhite borderbottabac margintop30" type="password" name="old_password_retype" placeholder="Confirm Old Password">
                        </div>
                        <div class="col-md-6 col-xs-12 marginsmtop padsmzero">
                            <h3 class="colorlightblue paddinguserhead borderbottab">Enter Your New Password</h3>
                            <input class="form-control colorwhite borderbottabac margintop30" type="password" name="new_password" placeholder="New Password">
                            <input class="form-control colorwhite borderbottabac margintop30" type="password" name="new_password_retype" placeholder="Confirm New Password">
                        </div>
                        <div class="clearfix"></div>
                        <div class="paddinguserhead">
                            <button type="button" class="btn buttongreen pull-right" data-dismiss="modal" id="btn_update">UPDATE</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    <div class="clearfix"></div>
    <input type="hidden" id="receive_location" value=" > Account Settings" />
    <input type="hidden" id="receive_username" value="{{$data['username']}}" />
    <input type="hidden" id="receive_plan" value="{{$data['plan']}}" />
    <input type="hidden" id="where" value="{{$data['where']}}" />
    <script type="text/javascript">
        $(document).ready(function () {

            //  chs  //
            var where = $('#where').val();
            if(where == 'Billing') {
                $('.my_custom_tabs').removeClass('active');
                $('#Details').removeClass('active');
                $('#Billing').addClass('active');
                $('#billingTab').addClass('active');
            }
//            $('.my_custom_tabs').removeClass('active');
//            $('.tab-pane').removeClass('active');
//            $('.my_custom_tabs'+where).addClass('active');
//            $('.tab-pane#'+where).addClass('active');
            //  chs  //

            $('.pricing-tags-can-click').removeClass('green_border');
            var current_plan = $('#receive_plan').val();
            console.log("here");
            if (current_plan == 'Free')
            {
                $('#pricing-free-button').addClass('green_border');
            }
            if (current_plan == 'Business-Monthly')
            {
                $('#pricing-business-monthly-button').addClass('green_border');
            }
            if (current_plan == 'Business-Yearly')
            {
                $('#pricing-business-yearly-button').addClass('green_border');
            }
            if (current_plan == 'Enterprise')
            {
                $('#pricing-enterprise-button').addClass('green_border');
            }
            $('.pricing').click(function () {
                $('.pricing .price_select').removeClass('activeSelect');
                $('.pricing .pricing_content').removeClass('activeContent');
                $(this).find('.price_select').addClass('activeSelect');
                $(this).find('.pricing_content').addClass('activeContent');
            });

            $('.pricing-tags-can-click').click(function() {
                
                var new_plan;
                if($(this).attr('id') == 'pricing-free-button'){
                    new_plan = 'Free';
                }
                if($(this).attr('id') == 'pricing-business-monthly-button'){
                    new_plan = 'Business-Monthly';
                }
                if($(this).attr('id') == 'pricing-business-yearly-button'){
                    new_plan = 'Business-Yearly';
                }
                if($(this).attr('id') == 'pricing-enterprise-button'){
                    new_plan = 'Enterprise';
                }
                if(new_plan == current_plan){
                    return;
                }
                if(current_plan == 'Enterprise' || new_plan == 'Free')
                    return;
                if(current_plan == 'Business-Yearly' && new_plan == 'Business-Monthly')
                    return;
                $('.pricing-tags-can-click').removeClass('green_border');
                $(this).addClass('green_border');
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "change_plan",
                    type: 'post',
                    data: {
                        _token: token,
                        new_plan: new_plan,
                        current_plan: current_plan
                    },
                    success: function(result){
                        
                    }
                });
                if (current_plan == 'Free' && new_plan != 'Free') {
                    //console.log('here');
                    $('#planTab').removeClass('active');
                    $('#billingTab').addClass('active');
                    $('#Plans').removeClass('active');
                    $('#Billing').addClass('active');
                }
                current_plan = new_plan;
            });
            
            $('#billingUpdateButton').click(function() {
                var visaRadio;
                if($('input[name$="visaRadio"]').attr('checked') == 'checked'){
                    visaRadio = $('input[name$="visaRadio"]').attr('checked')
                }
                var cardNumber = $('input[name$="cardNumber"]').val();
                var securityCode = $('input[name$="securityCode"]').val();
                var cardFirstName = $('input[name$="cardFirstName"]').val();
                var cardLastName = $('input[name$="cardLastName"]').val();
                var paypalEmail = $('input[name$="paypalEmail"]').val();
                var billingAlert = 0;
                var sevenDayAlert = 0;
                if ( $('input[name^="billingAlert"]:checked').length ){
                    billingAlert = 1;
                }
                if ( $('input[name^="sevenDayAlert"]:checked').length ){
                    sevenDayAlert = 1;
                }
                var expires1 = $('span.filter-option.pull-left').first().html();
                var expires2 = $('span.filter-option.pull-left').eq(1).html();
                var salutation = $('span.filter-option.pull-left').last().html();
                // console.log(expires1+expires2+salutation);
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "change_billing",
                    type: 'post',
                    data: {
                        _token: token,
                        visaRadio: visaRadio,
                        cardNumber: cardNumber,
                        securityCode: securityCode,
                        cardFirstName: cardFirstName,
                        cardLastName: cardLastName,
                        billingAlert: billingAlert,
                        paypalEmail: paypalEmail,
                        sevenDayAlert: sevenDayAlert,
                        expires1: expires1,
                        expires2: expires2,
                        salutation: salutation

                    },
                    success: function(result){
                        
                    }
                });
            });
            
        });


    </script>
    <script>
        $(document).ready(function () {
            $(".payment_radio").click(function () {
                var test = $(this).val();
                if(test == 2) {
                    $("input[name$='visaRadio']").attr("checked", "checked");
                    $("input[name$='paypalRadio']").removeAttr("checked");
                }
                if(test == 3) {
                    $("input[name$='paypalRadio']").attr("checked", "checked");
                    $("input[name$='visaRadio']").removeAttr("checked");
                }
                $("div.desc").hide();
                $("#Cars" + test).show();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('button#btn_update').click(function() {
                if($("input[name='old_password']").val() != $("input[name='old_password_retype']").val()
                        || $("input[name='new_password']").val() != $("input[name='new_password_retype']").val())
                {
                    alert('Your changing information is wrong.');
                    return;
                }
                var old_password = $("input[name='old_password']").val();
                var new_password = $("input[name='new_password']").val();
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "change_password",
                    type: 'post',
                    data: {
                        _token: token,
                        old_password: old_password,
                        new_password: new_password
                    },
                    success: function(result){
                        if(result == 'wrong'){
                            alert('Your old password does not match with what is on record. If you believe this is an error please contact support to reset your password.');
                            return;
                        }
                        alert('Your password has now been updated. On your next log in you will be required to enter your new password.');
                        location.reload(true);
                    }
                });
            });
        });
    </script>

@endsection