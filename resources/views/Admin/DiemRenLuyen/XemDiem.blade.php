@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-3 mb-3">
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
                                    <option value="{{$item->namhoc_id}}" {{$selected_namhoc == $item->namhoc_id ? "selected" : ""}}>{{$item->nambatdau."-".$item->namketthuc}}</option>
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
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3">
                <h5>Thống kê</h5>
                <hr/>
            </div>
        </div>
        <div class="col-md-9">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>User <b>Management</b></h2>
                            </div>
                            <div class="col-sm-7">
                                <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
                                <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#"><img src="/examples/images/avatar/1.jpg" class="avatar" alt="Avatar"> Michael Holz</a></td>
                            <td>04/10/2013</td>
                            <td>Admin</td>
                            <td><span class="status text-success">&bull;</span> Active</td>
                            <td>
                                <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="#"><img src="/examples/images/avatar/2.jpg" class="avatar" alt="Avatar"> Paula Wilson</a></td>
                            <td>05/08/2014</td>
                            <td>Publisher</td>
                            <td><span class="status text-success">&bull;</span> Active</td>
                            <td>
                                <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="#"><img src="/examples/images/avatar/3.jpg" class="avatar" alt="Avatar"> Antonio Moreno</a></td>
                            <td>11/05/2015</td>
                            <td>Publisher</td>
                            <td><span class="status text-danger">&bull;</span> Suspended</td>
                            <td>
                                <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="#"><img src="/examples/images/avatar/4.jpg" class="avatar" alt="Avatar"> Mary Saveley</a></td>
                            <td>06/09/2016</td>
                            <td>Reviewer</td>
                            <td><span class="status text-success">&bull;</span> Active</td>
                            <td>
                                <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="#"><img src="/examples/images/avatar/5.jpg" class="avatar" alt="Avatar"> Martin Sommer</a></td>
                            <td>12/08/2017</td>
                            <td>Moderator</td>
                            <td><span class="status text-warning">&bull;</span> Inactive</td>
                            <td>
                                <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                        <ul class="pagination">
                            <li class="page-item disabled"><a href="#">Previous</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item active"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                        <option value="{{$item->namhoc_id}}" {{$selected_namhoc == $item->namhoc_id ? "selected" : ""}}>{{$item->nambatdau."-".$item->namketthuc}}</option>
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
