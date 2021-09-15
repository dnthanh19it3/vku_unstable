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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection