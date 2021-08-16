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
                <a class="nav-link" href="{{route('danhsachmauView')}}">Quản lý mẫu</a>
                <a class="nav-link" href="{{route('ds_hs')}}">Xử lý đơn từ</a>
                <a class="nav-link" href="{{route('dontuDash')}}">Thống kê</a>
            </nav>
        </div>
        <!-- End Đơn từ -->
        <a class="nav-link" href="{{route('nhapdrl')}}">Tổng hợp KQRL</a>
        <!-- Tạm trú -->
        <a class="nav-link" href="{{route('nhapdrl')}}">Tạm trú</a>
    </div>
</div>
