@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Quá trình hưởng lương</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary" onclick="addModal('#modal_themsua', '#form_themsua',
                                    '{{route('ad.hrm.huongluong.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-plus-circle mr-2"></i>Thêm</button>
                            <button class="btn btn-primary" onclick="editModal('#modal_themsua', '#form_themsua',
                                    '{{route('ad.hrm.congtacnuocngoai.sua.post', ['ma_gv' => $giangvien->ma_gv])}}',
                                    '{{route('ad.hrm.congtacnuocngoai.getdata', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-pencil mr-2"></i>Sửa</button>
                            <button class="btn btn-danger" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.congtacnuocngoai.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-times-circle mr-2"></i>Xoá</button>
                        </div>
                        <!-- Modal them sua -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_themsua">
                            <div class="modal-dialog modal-lg">
                                <form class="modal-content" id="form_themsua" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span id="modalLabel_themsua"></span> quá trình hưởng lương</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content">
                                            <input type="hidden" name="data[Quatrinhhuongluong][ma_gv]" id="ma_gv" value="{{$giangvien->ma_gv}}" id="ma_gv">
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Tên nhân viên:</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control rounded" disabled="" value="{{$giangvien->hodem . " " . $giangvien->ten}}" id="ten_gv">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label class="col-3 col-form-label" for="ngaybatdau">Ngày bắt đầu <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input type="text" name="data[Quatrinhhuongluong][tungay]" id="tungay" id="ngaybatdau" value="30-11-2021" class="tungay_qthl form-control rounded hasDatepicker">
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongNgachcongchucId" class="col-3 col-form-label">Ngạch CC <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhhuongluong][ngachcc_id]" id="ngachcc_id" class="ncc_qthl form-control rounded" >
                                                        <option value="">Chọn</option>
                                                        @if($data != null)
                                                            @foreach($ngachcc as $item)<option value="{{$item->key}}"}>{{$item->ngachcc}}</option>@endforeach<br/>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongBac" class="col-3 col-form-label">Bậc <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][bac]" id="bac" class="bac_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongHeso" class="col-3 col-form-label">Hệ số:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][heso]" id="heso" class="heso_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongChenhlechbaoluu" class="col-3 col-form-label">CLBL:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][chenhlechbaoluu]" id="chenhlechbaoluu" class="clbl_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <div for="" class="col-3"></div>
                                                <div class="col-9">
                                                    <input type="checkbox" name="data[Quatrinhhuongluong][heso85]" id="85" class="h85_qthl" id="h85_qthl"> <label for="h85_qthl" class="align-text-bottom">85%</label>
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcChucvu" class="col-3 col-form-label">PC chức vụ:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_chucvu]" id="pc_chucvu" class="pccv_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcThamnien" class="col-3 col-form-label">TN vượt khung:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_thamnien]" id="pc_thamnien" class="pctn_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcKhuvuc" class="col-3 col-form-label">PC khu vực:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_khuvuc]" id="pc_khuvuc" class="pckv_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcDacbiet" class="col-3 col-form-label">PC đặc biệt:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_dacbiet]" id="pc_dacbiet" class="pcdb_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcThuhut" class="col-3 col-form-label">PC thu hút:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_thuhut]" id="pc_thuhut" class="pcth_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcLuudong" class="col-3 col-form-label">PC lưu động:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_luudong]" id="pc_luudong" class="pcld_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcDochai" class="col-3 col-form-label">PC độc hại:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_dochai]" id="pc_dochai" class="pcdh_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcDacthu" class="col-3 col-form-label">PC đặc thù:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_dacthu]" id="pc_dacthu" class="pcdt_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcUudai" class="col-3 col-form-label">PC ưu đãi:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_uudai]" id="pc_uudai" class="pcud_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcTrachnhiem" class="col-3 col-form-label">PC trách nhiệm:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_trachnhiem]" id="pc_trachnhiem" class="pctrn_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongPcKhac" class="col-3 col-form-label">PC khác:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][pc_khac]" id="pc_khac" class="pckhac_qthl form-control rounded" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="QuatrinhhuongluongLydo" class="col-3 col-form-label">Lý do:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhhuongluong][lydo]" id="lydo" class="lydo_qthl form-control rounded" type="text" >
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
                                        <h4 class="modal-title"><span id="modalLabel_xoa"></span> quá trình hưởng lương</h4>
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
                        <th class="column-title">Ngày bắt đầu </th>
                        <th class="column-title">Chức danh nghề nghiệp </th>
                        <th class="column-title">Bậc </th>
                        <th class="column-title">Hệ số </th>
                        <th class="column-title">CLBL </th>
                        <th class="column-title">85% </th>
                        <th class="column-title">PCCV </th>
                        <th class="column-title">PCKN </th>
                        <th class="column-title">PCKV </th>
                        <th class="column-title">PCĐB </th>
                        <th class="column-title">PCTH </th>
                        <th class="column-title">PCLĐ </th>
                        <th class="column-title">PCĐH </th>
                        <th class="column-title">PCĐT </th>
                        <th class="column-title">TNVK </th>
                        <th class="column-title">Lý do </th>
                        <th class="column-title no-link last"><span class="nobr">Thao tác</span>
                        </th>
                        <th class="bulk-actions" colspan="7">
                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data != null)
                        @php $i = 1 @endphp
                        @forelse($data as $key => $item)
                            <tr class="even pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">{{$i++}}</td>
                                <td class=" ">{{$item->tungay}}</td>
                                <td class=" ">{{$item->ngachcc}}</td>
                                <td class=" ">{{$item->bac}}</td>
                                <td class=" ">{{$item->heso}}</td>
                                <td class=" ">{{$item->chenhlechbaoluu}}</td>
                                <td class=" ">{{$item->heso85 ? "Có" : "Không"}}</td>
                                <td class=" ">{{$item->pc_chucvu}}</td>
                                <td class=" ">N/A</td>
                                <td class=" ">{{$item->pc_khuvuc}}</td>
                                <td class=" ">{{$item->pc_dacbiet}}</td>
                                <td class=" ">{{$item->pc_thuhut}}</td>
                                <td class=" ">{{$item->pc_luudong}}</td>
                                <td class=" ">{{$item->pc_dochai}}</td>
                                <td class=" ">{{$item->pc_dacthu}}</td>
                                <td class=" ">{{$item->pc_thamnien}}</td>
                                <td class=" ">{{$item->lydo}}</td>
                                <td class=" last">
                                    <button class="btn btn-outline-blue btn-sm btn-primary text-white" onclick="editModal('#modal_themsua', '#form_themsua',
                                            '{{route('ad.hrm.huongluong.sua.post', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}',
                                            '{{route('ad.hrm.huongluong.getdata', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.huongluong.xoa', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr class="even pointer">
                                <td colspan="11" style="font-style: italic; text-align: center"><i class="fa fa-times-circle"></i>&nbsp;Chưa có thông tin!</td>
                            </tr>
                        @endforelse
                    @else
                        <tr class="even pointer">
                            <td colspan="11" style="font-style: italic; text-align: center"><i class="fa fa-times-circle"></i><code>Lỗi truy suất! Vui lòng kiểm tra lại!</code></td>
                        </tr>
                    @endif
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