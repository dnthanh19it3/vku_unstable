@extends('layout.admin_layout')
@section('title', 'Danh sách hồ sơ')
@section('body')
    <style>
        .mb-3 {
            margin-bottom: 8px;
        }
        .bg-white {
            background-color: white;
        }
        .p-3 {
            padding: 16px;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-md-4 col-xl-4 col-lg-4">
            <form method="get" class="bg-white p-3 mb-3">
                <h4>Bộ lọc</h4>
                <hr/>
                <div class="form-group">
                    <span>Loại</span>
                    <select class="form-control" name="loai" id="loai">
                        <option value>Tất cả</option>
                        <option value="0">Đơn</option>
                        <option value="1">Yêu cầu</option>
                    </select>
                </div>
                <div class="form-group">
                    <span>Trạng thái</span>
                    <select class="form-control" name="trangthai" id="trangthai">
                        <option value="">Tất cả</option>
                        @foreach ($trangthai as $item)
                            <option value="{{$item->id}}">{{ $item->tentrangthai }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <span>Tên mẫu</span>
                    <select class="form-control" id="maudon_id" name="maudon_id">
                        <option value="">Tất cả</option>
                        @foreach ($maudon as $item)
                            <option value="{{$item->id}}">{{ $item->tenmaudon }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <span>Mã sinh viên</span>
                    <input type="text" id="masv" class="form-control" name="masv" placeholder="Tìm theo mã sinh viên" />
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" style="width: 100%">Lọc</button>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-md-8 col-xl-8 col-lg-8">
            <div class="bg-white p-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-white">
                            <h4>Danh sách đơn</h4>
                            <HR/>
                            <table data-toggle="table" data-url="tables/data1.json" data-show-refresh="true"
                                   data-show-toggle="true" data-show-columns="true" data-search="true"
                                   data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                                   data-sort-order="desc" class="table table-hover" id="table-wrapper">
                                <thead>
                                <tr>
                                    <th class="bs-checkbox " style="width: 36px; ">
                                        <div class="th-inner "><input name="btSelectAll" type="checkbox"></div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="">
                                        <div class="th-inner sortable">Tên người nộp</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="">
                                        <div class="th-inner sortable">Mã sinh viên<span class="order"><span
                                                    class="caret" style="margin: 10px 5px;"></span></span></div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="">
                                        <div class="th-inner sortable">Tên đơn</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="">
                                        <div class="th-inner sortable">Ngày nộp</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="">
                                        <div class="th-inner sortable">Ngày hết hạn</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="">
                                        <div class="th-inner sortable">Trạng thái</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                 @foreach ($listdon as $key => $item)
                                    <tr data-index="{{$key}}" role="button" onclick="window.open('{{route('xem_hs', ['don_id' => $item->id])}}')">
                                        <td class="bs-checkbox"><input data-index="{{$key}}" name="toolbar1" type="checkbox">
                                        </td>
                                        <td style="width:200px">{{$item->hodem . " " . $item->ten}}</td>
                                        <td style="width:100px">{{$item->masv}}</td>
                                        <td style="">{{$item->tenmaudon}}</td>
                                        <td style="">{{$item->thoigiantao}}</td>
                                        <td style="">{{$item->thoigianhethan}}</td>
                                        <td><span class="badge">{{ $item->tentrangthai }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>

@endsection
@section('custom-script')
    <script type="text/javascript">
        var rowTemplate = '<tr role="button" onclick="window.location=\'<%this.url%>\'">' +
            '<td><input type="checkbox" name="id" value="<%this.hodem + this.ten%>"></td>' +
            '<td><%this.hodem + this.ten%> </td>' +
            '<td><%this.masv%> </td>' +
            '<td><%this.tenmaudon%></td>' +
            '<td><%this.thoigiantao%> </td>' +
            '<td><%this.thoigianhethan%> </td>' +
            '<td><span class="badge>"><%this.tentrangthai%></span></td>' +
            '</tr>';
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('ajax_ds_hs') }}',
                type: "GET",
                dataType: "JSON",
                data: {
                    // trangthai: $('#trangthai').val()
                    // masv: $('#masv').val(),
                    // maudon_id: $('#maudon_id').val(),

                }
            }).done(function(result) {
                $('#table-wrapper').renderTable({
                    template: rowTemplate,
                    data: result,
                    pagination: {
                        rowPageCount: 30 // maximum rows per one page
                    },

                });
            })
            // Auto
            $('#form-filters').change(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ route('ajax_ds_hs') }}',
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        trangthai: $('#trangthai').val(),
                        masv: $('#masv').val(),
                        maudon_id: $('#maudon_id').val(),
                        loai: $('#loai').val()

                    }
                }).done(function(result) {
                    $('#table-wrapper').renderTable({
                        template: rowTemplate,
                        data: result,
                        pagination: {
                            rowPageCount: 30 // maximum rows per one page
                        },
                    });
                })
            })
        })
    </script>
@endsection
