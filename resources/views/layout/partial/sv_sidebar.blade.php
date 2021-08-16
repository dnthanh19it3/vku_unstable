<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"><i class="fa fa-book"></i> <span>VKU</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{session('avatar')}}" alt="..." class="img-circle profile_img profile_img_side">
        </div>
        <div class="profile_info">
            <span>Xin chào</span>
            <h2>{{session('hoten')}}</h2>
        </div>
    </div>
    <!-- /menu profile quick info -->
    <br/>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i>Thủ tục một cửa<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("sv.danhsachthutuc")}}">Làm thủ tục</a></li>
                        <li><a href="{{route("sv.theodoidon", ['trangthai' => 'tatca'])}}">Theo dõi tiến độ</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-home"></i> Hồ sơ lý lịch <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("xemhoso")}}">Xem hồ sơ</a></li>
                        <li><a href="{{route("suahoso")}}">Cập nhật lý lịch</a></li>
                        <li><a href="{{route("sv.tamtru.index")}}">Cập nhật tạm trú</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
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
