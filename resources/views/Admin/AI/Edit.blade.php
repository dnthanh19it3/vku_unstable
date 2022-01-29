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




    <div class="row mb-3">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h4 class="p-0"><i class="fas fa-robot"></i>&nbsp;Thông tin Intents</h4>
                <hr/>
            </div>
            <div class="body p-3">
                <form class="row" method="post" action="{{route('ad.zalo.editintent.post', ['intent_id' => $intent->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="tag">Tags</label>
                        <input type="text" name="tag" placeholder="Tags" class="form-control" id="tag" value="{{$intent->tag}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input type="text" name="description" class="form-control" placeholder="Mô tả Intents" id="description" value="{{$intent->description}}">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-3" >
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h4 class="p-0"><i class="fas fa-robot"></i>&nbsp;Thông tin Patterns <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalPattern">Thêm</button></h4>
                <hr/>
            </div>
            <div class="body p-3">
                <form class="row" method="post" action="{{route('ad.zalo.editpattern.post', ['intent_id' => $intent->id])}}">
                    {{csrf_field()}}
                    @forelse($patterns as $pattern)
                        <div class="form-group row">
                           <div class="col-xs-8">
                               <input type="text" name="pattern[]" value="{{$pattern->pattern}}" placeholder="Nội dung" class="form-control" id="pattern">
                               <input type="hidden" name="patternid[]" value="{{$pattern->id}}"/>
                           </div>
                            <div class="col-xs-4">
                                <a href="ok" class="btn btn-danger">Xoá</a>
                            </div>
                        </div>
                    @empty
                    <div class="alert alert-warning" style="color: #000!important;">Chưa có thông tin!</div>
                    @endforelse
                        <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalPattern" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="post" action="{{route('ad.zalo.addpattern.post', ['intent_id' => $intent->id])}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Pattern</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="tag">Pattern</label>
                            <input type="text" name="pattern" placeholder="Tags" class="form-control" id="tag">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row" >
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h4 class="p-0"><i class="fas fa-robot"></i>&nbsp;Thông tin Response<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalResponse">Thêm</button></h4>
                <hr/>
            </div>
            <div class="body p-3">
                <form class="row" method="post" action="{{route('ad.zalo.editresponse.post', ['intent_id' => $intent->id])}}">
                    {{csrf_field()}}
                    @forelse($responses as $response)
                        <div class="form-group row">
                            <div class="col-xs-8">
                                <input type="text" name="response[]" value="{{$response->response}}" placeholder="Nội dung" class="form-control" id="tag">
                                <input type="hidden" name="responseid[]" value="{{$response->id}}"/>
                            </div>
                            <div class="col-xs-4">
                                <a href="ok" class="btn btn-danger">Xoá</a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning" style="color: #000!important;">Chưa có thông tin!</div>
                    @endforelse
                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
        <div class="modal fade" id="modalResponse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="post" action="{{route('ad.zalo.addresponse.post', ['intent_id' => $intent->id])}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Pattern</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="tag">Response</label>
                        <input type="text" name="response" placeholder="Thông điệp phản hồi" class="form-control" id="tag">
                        <p><small>* Nếu thêm nhiều response cho 1 intent, hệ thống sẽ gửi ngẫu nhiên 1 response cho người dùng</small></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('custom-script')

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