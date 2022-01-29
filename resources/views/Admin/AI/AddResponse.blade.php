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
                <h4 class="p-0"><i class="fas fa-robot"></i>&nbsp;Thêm intent mới</h4>
                <hr/>
            </div>
            <div class="body p-3">
                <form class="row" method="post" action="{{route('ad.zalo.addintent.post')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="tag">Tags</label>
                        <input type="text" name="tag" placeholder="Tags" class="form-control" id="tag">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input type="text" name="description" class="form-control" placeholder="Mô tả Intents" id="description">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                </form>
            </div>
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