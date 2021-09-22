@extends('layout.admin_layout')
@section('body')

    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3 mb-3">
                <h5 class="mb-3">Danh mục</h5>
                <hr/>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.quanlylop.chitietlop', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-home"></i>
                                Danh sách lớp </a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.khenthuongkyluat', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Khen thưởng kỷ luật</a>
                        </li>
                        <li  class="active">
                            <a href="{{route('admin.quanlylop.diemrenluyen', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Kết quả rèn luyện</a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.bancansu', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Ban cán sự</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bg-white p-3">
                <h5 class="mb-3">Thống kê</h5>
                <hr/>
                <canvas id="thongke"></canvas>
            </div>
        </div>
        <div class="col-md-9">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>Đánh giá rèn luyện</h5>
                            </div>
                            <div class="col-sm-7">
                                <form id="formhocky" method="get" action="" onchange="this.submit()">
                                    <select name="hocky" class="form-control rounded">
                                        <option readonly>Chọn học kỳ</option>
                                        @forelse($danhsachhocky as $item)
                                            <option value="{{$item->namhoc."_".$item ->hocky}}">HK{{$item ->hocky}} {{$item->nambatdau."-"."$item->namketthuc"}}</option>
                                        @empty
                                            <option disabled>Chưa có kết quả</option>
                                        @endforelse
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="column-title">Họ và tên</th>
                            <th class="column-title">Mã sinh viên</th>
                            <th class="column-title">Ngày sinh</th>
                            <th class="column-title">Điểm</th>
                            <th class="column-title">Xếp loại</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($ketquadanhgia as $key => $item)
                                <tr>
                                <td>{{$key+=1}}</td>
                                <td>{{$item->hodem ." ". $item->ten}}</td>
                                <td>{{$item->masv}}</td>
                                <td>{{$item->ngaysinh}}</td>
                                <td>{{$item->diem}}</td>
                                <td>{{$item->xeploai}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <script>

        const xeploai = @json($ketquadanhgia_thongke['xeploai']);
        const soluong = @json($ketquadanhgia_thongke['soluong']);


        new Chart(document.getElementById("thongke"), {
            type: 'pie',
            data: {
                labels: xeploai,
                datasets: [{
                    label: "Biểu đồ phân hoá xếp loại rèn luyện",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: soluong
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Biểu đồ phân hoá xếp loại rèn luyện",
                }
            }
        });




        $(document).ready(()=>{
            var ctx = document.getElementById('thongke').getContext('2d');
            window.myPie = new Chart(ctx, config);
        })
    </script>
@endsection
