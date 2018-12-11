<!DOCTYPE html>
<html lang="en" class="height100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User Control</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/jquery-file-upload/css/jquery.fileupload.css')}}"/>
    <link rel="stylesheet" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css')}}" type="text/css">

    <script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

    <script src="{{ asset('js/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
    <script src="{{ asset('js/jquery-file-upload/js/vendor/tmpl.min.js')}}"></script>
<!--    <script src="{{ asset('js/jquery-file-upload/js/vendor/load-image.min.js')}}"></script>
    <script src="{{ asset('js/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}"></script>
    <script src="{{ asset('js/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}"></script>
    <script src="{{ asset('js/jquery-file-upload/js/jquery.iframe-transport.js')}}"></script>
    -->
    <script src="{{ asset('js/jquery-file-upload/js/jquery.fileupload.js')}}"></script>
    <!--
    <script src="jquery-file-upload/js/jquery.fileupload-process.js')}}"></script>
    <script src="jquery-file-upload/js/jquery.fileupload-image.js')}}"></script>
    <script src="jquery-file-upload/js/jquery.fileupload-audio.js')}}"></script>
    <script src="jquery-file-upload/js/jquery.fileupload-video.js')}}"></script>
    <script src="jquery-file-upload/js/jquery.fileupload-validate.js')}}"></script>
    -->
    <script src="{{ asset('js/jquery-file-upload/js/jquery.fileupload-ui.js')}}"></script>
</head>

<body class="content_user">
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="col-md-12 text-center margintop usercontrolheight">
            <a href="dashboard">
                <img class="widthauto" src="images/logo.png">
            </a>
        </div>
        <ul class="sidebar-nav">
            <!--
            <li class="sidebar-brand text-center">
                <a href="#">
                   <img class="widthauto" src="images/logo.png">
                </a>
            </li>
            -->
            <li class="margintop">
                <img class="dashboardmenu_icons usermenubaricon" src="images/summary.png"><a href="summary_today">Summary</a>
            </li>
            <li>
                <img class="dashboardmenu_icons usermenubaricon" src="images/apidoc.png"><a href="documentation">API Documentation</a>
            </li>
            <li>
                <img class="dashboardmenu_icons usermenubaricon" src="images/invoi.png"><a href="invoice">Invoices</a>
            </li>
            <li>
                <img class="dashboardmenu_icons usermenubaricon" src="images/support.png"><a href="support">Support</a>
            </li>
            <li>
                <img class="dashboardmenu_icons usermenubaricon" src="images/account.png"><a href="account">Account</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <a href="#menu-toggle" class="btn btn-default hidden-md hidden-lg hidden-sm" id="menu-toggle">
            <img src="images/menu-button.png" style="width:25px;"/>
        </a>
        <div class="usercontrol2height userheader">
            <div class="col-md-6 col-sm-5 paddingzero">
                <h3 class="colorwhite paddinguserhead">Dashboard<span class="colorwhite" id="added_title"></span></h3></div>
            <div class="col-md-6 col-sm-7 welcome_text col-xs-12">
                <ul>
                    <li>
                        <p>Welcome, <span class="colorwhite" id="login_name"></span></p>
                    </li>
                    <li>
                        <a href="#" class="profile_pic"><img src="{{asset('images/avatar.png')}}" /></a>
                    </li>
                    <li>
                        <div class="dropdown" id="dropdashboard">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><img class="signicon" src="images/dropdown.png"></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('logout') }}" type="button">Sign Out</a></li>
                                <li><a href="#">Settings</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        @yield('content')
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('js/modernizr.custom.97074.js')}}"></script>
<!-- Menu Toggle Script -->
<script>
    $(document).ready(function () {
        var location = $('input#receive_location').val();
        $('span#added_title').html(location);

        var username = $('input#receive_username').val();
        $('span#login_name').html(username);
    });
</script>
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $('body').toggleClass('overflowapply');
    });
</script>
</body>

</html>