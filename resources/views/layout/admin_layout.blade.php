{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--@include('layout.partial.head')--}}

{{--<body class="nav-md">--}}
{{--<div class="container body">--}}
{{--    <div class="main_container">--}}
{{--        <div class="col-md-3 left_col">--}}
{{--            <div class="left_col scroll-view">--}}
{{--                <!-- menu profile quick info -->--}}
{{--                <!-- /menu profile quick info -->--}}
{{--                <br />--}}

{{--                <!-- sidebar menu -->--}}
{{--                @include('layout.partial.sv_sidebar')--}}
{{--                <!-- /sidebar menu -->--}}

{{--                <!-- /menu footer buttons -->--}}
{{--                <div class="sidebar-footer hidden-small">--}}
{{--                    <a data-toggle="tooltip" data-placement="top" title="Settings">--}}
{{--                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>--}}
{{--                    </a>--}}
{{--                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">--}}
{{--                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>--}}
{{--                    </a>--}}
{{--                    <a data-toggle="tooltip" data-placement="top" title="Lock">--}}
{{--                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>--}}
{{--                    </a>--}}
{{--                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">--}}
{{--                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <!-- /menu footer buttons -->--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- top navigation -->--}}
{{--        <div class="top_nav">--}}
{{--            <div class="nav_menu">--}}
{{--                <div class="nav toggle">--}}
{{--                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>--}}
{{--                </div>--}}
{{--                <nav class="nav navbar-nav">--}}
{{--                    <ul class=" navbar-right">--}}
{{--                        <li class="nav-item dropdown open" style="padding-left: 15px;">--}}
{{--                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                <img src="{{session('avatar')}}" style="object-fit: cover" alt="">{{session('hoten')}}--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">--}}
{{--                                <a class="dropdown-item"  href="{{route('xemhoso')}}"> Hồ sơ</a>--}}
{{--                                <a class="dropdown-item"  href="javascript:;">--}}
{{--                                    <span class="badge bg-red pull-right">50%</span>--}}
{{--                                    <span>Cài đặt</span>--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item"  href="javascript:;">Trợ giúp</a>--}}
{{--                                <a class="dropdown-item"  href="{{route('sv.logout')}}"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li role="presentation" class="nav-item dropdown open">--}}
{{--                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                <i class="fa fa-envelope-o"></i>--}}
{{--                                <span class="badge bg-green">6</span>--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="dropdown-item">--}}
{{--                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
{{--                                        <span>--}}
{{--                            <span>John Smith</span>--}}
{{--                            <span class="time">3 mins ago</span>--}}
{{--                          </span>--}}
{{--                                        <span class="message">--}}
{{--                            Film festivals used to be do-or-die moments for movie makers. They were where...--}}
{{--                          </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="dropdown-item">--}}
{{--                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
{{--                                        <span>--}}
{{--                            <span>John Smith</span>--}}
{{--                            <span class="time">3 mins ago</span>--}}
{{--                          </span>--}}
{{--                                        <span class="message">--}}
{{--                            Film festivals used to be do-or-die moments for movie makers. They were where...--}}
{{--                          </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="dropdown-item">--}}
{{--                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
{{--                                        <span>--}}
{{--                            <span>John Smith</span>--}}
{{--                            <span class="time">3 mins ago</span>--}}
{{--                          </span>--}}
{{--                                        <span class="message">--}}
{{--                            Film festivals used to be do-or-die moments for movie makers. They were where...--}}
{{--                          </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="dropdown-item">--}}
{{--                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
{{--                                        <span>--}}
{{--                            <span>John Smith</span>--}}
{{--                            <span class="time">3 mins ago</span>--}}
{{--                          </span>--}}
{{--                                        <span class="message">--}}
{{--                            Film festivals used to be do-or-die moments for movie makers. They were where...--}}
{{--                          </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <div class="text-center">--}}
{{--                                        <a class="dropdown-item">--}}
{{--                                            <strong>See All Alerts</strong>--}}
{{--                                            <i class="fa fa-angle-right"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /top navigation -->--}}

{{--        <!-- page content -->--}}
{{--        <div class="right_col" role="main">--}}
{{--            <div class="">--}}
{{--                <div class="page-title">--}}
{{--                    <div class="title_left">--}}
{{--                        <h3>@yield('title')</h3>--}}
{{--                    </div>--}}

{{--                    <div class="title_right">--}}
{{--                        <div class="col-md-5 col-sm-5   form-group pull-right top_search">--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="Search for...">--}}
{{--                                <span class="input-group-btn">--}}
{{--                      <button class="btn btn-default" type="button">Go!</button>--}}
{{--                    </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @php--}}
{{--                    renderNotify();--}}
{{--                @endphp--}}
{{--                <div class="clearfix"></div>--}}

{{--                <div class="row">--}}
{{--                    @yield('body')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /page content -->--}}

{{--        <!-- footer content -->--}}
{{--        <footer >--}}
{{--            <div class="pull-right">--}}
{{--                Ứng dụng quản lý sinh viên  <a href="https://colorlib.com">VKU</a>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--        </footer>--}}
{{--        <!-- /footer content -->--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- jQuery -->--}}
{{--<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>--}}
{{--<!-- Bootstrap -->--}}
{{--<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
{{--<!-- FastClick -->--}}
{{--<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>--}}
{{--<!-- NProgress -->--}}
{{--<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>--}}
{{--<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>--}}
{{--<!-- Table JS -->--}}
{{--<script src="{{asset('js/table-render.js')}}"></script>--}}
{{--<!-- Custom Theme Scripts -->--}}

{{--<script src="{{asset('build/js/custom.min.js')}}"></script>--}}
{{--@yield('custom-script')--}}
{{--</body>--}}
{{--</html>--}}


        <!DOCTYPE html>
<html lang="en">
@include('layout.partial.head')

<body class="nav-md footer_fixed">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                {{--                <div class="navbar nav_title" style="border: 0;">--}}
                {{--                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>--}}
                {{--                </div>--}}

                <div class="clearfix"></div>

                <!-- menu profile quick info -->

                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
            @include('layout.partial.ad_sidebar')
            <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="images/img.jpg" alt="">John Doe
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">Help</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('body')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- FastClick -->
<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<!-- Table JS -->
<script src="{{asset('js/table-render.js')}}"></script>
<!-- Custom Theme Scripts -->

<script src="{{asset('build/js/custom.min.js')}}"></script>
@yield('custom-script')
</body>
</html>
