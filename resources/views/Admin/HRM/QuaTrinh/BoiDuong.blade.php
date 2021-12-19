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
                                    '{{route('ad.hrm.boiduong.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-plus-circle mr-2"></i>Thêm</button>
                            <button class="btn btn-danger" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.congtacnuocngoai.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-times-circle mr-2"></i>Xoá</button>
                        </div>
                        <!-- Modal them sua -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_themsua">
                            <div class="modal-dialog modal-lg">
                                <form class="modal-content" id="form_themsua" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span id="modalLabel_themsua"></span> quá trình bồi dưỡng</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content">
                                            <input type="hidden" name="data[Quatrinhboiduong][ma_gv]" id="ma_gv" value="{{$giangvien->ma_gv}}">
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Tên nhân viên:</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control rounded rounded" disabled="" value="{{$giangvien->hodem . " " . $giangvien->ten}}" id="ten_gv">
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label" for="ngaybatdau">Từ ngày:</label>
                                                <div class="col-9">
                                                    <input type="date" name="data[Quatrinhboiduong][tungay]" id="tungay" class="form-control rounded">
                                                </div>
                                            </div>


                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label" for="ngayketthuc">Đến ngày:</label>
                                                <div class="col-9">
                                                    <input type="date" name="data[Quatrinhboiduong][denngay]" id="denngay" class="form-control rounded">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongQuyetdinh" class="col-3 col-form-label">Quyết định:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhboiduong][quyetdinh]" id="quyetdinh" class="quyetdinh_qtbd form-control rounded" maxlength="255" type="text">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongNoiboiduong" class="col-3 col-form-label">Trường bồi dưỡng <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhboiduong][noiboiduong]" id="noiboiduong" class="nbd_qtbd form-control rounded" maxlength="255" type="text">
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongNganhdaotaoId" class="col-3 col-form-label">Ngành đào tạo <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhboiduong][nganhdaotao_id]" id="nganhdaotao_id" class="ndt_qtdt form-control rounded form-control rounded-sm">
                                                        <option value="">--</option>
                                                        @foreach($nganhdaotao as $item)<option value="{{$item->key}}"}>{{$item->nganhdaotao}}</option>@endforeach<br/>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongNoidung" class="col-3 col-form-label">Nội dung:</label>
                                                <div class="col-9">
                                                    <textarea name="data[Quatrinhboiduong][noidung]" id="noidung" class="noidung_qtbd form-control rounded" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongNguonkinhphi" class="col-3 col-form-label">Nguồn kinh phí học:</label>
                                                <div class="col-9">
                                                    <input name="data[Quatrinhboiduong][nguonkinhphihoc]" id="nguonkinhphihoc" class="kinhphihoc_qtbd form-control rounded" type="text">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongKinhphihoc" class="col-3 col-form-label">Kinh phí học :</label>
                                                <div class="col-9 form-row">
                                                    <div class="col-10">
                                                        <input name="data[Quatrinhboiduong][kinhphihoc]" id="kinhphihoc" class="kinhphihoc_qtbd form-control rounded" type="number">
                                                    </div>
                                                    <div class="col-2">
                                                        <span style="line-height: 33px">VND</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label for="QuatrinhboiduongNamtotnghiepYear" class="col-3 col-form-label">Năm tốt nghiệp <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Quatrinhboiduong][namtotnghiep]" id="namtotnghiep" label="Năm tốt nghiệp:" class="namtotnghiep_qtbd form-control rounded form-control rounded-sm">
                                                        <option value=""></option>
                                                        @for($i = 1960; $i <= 2030; $i++)
                                                            <option value="{{$i}}">Năm {{$i}}</option>
                                                        @endfor
                                                    </select>
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
                                        <h4 class="modal-title"><span id="modalLabel_xoa"></span> quá trình bồi dưỡng</h4>
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
                        <th class="column-title">Năm tốt nghiệp </th>
                        <th class="column-title">Trường bồi dưỡng</th>
                        <th class="column-title">Ngành đào tạo </th>
                        <th class="column-title">Nguồn kinh phí học </th>
                        <th class="column-title">Kinh phí học </th>
                        <th class="column-title">Quyết định </th>
                        <th class="column-title">Nội dung </th>
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
                                <td class=" ">{{$item->tungay}}</td>
                                <td class=" ">{{$item->denngay}}</td>
                                <td class=" ">{{$item->namtotnghiep}}</td>
                                <td class=" ">{{$item->noiboiduong}}</td>
                                <td class=" ">{{$item->nganhdaotao}}</td>
                                <td class=" ">{{$item->nguonkinhphihoc}}</td>
                                <td class=" ">{{$item->kinhphihoc}}</td>
                                <td class=" ">{{$item->quyetdinh}}</td>
                                <td class=" ">{{$item->noidung}}</td>
                                <td class=" last">
                                    <button class="btn btn-outline-blue btn-sm btn-primary text-white" onclick="editModal('#modal_themsua', '#form_themsua',
                                            '{{route('ad.hrm.boiduong.sua.post', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}',
                                            '{{route('ad.hrm.boiduong.getdata', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.boiduong.xoa', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></button>
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