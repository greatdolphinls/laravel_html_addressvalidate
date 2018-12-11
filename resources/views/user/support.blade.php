@extends('layout.user')

@section('content')

    <div class="col-lg-12 content_user paddingzero col-sm-12 col-xs-12">
            <div class="col-md-12 first_div col-xs-12">
                <div class="first_div_inner">
                    <h3 class="colorlightblue">Support</h3>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="borderbottab paddinguserhead">
                    <h4 class="colorlightblue lineheight24px">For General Inquiries, Billing or technical support please fill in the following form along with any attachments. </h4>
                    <h4 class="colorlightblue lineheight24px">For technical inquiries please attach screenshots or samples of code for easier identification of required assistance.</h4>
                </div>
            </div>
            <div class="col-md-12 col-xs-12" id="gamer">
                <form id="fileupload" action="support" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="col-md-12 paddingzero margintop30">
                    <div class="col-md-6 paddingrightzero marginbot padsmzero">
                        <div class="borderbottomdrop">
                            <h4 class="colorlightblue">Topic</h4>
                            <select class="selectpicker width100 pull-left" name="topic">
                                <option>API Support</option>
                                <option>Plan type</option>
                                <option>Account Support</option>
                                <option>General Support</option>
                                <option>Billing Support</option>
                                <option>Downgrade Plan</option>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 paddingrightzero marginbot padsmzero">
                        <div class="borderbottomdrop" id="dropaccount">
                            <h4 class="colorlightblue">Subject</h4>
                            <input class="form-control colorwhite" type="text" placeholder="Subject Description" name="subject">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 paddingzero margintop30">
                    <div class="col-md-4 paddingrightzero marginbot padsmzero">
                        <div class="borderbottomdrop" id="dropaccount">
                            <h4 class="colorlightblue">First Name</h4>
                            <input class="form-control colorwhite" type="text" placeholder="First Name" name="firstname" value="{{$data['firstname']}}">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 paddingrightzero marginbot padsmzero">
                        <div class="borderbottomdrop" id="dropaccount">
                            <h4 class="colorlightblue">Last Name</h4>
                            <input class="form-control colorwhite" type="text" placeholder="Last Name" name="lastname" value="{{$data['lastname']}}">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 paddingrightzero marginbot padsmzero">
                        <div class="borderbottomdrop">
                            <h4 class="colorlightblue">Mobile No.</h4>
                            <input class="form-control colorwhite" type="text" placeholder="000 - 0000 0000" name="phone" value="{{$data['phone_number']}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 paddingrightzero margintop30 padsmzero">
                    <div class="form-group borderbottomdrop">
                        <h4 class="colorlightblue">Message</h4>
                        <textarea class="form-control colorwhite resizenone" id="message" rows="6" placeholder="Write Your Message Here...." name="message" maxlength="500"></textarea>
                        <h4 class="colorlightblue lineheight24px text-right"><span id="letters">0</span>/500</h4>
                    </div>
                </div>
                <div class="col-md-12 margt1perc">
                    <div class="attachment_div fileinput-button">
                        <a href="#" class="fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span><img src="images/attachment.png" /></span>
                            <input type="file" name="files[]" multiple="">
                        </a>
                    </div>
                    <div class="progressbar_wrap">
                        <div class="col-md-9 paddingzero" id="files_replace">

                            {{--<div class="col-md-6 first_progressbar paddingrightzero">--}}
                                {{--<div class="progress">--}}
                                    {{--<div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%"></div>--}}
                                    {{--<div class="inner_progress_text">--}}
                                        {{--<span class="supportspan">Screenshot 002.png</span>--}}
                                        {{--<a href="#" class="pull-right"><img src="images/close.png" /></a>--}}
                                        {{--<span class="file_size pull-right">750kb</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </div>
                        <div class="col-md-3 paddingzero">
                            <button class="send_button pull-right" type="submit">
                                <span>send</span>
                                <img src="images/send.png" />
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <div class="clearfix"></div>
    <input type="hidden" id="receive_location" value=" > Support" />
    <input type="hidden" id="receive_username" value="{{$data['username']}}" />

    <script src="js/support.js"></script>

@endsection