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
        .checking {
            color: orange;
        }
        .running {
            color: green;
        }
        .stopped {
            color: red;
        }
    </style>
    <div class="row mb-3">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h4 class="p-0"><i class="fas fa-robot"></i>&nbsp;Thông tin máy chủ</h4>
                <hr/>
            </div>
            <div class="body p-3 row">
                <div class="col-md-4">
                    <h4>Trạng thái hoạt động</h4>
                    <p>Trạng thái khởi chạy: <span id="status" class="checking">checking...&nbsp;</span></p>
                </div>
                <div class="col-md-4">
                    <h4>Train AI</h4>
                    <h6 id="status_train"></h6>
                    <button type="button" class="btn btn-primary btn-sm" onclick="train()">Train AI</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h4 class="p-0"><i class="fas fa-robot"></i>&nbsp;Train</h4>
                <hr/>
            </div>
            <div class="body">
                <a href="{{route('ad.zalo.addintent')}}" class="btn btn-danger">Thêm</a>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>
                                <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Tên Intents </th>
                            <th class="column-title">Mô tả </th>
                            <th class="column-title">Thời gian tạo </th>
                            <th class="column-title">Thời gian cập nhật </th>
                            <th class="column-title no-link last"><span class="nobr">Hành động</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>
                        <style>
                            a.btn {
                                color: white !important;
                            }
                        </style>
                        <tbody>
                        @forelse($intents as $key => $item)
                            <tr class="even pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records" value="{{$item->id}}">
                                </td>
                                <td class=" ">{{$item->tag}}</td>
                                <td class=" ">{{$item->description}}</td>
                                <td class=" ">{{$item->created_at}}</td>
                                <td class=" ">{{$item->updated_at}}</td>
                                <td class="" style="width: 230px">
                                    <a href="{{route('ad.zalo.editintent', ['intent_id' => $item->id])}}" class="btn btn-round btn-warning" <?php /*onclick="modalEdit('{{$item->id}}')"*/ ?> >Sửa</a>
                                    <a href="{{route('ad.zalo.editintent', ['intent_id' => $item->id])}}" class="btn btn-round btn-danger" <?php /*onclick="modalEdit('{{$item->id}}')"*/ ?> >Xoá</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- The modal -->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editform" method="get" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabel">Chỉnh sửa intent</h4>
                </div>
                <div class="modal-body">
                    <h4>Thông tin intents</h4>
                    <div class="row">
                        <div class="form-group">
                            <label for="tag">Tags</label>
                            <input type="text" name="tag" placeholder="Tags" class="form-control" id="tag">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <input type="text" name="description" class="form-control" placeholder="Mô tả Intents" id="description">
                        </div>
                    </div>
                    <h4>Thông tin patterns</h4>
                    <button type="button" class="btn btn-primary btn-sm" onclick="addintent('99999')">Thêm Intent mới</button>
                    <div id="patterns_zone" style="padding: 48px">
                        <style>
                            .mb-3{margin-bottom: 1rem}
                        </style>

                        <!-- add here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function () {
            $("#btninit").click(function () {
                console.log("Init clicked");
            });

            let checking_url = "http://127.0.0.1:5000/";
            $.ajax({
                type: "GET",
                url: checking_url,
                async: true,
                success: function (result) {
                    let request_result = JSON.parse(result);
                    if(request_result.status == 1){
                        $("#status").text(request_result.message);
                        $("#status").removeClass("checking");
                        $("#status").addClass("running");
                    } else {
                        $("#status").text(request_result.message);
                        $("#status").removeClass("checking");
                        $("#status").addClass("stopped");
                        let button = document.createElement('button');
                        button.type = "button";
                        button.className = "btn btn-sm btn-primary";
                        button.innerText = "Khỏi chạy";
                        button.id = "btninit";
                        button.setAttribute('onclick', 'init()');

                        $("#status").append(button);
                    }
                }
            });
        })


        function init(){
            console.log("Init");
            let init_url = "http://127.0.0.1:5000/init";
            $.ajax({
                type: "GET",
                url: init_url,
                async: true,
                success: function (result) {
                    let request_result = JSON.parse(result);
                    if(request_result.status == 1){
                        $("#status").text(request_result.message);
                        $("#status").removeClass("checking");
                        $("#status").removeClass("stopped");
                        $("#status").addClass("running");
                        $("#status").remove($("#btninit"));
                    } else {
                        $("#status").text(request_result.message);
                        $("#status").removeClass("checking");
                        $("#status").addClass("stopped");
                    }
                }
            });
        }
        function train(){
            console.log("Traub");
            let train_url = "http://127.0.0.1:5000/train_app";
            $("#status_train").text("Đang khởi chạy");
            $.ajax({
                type: "GET",
                url: train_url,
                async: true,
                success: function (result) {
                    let request_result = JSON.parse(result);
                    if(request_result.status == 1){
                        $("#status_train").text(request_result.message);
                        init();
                    } else {
                        $("#status_train").text(request_result.message);
                    }
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