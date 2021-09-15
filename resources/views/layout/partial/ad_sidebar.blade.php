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

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i>Đơn từ<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("admin.thutuc.dashboard")}}">Thống kê</a></li>
                        <li><a href="{{route("danhsachmauView")}}">Mẫu đơn</a></li>
                        <li><a href="{{route("ds_hs")}}">Xử lý đơn</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-home"></i> Đánh giá rèn luyện <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("admin.danhgiarenluyen.index")}}"> Tổng hợp kết quả </a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-home"></i> Quản lý họp lớp <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("ad.hoplop.listhoplop.nullable")}}"> Danh sách biên bản </a></li>
                        <li><a href="{{route("ad.hoplop.noidungdukien.nullable")}}"> Đề xuất nội dung </a></li>
                        <li><a href="{{route("ad.hoplop.tonghopphanhoi.nullable")}}"> Tổng hợp phản hồi </a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-home"></i> Quản lý lớp <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("admin.quanlylop.danhsach")}}">Danh sách lớp</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-home"></i> Quản sự kiện <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("ad.sukien.danhsach")}}">Danh sách sự kiện</a></li>
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
