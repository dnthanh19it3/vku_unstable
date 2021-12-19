@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Quá trình công tác nước ngoài</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary" onclick="addModal('#modal_themsua', '#form_themsua',
                                    '{{route('ad.hrm.hopdong.them.post', ['ma_gv' => $giangvien->ma_gv])}}')"><i class="fa fa-plus-circle mr-2"></i>Thêm</button>
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
                                        <h4 class="modal-title"><span id="modalLabel_themsua"></span> quá trình công tác nước ngoài</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content">
                                            <input type="hidden" name="data[Hopdong][ma_gv]" value="{{$giangvien->ma_gv}}" id="ma_gv">
                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label">Tên nhân viên:</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control rounded rounded" disabled="" value="{{$giangvien->hodem . " " . $giangvien->ten}}" id="ten_gv">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label class="col-3 col-form-label" for="ngayky">Ngày ký <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input type="date" name="data[Hopdong][ngayky]" id="ngayky" class="ngayky_hdld form-control rounded">
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label for="HopdongLoaicanboId" class="col-3 col-form-label">Loại hợp đồng <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <select name="data[Hopdong][loaicanbo_id]" id="loaicanbo_id" class="loaihopdong_hdld form-control rounded">
                                                        @foreach($loaicanbo as $item)<option value="{{$item->key}}"}>{{$item->loaicanbo}}</option>@endforeach<br/>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <div class="col-3"></div>
                                                <div class="col-9">
                                                    <input type="checkbox" id="voth"> <label class="align-text-bottom" for="voth">&nbsp;Hợp đồng vô thời hạn</label>
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label" for="ngayhopdong">Ngày hợp đồng <span class="warning"> *</span>:</label>
                                                <div class="col-9">
                                                    <input type="date" name="data[Hopdong][tungay]" id="tungay" value="" class="ngayhd_hdld form-control rounded">
                                                </div>
                                            </div>

                                            <div class="form-row form-group">
                                                <label class="col-3 col-form-label" for="ngayhethan">Ngày hết hạn:</label>
                                                <div class="col-9">
                                                    <input type="date" name="data[Hopdong][denngay]" id="denngay" class="ngayhh_hdld form-control rounded">
                                                </div>
                                            </div>

                                            <div class="form-group form-row">
                                                <label class="col-3 col-form-label" for="HopdongFile">Đính kèm file:</label>
                                                <div class="col-9">
                                                    <input type="file" name="data[Hopdong][file]" id="file" class="dinhkem_hdld">
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
                                        <h4 class="modal-title"><span id="modalLabel_xoa"></span> quá trình công tác nước ngoài</h4>
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
                        <th class="column-title">Loại </th>
                        <th class="column-title">Ngày ký </th>
                        <th class="column-title">Ngày bắt đầu </th>
                        <th class="column-title">Ngày kết thúc </th>
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
                                <td class=" ">{{$item->loaicanbo}}</td>
                                <td class=" ">{{$item->ngayky}}</td>
                                <td class=" ">{{$item->tungay}}</td>
                                <td class=" ">{{$item->denngay}}</td>
                                <td class=" last">
                                    <button class="btn btn-outline-blue btn-sm btn-primary text-white" onclick="editModal('#modal_themsua', '#form_themsua',
                                            '{{route('ad.hrm.hopdong.sua.post', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}',
                                            '{{route('ad.hrm.hopdong.getdata', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-outline-blue btn-sm btn-danger text-white" onclick="deleteModal('#modal_xoa', '{{route('ad.hrm.hopdong.xoa', ['ma_gv' => $giangvien->ma_gv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></button>
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
            console.log(data);
            console.log('Set data for edit');
            let form_input = $('#form_themsua').find('textarea, input, select').not('#ma_gv, #ten_gv, _token, input[name="_token"]');
            for(i = 0; i < form_input.length; i++){
                $('#' + form_input[i].id).val(data[form_input[i].id]);
            }
            if($(data.denngay) == null){
                $("#denngay").attr("readonly", "true");
            } else {
                $("#denngay").removeAttr("readonly");
            }

        }
        $(document).ready(function () {
            $("#voth").click(function () {
                console.log("Click");
                console.log($("#voth").is(":checked"));
                if($("#voth").is(":checked")){
                    $("#denngay").val("");
                    $("#denngay").attr("readonly", "true");
                } else {
                    $("#denngay").removeAttr("readonly");
                }
            });
        });
    </script>
@endsection
@section('custom-css')
@endsection