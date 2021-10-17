@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h5>Danh sách mẫu</h5>
                <hr/>
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2>Danh sách mẫu khảo sát</h2>
                                </div>
                                <div class="col-sm-7">
                                    <a href="{{route('admin.khaosat.taokhaosat')}}" class="btn     btn-primary"><i class="fa fa-plus-circle"></i>Tạo khảo sát</a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên đơn</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhật</th>
                                <th style="width: auto">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($ds_mau as $item)
                                <tr>
                                    <td class="sorting_1">{{ $i += 1 }}</td>
                                    <td>{{ $item->tenmau }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td style="display: flex;flex-direction: row">
                                        <a class="btn btn-outline-blue btn-sm btn-primary text-white" href="{{route('admin.khaosat.suakhaosat', ['id' => $item->id])}}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-outline-blue btn-sm btn-success text-white" href={{route('admin.khaosat.baocao', ['id' => $item->id])}}><i class="fa fa-chart-pie"></i></a>
                                        <button type="button" class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="confirm('{{route('admin.khaosat.xoakhaosat', ['id' => $item->id])}}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Huỷ">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có muốn xoá mẫu <span></span> không? Thay đổi này không thể hoàn tác!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
                    <a id="delete_link" href="" class="btn btn-danger">Xác nhận xoá</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
<script>
    function confirm(link){
        document.getElementById('delete_link').setAttribute('href', link);
        $('#deleteModal').modal('show')
    }
</script>
@endsection
