@extends('layout.admin_layout')
@section('body')
    <style>
        .p-3 {
            padding: 16px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h4>Danh sách lớp</h4>
                <hr/>
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h4><i class="fa fa-list"></i> Danh sách lớp sinh hoạt</h4>
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
                                            <td><a class="btn btn-sm btn-primary text-white" style="color: white" href="{{route('admin.quanlylop.chitietlop', ['lop_id' => $lopsh_item->id])}}"><i class="fa fa-eye mr-2"></i>Xem</a> </td>
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