<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading">Đơn thư</div>
        <!-- Đơn từ -->
        <!-- Sidenav Accordion (Flows)-->
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDontu" aria-expanded="false" aria-controls="collapseFlows">
            <div class="nav-link-icon"><i data-feather="repeat"></i></div>
            Đơn từ
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseDontu" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav">
                <a class="nav-link" href="{{route('taodon')}}">Nộp đơn</a>
                <a class="nav-link" href="{{route('dondanop')}}">Đơn đã nộp</a>
            </nav>
        </div>
        <!-- End Đơn từ -->
        <div class="sidenav-menu-heading">Hồ sơ</div>
        <!-- Đơn từ -->
        <!-- Sidenav Accordion (Flows)-->
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDontu" aria-expanded="false" aria-controls="collapseFlows">
            <div class="nav-link-icon"><i data-feather="repeat"></i></div>
            Hồ sơ
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseDontu" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav">
                <a class="nav-link" href="{{route('suahoso')}}">Cập nhật hồ sơ</a>
                {{-- <a class="nav-link" href="{{route('dondanop')}}">Đơn đã nộp</a> --}}
            </nav>
        </div>
        <!-- CV -->
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCv" aria-expanded="false" aria-controls="collapseFlows">
            <div class="nav-link-icon"><i data-feather="repeat"></i></div>
            Cv
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseCv" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav">
                {{-- <a class="nav-link" href="{{route('taocv')}}">Tạo CV</a> --}}
                {{-- <a class="nav-link" href="{{route('dondanop')}}">Đơn đã nộp</a> --}}
            </nav>
        </div>
    </div>
</div>