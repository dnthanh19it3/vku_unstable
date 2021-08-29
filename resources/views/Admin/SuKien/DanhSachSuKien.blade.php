@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3">
                <h5 class="mb-3">Quản lý sự kiện</h5>
                <hr/>
                <a class="btn btn-sm btn-primary" href="{{route('ad.sukien.tao')}}">Tạo sự kiện mới</a>
                <ul>
                    <li><a href="#">Tất cả</a></li>
                    <li><a href="#">Đã diễn ra</a></li>
                    <li><a href="#">Sắp tới</a></li>
                </ul>
            </div>
            <div class="bg-white p-3 mt-3">
                <h5 class="mb-3">Quản lý sự kiện</h5>
                <hr/>
                <a class="btn btn-sm btn-primary" href="{{route('ad.sukien.tao')}}">Tạo sự kiện mới</a>
                <ul>
                    <li><a href="#">Tất cả</a></li>
                    <li><a href="#">Đã diễn ra</a></li>
                    <li><a href="#">Sắp tới</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h5>Danh sách</h5>
                <hr/>
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
                                <th>Tên sự kiện</th>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="#"><img src="/examples/images/avatar/1.jpg" class="avatar" alt="Avatar"> Michael Holz</a></td>
                                <td>HK1</td>
                                <td>Admin</td>
                                <td>04/10/2013</td>
                                <td><span class="status text-success">&bull;</span> Active</td>
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
    </div>
@endsection