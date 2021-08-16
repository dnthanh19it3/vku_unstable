@extends('layout.admin_layout')
@section('body')
    <div class="card">
        <div class="card-header border-bottom">Danh sách mẫu</div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-3">
                        <div class="col-auto">
                            <a href="{{route('themmau')}}" class="btn btn-primary">Thêm mẫu mới</a>
                        </div>
                    </div>
                    <form method="get" action="" id="searchform">
                    <div class="row mb-3">
                        <div class="col-12">
                            <select name="loai_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Chọn danh sách</option>
                                <option value="1">Yêu cầu</option>
                                <option value="0">Đơn</option>
                            </select>
                        </div>
                    </div>
                    </form>
                    <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%" cellspacing="0"
                        role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                    style="width:30px;">STTT
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Name: activate to sort column descending" style="">Tên
                                    đơn
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                    style="width:120px;">Thời gian xử lý
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                    style="width:160px">Hành động
                                </th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Tên hồ sơ</th>
                                <th rowspan="1" colspan="1">Thời gian xử lý</th>
                                <th rowspan="1" colspan="1">Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($danhsachmau as $item)
                                <tr role="row" class="odd" role="button" onclick="window.open('{{route('chitietmauView', ['mau_id' => $item->maudon_id])}}')">
                                    <td class="sorting_1">{{ $i += 1 }}</td>
                                    <td>{{ $item->tenmaudon }}</td>
                                    <td>{{ $item->thoigianxuly }}</td>
                                    <td>
                                        <a class="btn btn-outline-blue btn-sm btn-primary text-white" thref="#" onclick="">Sửa</a>
                                        <a class="btn btn-outline-blue btn-sm btn-danger text-white" thref="#" onclick="">Xoá</a>
                                    </td>
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
    <script>
        $('#searchform').select(function () {
            $('#searchform').submit();
        })
    </script>
@endsection
