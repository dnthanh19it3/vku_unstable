@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h5>Danh sách lớp</h5>
                <hr/>
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2>Danh sách lớp sinh hoạt</h2>
                                </div>
                                <div class="col-sm-7">

                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên lớp</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($khoa as $key_khoa => $khoa_item)
                                <tr>
                                    <td colspan="7"><b><center>{{$khoa_item->khoaK}}</center></b></td>
                                </tr>
                                    @foreach($khoa_item->lopsh as $key_losh => $lopsh_item)
                                        <tr>
                                            <td>#</td>
                                            <td>{{$lopsh_item->tenlop}}</td>
                                            <td><a class="" href="{{route('admin.quanlylop.chitietlop', ['lop_id' => $lopsh_item->id])}}"><i class="fas fa-eye mr-2"></i>Xem</a> </td>
                                        </tr>
                                    @endforeach

                            @endforeach
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