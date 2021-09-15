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
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr role="headings">
                                <th class="column-title">STTT
                                </th>
                                <th class="column-title">Tên
                                    đơn
                                </th>
                                <th class="column-title">Thời gian xử lý
                                </th>
                                <th class="column-title">Hành động
                                </th>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($danhsachmau as $item)
                                <tr role="row" class="odd" role="button"">
                                    <td class="sorting_1">{{ $i += 1 }}</td>
                                    <td>{{ $item->tenmaudon }}</td>
                                    <td>{{ $item->thoigianxuly }}</td>
                                    <td>
                                        <a class="btn btn-outline-blue btn-sm btn-primary text-white" href="{{route('chitietmauView', ['mau_id' => $item->maudon_id])}}">Sửa</a>
                                        <a class="btn btn-outline-blue btn-sm btn-danger text-white" href="{{route('maudon.Delete', ['mau_id' => $item->maudon_id])}}">Xoá</a>
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
