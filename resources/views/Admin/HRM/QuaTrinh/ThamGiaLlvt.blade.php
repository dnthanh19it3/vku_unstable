@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Quá trình bồi dưỡng</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary" onclick="addModal('#modal_themsua', '#form_themsua',
                                    '{{route('ad.hrm.thamgiallvt.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-plus-circle mr-2"></i>Thêm</button>
                            <button class="btn btn-danger" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.congtacnuocngoai.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-times-circle mr-2"></i>Xoá</button>
                        </div>
                        <!-- Modal them sua -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_themsua">
                            <div class="modal-dialog modal-lg">
                                <form class="modal-content" id="form_themsua" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span id="modalLabel_themsua"></span> Quá trình bồi dưỡng</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content">
                                            <input type="hidden" name="data[ThamgiaLlvt][ma_gv]" id="ma_gv" value="{{$giangvien->ma_gv}}">
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Tên nhân viên:</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control rounded" disabled="" value="{{$giangvien->hodem . " " . $giangvien->ten}}" id="ten_gv">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="ngaynhapngu" class="col-form-label col-3">Ngày nhập ngũ <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input value="" type="date" name="data[ThamgiaLlvt][ngaynhapngu]" id="ngaynhapngu" class="ngaynhapngu_tgllvt form-control rounded hasDatepicker">
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="ngayxuatngu" class="col-3 col-form-label">Ngày xuất ngũ <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input type="date" name="data[ThamgiaLlvt][ngayxuatngu]" id="ngayxuatngu" class="ngayxuatngu_tgllvt form-control rounded hasDatepicker">
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="ThamgiaLlvtQuanham" class="col-3 col-form-label">Quân hàm <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[ThamgiaLlvt][quanham]" id="quanham" class="quanham_tgllvt form-control rounded" maxlength="255" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="ThamgiaLlvtDonvi" class="col-3 col-form-label">Đơn vị <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[ThamgiaLlvt][donvi]" id="donvi" class="donvi_tgllvt form-control rounded" maxlength="255" type="text">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="ThamgiaLlvtChucvu" class="col-3 col-form-label">Chức vụ <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[ThamgiaLlvt][chucvu]" id="chucvu" class="chucvu_tgllvt form-control rounded" maxlength="255" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal xoa -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_xoa">
                            <div class="modal-dialog modal-lg">
                                <form class="modal-content" id="form_xoa" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span id="modalLabel_xoa"></span> Quá trình bồi dưỡng</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn xoá không? Thay đổi của bạn sẽ không thể hoàn tác
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <a href="" id="delete_confirm" class="btn btn-danger"><i class="fa fa-trash mr-2"></i>Xoá</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr class="headings">
                        <th>
                           <input type="checkbox" id="check-all" class="flat">
                        </th>
                        <th class="column-title">STT </th>
                        <th class="column-title">Ngày nhập ngũ </th>
                        <th class="column-title">Ngày xuất ngũ </th>
                        <th class="column-title">Đơn vị </th>
                        <th class="column-title">Quân hàm </th>
                        <th class="column-title">Chức vụ</th>
                        <th class="column-title no-link last"><span class="nobr">Thao tác</span>
                        </th>
                        <th class="bulk-actions" colspan="7">
                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @forelse($data as $key => $item)
                            <tr class="even pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">{{$i++}}</td>
                                <td class=" ">{{$item->ngaynhapngu}}</td>
                                <td class=" ">{{$item->ngayxuatngu}}</td>
                                <td class=" ">{{$item->donvi}}</td>
                                <td class=" ">{{$item->quanham}}</td>
                                <td class=" ">{{$item->chucvu}}</td>
                                <td class=" last">
                                    <button class="btn btn-outline-blue btn-sm btn-primary text-white" onclick="editModal('#modal_themsua', '#form_themsua',
                                            '{{route('ad.hrm.thamgiallvt.sua.post', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}',
                                            '{{route('ad.hrm.thamgiallvt.getdata', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.thamgiallvt.xoa', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr class="even pointer">
                                <td colspan="11" style="font-style: italic; text-align: center"><i class="fa fa-times-circle"></i>&nbsp;Chưa có thông tin!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        function addModal(modal, form, post_url) {
            $(modal).modal();
            $(form).attr('action', post_url);
            console.log($(form).find('textarea, input, select').not('#ma_gv, #ten_gv, _token, input[name="_token"]').val(""));
            document.getElementById('modalLabel_themsua').innerHTML = "Thêm ";
        }
        function deleteModal(modal, delete_url) {
            $(modal).modal();
            $('#delete_confirm').attr('href', delete_url);
            document.getElementById('modalLabel_xoa').innerHTML = "Xoá ";
        }
        function editModal(modal, form, post_url, getdata_url) {
            $(modal).modal();
            $(form).attr('action', post_url);
            document.getElementById('modalLabel_themsua').innerHTML = "Sửa ";
            $('#myModalLabel').innerHTML = "Sửa " + $('#myModalLabel').innerHTML;

            $.ajax({
                url: getdata_url,
                type: 'get',
                cache: false,
                success: function(string){
                    var getData = $.parseJSON(string);
                    customizeForm(getData);
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
        }
        function customizeForm(data){
            console.log(data);
            console.log('Set data for edit');
            let form_input = $('#form_themsua').find('textarea, input, select').not('#ma_gv, #ten_gv, _token, input[name="_token"]');
            for(i = 0; i < form_input.length; i++){
                $('#' + form_input[i].id).val(data[form_input[i].id]);
            }
            // $('#').val(data.);
        }
    </script>
@endsection
@section('custom-css')
    <style>

    </style>
@endsection