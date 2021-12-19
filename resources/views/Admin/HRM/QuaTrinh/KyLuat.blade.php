@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">quá trình kỷ luật</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary" onclick="addModal('#modal_themsua', '#form_themsua',
                                    '{{route('ad.hrm.kyluat.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-plus-circle mr-2"></i>Thêm</button>
                            <button class="btn btn-danger" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.congtacnuocngoai.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-times-circle mr-2"></i>Xoá</button>
                        </div>
                        <!-- Modal them sua -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_themsua">
                            <div class="modal-dialog modal-lg">
                                <form class="modal-content" id="form_themsua" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span id="modalLabel_themsua"></span> quá trình kỷ luật</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content">
                                            <input type="hidden" name="data[Quatrinhkyluat][ma_gv]" value="{{$giangvien->ma_gv}}" id="ma_gv">
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Tên nhân viên:</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control rounded" disabled="" value="{{$giangvien->hodem . " " . $giangvien->ten}}" id="ten_gv">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhkyluatNam" class="col-3 col-form-label">Năm bị kỷ luật <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input  name="data[Quatrinhkyluat][nam]" id="nam" class="nam_qtkl form-control rounded" maxlength="4" type="text">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhkyluatKyluatId" class="col-3 col-form-label">Hình thức <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select  name="data[Quatrinhkyluat][kyluat_id]" id="kyluat_id" class="kyluat_qtkl form-control rounded custom-select">
                                                        @foreach($kyluat as $key => $value)
                                                            <option value="{{$value->key}}">{{$value->kyluat}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhkyluatDonvi" class="col-3 col-form-label">Đơn vị kỷ luật <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input  name="data[Quatrinhkyluat][donvi]" id="donvi" class="donvi_qtkl form-control rounded" type="text">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="ngaybatdau" class="col-3 col-form-label">Từ ngày:</label>
                                                <div class="col-9">
                                                    <input type="date"  name="data[Quatrinhkyluat][tungay]" id="tungay" id="ngaybatdau" value="" class="form-control rounded tungay_qtkl hasDatepicker">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="ngayketthuc" class="col-3 col-form-label">Đến ngày:</label>
                                                <div class="col-9">
                                                    <input type="date"  name="data[Quatrinhkyluat][denngay]" id="denngay" id="ngayketthuc" value="" class="form-control rounded denngay_qtkl hasDatepicker">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label" for="QuatrinhkyluatQuyetdinh">Quyết định:</label>
                                                <div class="col-9">
                                                    <input  name="data[Quatrinhkyluat][quyetdinh]" id="quyetdinh" class="form-control rounded quyetdinh_qtkl" maxlength="255" type="text">
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
                                        <h4 class="modal-title"><span id="modalLabel_xoa"></span> quá trình kỷ luật</h4>
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
                        <th class="column-title">Năm </th>
                        <th class="column-title">Hình thức </th>
                        <th class="column-title">Đơn vị kỷ luật </th>
                        <th class="column-title">Đơn từ ngày</th>
                        <th class="column-title">Đơn đến ngày </th>
                        <th class="column-title">Quyết định </th>
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
                                <td class=" ">{{$item->nam}}</td>
                                <td class=" ">{{$item->kyluat}}</td>
                                <td class=" ">{{$item->donvi}}</td>
                                <td class=" ">{{$item->tungay}}</td>
                                <td class=" ">{{$item->denngay}}</td>
                                <td class=" ">{{$item->quyetdinh}}</td>
                                <td class=" last">
                                    <button class="btn btn-outline-blue btn-sm btn-primary text-white" onclick="editModal('#modal_themsua', '#form_themsua',
                                            '{{route('ad.hrm.kyluat.sua.post', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}',
                                            '{{route('ad.hrm.kyluat.getdata', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.kyluat.xoa', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></button>
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
            console.log('Set data for edit')
            $('#nam').val(data.nam);
            $('#kyluat_id').val(data.kyluat_id);
            $('#quyetdinh').val(data.quyetdinh);
            $('#donvi').val(data.donvi);
            $('#tungay').val(data.tungay);
            $('#denngay').val(data.denngay);
            // $('#').val(data.);
        }
    </script>
@endsection
@section('custom-css')
    <style>
        .last {
            width: 120px;
        }
        /*
     * FilePond Custom Styles
     */

        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            background-color: #edf0f4;
        }


        /**
         * Page Styles
         */
        /*html {*/
        /*    padding: 20vh 0 0;*/
        /*}*/

        .filepond--root {
            width:170px;
            margin: 0 auto;
        }

    </style>
@endsection