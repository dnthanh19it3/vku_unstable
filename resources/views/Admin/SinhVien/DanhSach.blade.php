@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Danh sách sinh viên</h5>
                </div>
                <div class="x_content">
                    <form class="row" action="" method="get">
                        <div class="col-md-3">
                            <label>Mã sinh viên</label>
                            <input name="masv" class="form-control" placeholder="Mã sinh viên">
                        </div>
                        <div class="col-md-3">
                            <label>Lớp sinh hoạt</label>
                            <select name="lop" class="form-control">
                                <option value="">Chọn lớp</option>
                                @foreach($lop as $item)
                                    <option value="{{$item->id}}">{{$item->tenlop}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Ngành</label>
                            <select name="nganh" class="form-control">
                                <option value="">Chọn ngành</option>
                                @foreach($nganh as $item)
                                    <option value="{{$item->id}}">{{$item->tennganh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tìm kiếm</label>
                            <button class="btn btn-sm btn-primary form-control">Tìm kiểm</button>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th>
                                           <input type="checkbox" id="check-all" class="flat">
                                        </th>
                                        <th class="column-title">STT</th>
                                        <th class="column-title">Mã sinh viên</th>
                                        <th class="column-title">Họ và tên</th>
                                        <th class="column-title">Giới tính</th>
                                        <th class="column-title">Lớp</th>
                                        <th class="column-title">Khoa</th>
                                        <th class="column-title">Email</th>
                                        <th class="column-title">SĐT</th>
                                        <th class="column-title no-link last"><span class="nobr">Hành động</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($sinhvien as $key => $item)
                                        <tr class="even pointer">
                                            <td class="a-center ">
                                                <input type="checkbox" class="flat" name="table_records">
                                            </td>
                                            <td class=" ">{{$key+1}}</td>
                                            <td>{{$item->masv}}</td>
                                            <td class=" ">{{$item->hodem . ' ' .$item->ten}}</td>
                                            <td class=" ">{{$item->gioitinh = 0 ? "Nữ" : "Nam"}}</i></td>
                                            <td class=" ">{{$item->tenlop}}</td>
                                            <td class=" ">{{"N/A"}}</td>
                                            <td class="a-right a-right ">{{$item->email}}</td>
                                            <td class="a-right a-right ">{{$item->dienthoai}}</td>
                                            <td class=" last">
                                                <a href="{{route('ad.chitietsv', ['masv' => $item->masv])}}" class="btn btn-sm btn-primary">Xem</a>
                                                <a href="{{route('ad.suasinhvien.canhan', ['masv' => $item->masv])}}" class="btn btn-sm btn-primary">Sửa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{$sinhvien->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
