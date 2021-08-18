@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Danh sách sinh viên</h5>
                </div>
                <div class="x_content">
                    <form class="row" action="" method="get" onchange="this.submit()">
                        <div class="col-md-3">
                            <label>Lớp sinh hoạt</label>
                            <select name="lop" class="form-control">
                                <option>Chọn lớp</option>
                                @forelse($lop as $item)
                                    <option @if($lop_dangchon == $item->id) selected
                                            @endif value="{{$item->id}}">{{$item->tenlop}}</option>
                                @empty
                                    <option>Không có thông tin</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Năm học</label>
                            <select name=namhoc class="form-control">
                                <option>Chọn năm học</option>
                               @isset($namhoc)
                                    @forelse($namhoc as $item)
                                        <option value="{{$item->namhoc}}" {{$selected_namhoc == $item->namhoc ? "selected" : ""}}>{{$item->namhoc}}</option>
                                    @empty
                                        <option>Vui lòng chọn lớp</option>
                                    @endforelse
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Học kỳ</label>
                            <select name="hocky" class="form-control">
                                <option>Chọn học kỳ</option>
                                <option value="1" {{$selected_hocky == 1 ? "selected" : ""}}>Học kỳ 1</option>
                                <option value="2" {{$selected_hocky == 2 ? "selected" : ""}}>Học kỳ 2</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tìm kiếm</label>
                            <button class="btn btn-sm btn-primary form-control">Tìm kiểm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">ID</th>
                            <th class="column-title">Mã sinh viên</th>
                            <th class="column-title">Họ đệm</th>
                            <th class="column-title">Tên</th>
                            <th class="column-title">Ngày sinh</th>
                            <th class="column-title">Điểm</th>
                            <th class="column-title">Xếp loại</th>
                        </tr>
                        </thead>
                        <tbody>
                           @isset($danhsach)
                               @forelse($danhsach as $key => $value)
                                   <tr>
                                       <td>{{$key+=1}}</td>
                                       <td>{{$value->hodem}}</td>
                                       <td>{{$value->ten}}</td>
                                       <td>{{$value->masv}}</td>
                                       <td>{{\Carbon\Carbon::make($value->ngaysinh)->format("d-m-Y")}}</td>
                                       <td>{{$value->diem}}</td>
                                       <td>{{$value->xeploai}}</td>
                                   </tr>
                               @empty
                                   <tr><td colspan="7">Không có dữ liệu</td></tr>
                               @endforelse
                           @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
