@extends('layout.admin_layout')
@section('body')
    <style>
        .p-0 {
            padding: 0;
        }
        .p-3 {
            padding: 1rem;
        }
        .mb-3 {
            padding-bottom: 1rem;
        }
    </style>
    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Train</h5>
                <hr/>
            </div>
            <div class="body">
                DUMP
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