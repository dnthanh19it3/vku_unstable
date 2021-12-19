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
                                    '{{route('ad.hrm.daotao.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-plus-circle mr-2"></i>Thêm</button>
                            <button class="btn btn-danger" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.congtacnuocngoai.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-times-circle mr-2"></i>Xoá</button>
                        </div>
                        <!-- Modal them sua -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_themsua">
                            <div class="modal-dialog modal-lg">
                                <form class="modal-content" id="form_themsua" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span id="modalLabel_themsua"></span> Quá trình đào tạo</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content">
                                            <input type="hidden" name="data[Quatrinhdaotao][ma_gv]" value="{{$giangvien->ma_gv}}" id="ma_gv">
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Tên nhân viên:</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control rounded" disabled="" value="{{$giangvien->hodem . " " . $giangvien->ten}}" id="ten_gv">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Thời gian học <span class="warning"> *</span></label>
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Từ tháng:</label>
                                                            <select name="data[Quatrinhdaotao][thang_nh]" id="thang_nh" class="form-control rounded custom-select">
                                                                <option value="">--</option>
                                                                @for($i = 1; $i <= 12; $i++)
                                                                    <option value="{{$i}}">Tháng {{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label>&nbsp;Năm</label>
                                                            <select name="data[Quatrinhdaotao][nam_nh]" id="nam_nh" class="form-control rounded custom-select">
                                                                <option value="">----</option>
                                                                @for($i = 1960; $i <= 2030; $i++)
                                                                    <option value="{{$i}}">Năm {{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label style="min-width: 60px;">Đến tháng:</label>
                                                            <select name="data[Quatrinhdaotao][thang_tn]" id="thang_tn" class="form-control rounded custom-select">
                                                                <option value="">--</option>
                                                                @for($i = 1; $i <= 12; $i++)
                                                                    <option value="{{$i}}">Tháng {{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label>&nbsp;Năm</label>
                                                            <select name="data[Quatrinhdaotao][nam_tn]" id="nam_tn" class="form-control rounded custom-select">
                                                                <option value="">----</option>
                                                                @for($i = 1960; $i <= 2030; $i++)
                                                                    <option value="{{$i}}">Năm {{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoNoidaotao" class="col-3 col-form-label">Cơ sở đào tạo <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhdaotao][noidaotao]" id="noidaotao" class="noidaotao_qtdt form-control rounded" maxlength="255" type="text"  >
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoQuocgiaId" class="col-3 col-form-label">Quốc gia <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhdaotao][quocgia_id]" id="quocgia_id" class="quocgia_ctnn form-control rounded custom-select"  >
                                                        <option value="">--</option>
                                                        @foreach($quocgia as $item)<option value="{{$item->key}}"}>{{$item->quocgia}}</option>@endforeach<br/>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="trinhdochuyenmon_id" class="col-3 col-form-label">Trình độ đào tạo <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhdaotao][trinhdochuyenmon_id]" id="trinhdochuyenmon_id" class="htdt_qtdt form-control rounded custom-select"  >
                                                        <option value="">--</option>
                                                        @foreach($trinhdochuyenmon as $item)<option value="{{$item->key}}"}>{{$item->trinhdochuyenmon}}</option>@endforeach<br/>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoNganhdaotaoId" class="col-3 col-form-label">Khối ngành <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhdaotao][khoinganh_id]"
                                                            class="UserNganhDaoTaoId form-control rounded custom-select" id="khoinganh_id">
                                                        <option value="">Chọn khối ngành</option>
                                                        @foreach($khoinganh as $item)<option value="{{$item->key}}"}>{{$item->khoinganh}}</option>@endforeach<br/>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="Quatrinhdaotaolinhvuc" class="col-3 col-form-label">Lĩnh vực <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhdaotao][linhvuc_id]" id="linhvuc_id" class="form-control custom-select rounded"  >
                                                        <option value=""> Chọn lĩnh vực</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoHinhthucdaotaoId" class="col-3 col-form-label">Hình thức đào tạo <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhdaotao][hinhthucdaotao_id]" id="hinhthucdaotao_id" class="htdt_qtdt form-control rounded custom-select"  >
                                                        <option value="">--</option>
                                                        @foreach($hinhthucdaotao as $item)<option value="{{$item->key}}"}>{{$item->hinhthucdaotao}}</option>@endforeach<br/>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoBangduoccap" class="col-3 col-form-label">Bằng được cấp <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhdaotao][bangduoccap]" id="bangduoccap" class="bangduoccap_qtdt form-control rounded" maxlength="255" type="text"  >
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoQuyetdinh" class="col-3 col-form-label">Quyết định:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhdaotao][quyetdinh]" id="quyetdinh" class="quyetdinh_qtdt form-control rounded" maxlength="255" type="text"  >
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoNgayky" class="col-3 col-form-label">Ngày ký:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhdaotao][ngayky]" id="ngayky" class="ngayky_qtdt form-control rounded hasDatepicker" type="date"  >
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoNgayHt" class="col-3 col-form-label">Ngày hoàn thành:</label>
                                                <div class="col-9">
                                                    <input type="date" id="QuatrinhdaotaoNgayHt" class="ngayht_qtdt form-control rounded hasDatepicker" name="data[Quatrinhdaotao][ngay_ht]"  >
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="namtotnghiep" class="col-3 col-form-label">Năm tốt nghiệp<span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhdaotao][namtotnghiep]" id="namtotnghiep" label="Năm tốt nghiệp:" class="namtotnghiep_qtdt form-control rounded custom-select"  >
                                                        <option value=""></option>
                                                        @for($i = 1960; $i <= 2030; $i++)
                                                            <option value="{{$i}}">Năm {{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongNguonkinhphi" class="col-3 col-form-label">Nguồn kinh phí học:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhdaotao][nguonkinhphihoc]" id="nguonkinhphihoc" class="kinhphihoc_qtdt form-control rounded" type="text">
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhdaotaoKinhphihoc" class="col-3 col-form-label">Kinh phí học :</label>
                                                <div class="col-9 form-row">
                                                    <div class="col-10">
                                                        <input name="data[Quatrinhdaotao][kinhphihoc]" id="kinhphihoc" class="kinhphihoc_qtdt form-control rounded" type="number">
                                                    </div>
                                                    <div class="col-2" style="padding-top: 15px">
                                                        <span>VND</span>
                                                    </div>
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
                        <th class="column-title">Từ ngày </th>
                        <th class="column-title">Đến ngày </th>
                        <th class="column-title">Cơ sở đào tạo </th>
                        <th class="column-title">Quốc gia </th>
                        <th class="column-title">Trình độ đào tạo </th>
                        <th class="column-title">Khối ngành </th>
                        <th class="column-title">Lĩnh vực </th>
                        <th class="column-title">Hình thức đào tạo </th>
                        <th class="column-title">Bằng </th>
                        <th class="column-title">Nguồn kinh phí </th>
                        <th class="column-title">Kinh phí học </th>
                        <th class="column-title">Quyết định </th>
                        <th class="column-title">Ngày ký </th>
                        <th class="column-title">Trạng thái </th>
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
                                <td class=" ">{{$item->thang_nh . " - ".$item->nam_nh}}</td>
                                <td class=" ">{{$item->thang_tn . " - ".$item->nam_tn}}</td>
                                <td class=" ">{{$item->noidaotao}}</td>
                                <td class=" ">{{$item->quocgia}}</td>
                                <td class=" ">{{$item->trinhdochuyenmon}}</td>
                                <td class=" ">{{$item->khoinganh}}</td>
                                <td class=" ">{{$item->linhvuc}}</td>
                                <td class=" ">{{$item->hinhthucdaotao}}</td>
                                <td class=" ">{{$item->bangduoccap}}</td>
                                <td class=" ">{{$item->nguonkinhphihoc}}</td>
                                <td class=" ">{{$item->kinhphihoc}}</td>
                                <td class=" ">{{$item->quyetdinh}}</td>
                                <td class=" ">{{$item->ngayky}}</td>
                                <td class=" ">N/A</td>
                                <td class=" last">
                                    <button class="btn btn-outline-blue btn-sm btn-primary text-white" onclick="editModal('#modal_themsua', '#form_themsua',
                                            '{{route('ad.hrm.daotao.sua.post', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}',
                                            '{{route('ad.hrm.daotao.getdata', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.daotao.xoa', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></button>
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

            let form_input = $('#form_themsua').find('textarea, input, select').not('#ma_gv, #ten_gv, _token, input[name="_token"]');
            // console.log(form_input.length);
            console.log(data.linhvuc_id)
            loadLinhVuc(data.khoinganh_id, data.linhvuc_id);
            for(i = 0; i < form_input.length; i++){
                $('#' + form_input[i].id).val(data[form_input[i].id]);
            }


            // $('#').val(data.);
        }
        $(document).ready(()=>{
            $('#khoinganh_id').change(() => {
                loadLinhVuc();
            })
        });
        function loadLinhVuc(khoinganh = null, linhvuc = null){
            let khoinganh_id = "";
            if(khoinganh != null){
                khoinganh_id = khoinganh;
            } else {
                khoinganh_id = $('#khoinganh_id').val()
            }
            var strURL = '{{route('ad.hrm.dm.linhvuc.noparam')}}/'+ khoinganh_id;
            console.log(strURL);
            $.ajax({
                url: strURL,
                type: 'get',
                cache: false,
                success: function(string){
                    let getDataRaw = JSON.parse(string);
                    let getData = Object.entries(getDataRaw);


                    var select = document.getElementById('linhvuc_id');
                    select.innerHTML = "<option value=\"\">Chọn</option>";
                    for(let i = 0; i < getData.length; i++){
                        let option = document.createElement('option');
                        option.text = getData[i][1].linhvuc;
                        option.value = getData[i][1].key;
                        if(getData[i][1].key == linhvuc) with (linhvuc){
                            option.selected = true;
                        }
                        select.appendChild(option);
                    }
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
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