@extends('layout.admin_layout')
@section('body')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewer.js/0.11.1/crocodoc.viewer.min.css" integrity="sha512-OLIufnbwg/9Ro8xLbwGYysLSQERYyDIEd5RdUcsPPgcBEZpr5yGNxSpE5y8GfvYKIdw3JNwXHkW9WyEtrw4QNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .text-red {
            color: red !important;
        }

        .form-control {
            border-radius: 5px;
        }
        .mr-1 {
            margin-right: 8px;
        }
        .mr-2 {
            margin-right: 8px;
        }
        .filepond--credits {
            display: none !important;
        }
        .avatar {
            border-radius: 999px;
            -o-object-fit: cover;
            object-fit: cover;
            vertical-align: middle;
            margin-right: 10px;
            width: 48px !important;
            height: 48px !important;
        }
        .ticket-header {
            display: flex;
            flex-direction: row;
            width: 100%;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
            flex-basis: available;
            flex-wrap: wrap;
        }
        .ticket-header .ticket-title {
            display: flex;
            flex-direction: column;
            /*background: rgba(119, 172, 202, 0.27);*/
            flex: 1 1 0;
        }
        .ticket-header .ticket-title .ticket-owner {
            font-size: 18px;
            font-weight: 500;
        }
        .ticket-header .ticket-title .ticket-name {
            font-size: 13px;
            font-weight: 500;
        }
        .ticket-header .avatar {
            /*width: 48px;*/
            /*!*flex-grow: 1;*!*/
        }
        .ticket-header .ticket-info {
            flex-basis: auto;
            /*background: rgba(119, 172, 202, 0.27);*/
            align-content: center;

        }
        .ticket-header .ticket-info .ticket-id {
            font-size: 16px;
            font-weight: 500;
            width: 120px;
            background-color: rgb(13, 134, 244);
            padding: 4px;
            border-radius: 18px;
            color: #fff
        }
        .ticket-header .ticket-info .ticket-id:before {
            content: '#';

        }
        @media only screen and (max-width: 780px){
            .ticket-header .ticket-title .ticket-owner {
                font-size: 16px;
                font-weight: 600;
            }
            .ticket-header .ticket-info .ticket-id {
                display: none;
            }
        }
    </style>
    <div class="col-xs-12 col-sm-8 col-xl-8 col-lg-8">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="ticket-header">
                        <div class="avatar">
                            <img src="{{$sinhvien['anhthe']}}" class="avatar"/>
                        </div>
                        <div class="ticket-title">
                            <div class="ticket-owner">{{$sinhvien['hodem'] . ' ' . $sinhvien['ten']. ' - ' . $sinhvien['masv']}}&nbsp;<a href=""><i class="fa fa-search" style="font-size: 13px" title="Xem h??? s?? sinh vi??n n??y"></i> </a> </div>
                            <div class="ticket-name">{{$mau->tenmaudon}}</div>
                        </div>
                        <div class="ticket-info">
                            <div class="ticket-id">
                                {{$don->id}}
                            </div>
                        </div>
                        <div class="ticket-info">
                            <div class="ticket-assign">
                                <i class="fa fa-clock-o"></i> Ng??y t???o {{$don->thoigiantao ?? 'N/A'}}
                            </div>
                            <div class="ticket-expire">
                                <i class="fa fa-ban" aria-hidden="true"></i> H???t h???n {{$don->thoigianhethan ?? 'N/A'}}
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .replybox {
                        padding: 16px;
                        border: 1px solid #cdcdcd;
                        border-radius: 8px;
                    }
                    .reply-input {
                        margin-bottom: 16px;
                    }
                    .reply-input textarea {
                        border: 1px solid #cdcdcd;
                    }

                    .comment-img {
                        width: 3rem;
                        height: 3rem;
                    }

                    .comment-replies .comment-img {
                        width: 1.75rem;
                        height: 1.75rem;
                    }
                    .comment-block {
                        display: flex; flex-direction: row; background-color: rgba(128,128,128,0.1); padding: 16px; border-radius: 8px; margin-bottom: 16px;
                    }
                    .comment-imageblock {
                        display: flex;
                        margin-right: 16px;
                    }
                    .comment-block .img {
                        width: 62px; height: 62px; object-fit: cover; border-radius: 999px
                    }
                    .comment-textblock {
                        display: flex; flex-grow: 1; flex-direction: column
                    }
                    .comment-textblock .username {
                        font-weight: 500; font-size: 16px
                    }
                    .comment-textblock .time {
                        font-size: 14px; font-weight: 400
                    }
                    .comment-textblock .comment {
                        font-weight: 400; font-size: 14px
                    }
                </style>

                <div class="row p-3" hidden>
                    <div class="col-md-8">
                        <h4><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;{{$mau->tenmaudon ?? ''}}</h4>
                    </div>
                    <div class="col-md-4">
                        <div style="font-size: 18px; display: inline-block">#{{$don->id}}</div>
                        <div class="badge badge-light">{{$don->tentrangthai}}</div>
                    </div>
                </div>


            </div>
            <div class="x_content">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="post" action="{{route('capnhatdonStore', ['don_id' => $don->id])}}" enctype="multipart/form-data" class="form-horizontal"
                      id="formSave" method="post" role="form">
                    {{csrf_field()}}
                    <div class="center-block vku-div-fieldset">
                        <fieldset class="vku-fieldset">
                            <legend>I. Th??ng tin ????ng k??</legend>

                            @foreach($cauhoi as $key => $item)
                                @if($item['static'] == 1)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['templete'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o">&nbsp;&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 answer-box">
                                            {{$sinhvien[$item['templete']]}}
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 1)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['templete'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o">&nbsp;&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6  answer-box">
                                            {{$traloi_cauhoi[$key]}}
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 2)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['templete'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 answer-box">
                                            {{$traloi_cauhoi[$key]}}
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 3)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['templete'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 answer-box">
                                            @foreach($traloi_cauhoi[$key] as $key2 => $value)
                                                {{$value}} <br/>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 4)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['templete'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 answer-box">
                                            {{$traloi_cauhoi[$key]}}
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 5)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['templete'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Th??ng tin t??? h??? th???ng ????o t???o">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6  answer-box">
                                            {{$traloi_cauhoi[$key]}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"></label>
                                <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                    <p class="text-red">&nbsp;(*) Th??ng tin t??? h??? th???ng qu???n l?? sinh vi??n</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <fieldset class="vku-fieldset">
                        <legend>II. H??? s?? gi???y t??? minh ch???ng</legend>
                        <div class="form-group">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%">STT</th>
                                        <th class="text-center">Lo???i gi???y t???</th>
                                        <th class="text-center">Thao t??c</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($taptin as $key => $item)
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-justify">
                                                <b>{{$item['cauhoi']}}</b>@if($item['require'])<span
                                                        class="text-red" data-toggle="tooltip" data-placement="right" title="B???t bu???c">&nbsp;&nbsp;(*)</span> @endif<br/>
                                                {{$item['mota']}}
                                            </td>
                                            <td class="text-center" style="min-width: 320px">
                                                <div>
                                                    @if($traloi_taptin[$key]) <a href="{{$traloi_taptin[$key]}}" class="btn btn-sm btn-primary" style="color: #fff" data-toggle="tooltip" data-placement="right" title="T???i xu???ng"><span class="glyphicon glyphicon-cloud-download"></span></a> @endif
                                                    <a href="#" class="btn btn-sm btn-primary" style="color: #fff" data-toggle="tooltip" data-placement="right" title="C???p nh???t t???p tin"><span class="glyphicon glyphicon-cloud-upload"></span></a>
                                                    @if($traloi_taptin[$key]) <a href="#" class="btn btn-sm btn-primary" style="color: #fff" data-toggle="tooltip" data-placement="right" title="Xem nhanh"><span class="glyphicon glyphicon-eye-open"></span></a> @endif
                                                    <br/><a href="#" data-toggle="tooltip" data-placement="right" title="Kh??ng c???p nh???t t???p tin n???a">Hu??? c???p nh???t</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-xl-4 col-lg-4">
        <div class="x_panel">
            <div class="x_title">
                <h4 style="float: left"> <i class="fa fa-file"></i> Th??ng tin ????n</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Tr???ng th??i: </b>
                    </div>
                    <div class="col-xs-6 {{ $hethan ? 'text-red' : ''}}">
                        {{$don->tentrangthai}} {{ $hethan ? '(???? h???t h???n ' . $hethan_humantime . ')' : ''}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Th???i gian h???t h???n: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->thoigianhethan}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Ng?????i t???o ????n: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$sinhvien['hodem'] . ' ' . $sinhvien['ten'] ?? 'Ch??a ti???p nh???n'}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Ng?????i ti???p nh???n: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->chuyenvien_id ?? 'Ch??a ti???p nh???n'}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Th???i gian ti???p nh???n: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->thoigiantiepnhan ?? '---'}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Ghi ch??: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->ghichu ?? '---'}}
                    </div>
                </div>
            </div>
        </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h4><i class="fa fa-adjust"></i> X??? l?? ????n</h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                <form class="form-horizontal form-label-left" method="post" action="{{route('admin.thutuc.xuly', ['id' => $don->id])}}">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">H??nh ?????ng</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="trangthai">
                                <option>Ch???n h??nh ?????ng</option>
                                @forelse($trangthai as $key => $value)
                                    <option value="{{$value->id}}" {{$value->id == $don->trangthai ? 'selected': ''}}>{{$value->tentrangthai}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Ghi ch??</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="ghichu" value="{{$don->ghichu ? $don->ghichu : ''}}" placeholder="N???i dung ghi ch??">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 "></label>
                        <div class="col-md-9 col-sm-9 ">
                           <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> L??u</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('custom-css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet"/>
    <style>
        .answer-box {
            display: flex; flex-direction: column; align-content: flex-start
        }
    </style>
@endsection
@section('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewer.js/0.11.1/crocodoc.viewer.js" integrity="sha512-V17KGJTY1EZTobz3Fs10lSCHN5HxDsGa7U/X/g+GKqO8+h5VYDR6JoAAXp/H1dM7npZQGZNWxvlEsvkSbozIkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#replybox").hide();
        function showReplyBox(){
            let replyBox = $("#replybox");
            replyBox.show();
        }
        function closeReplyBox(){
            let replyBox = $("#replybox");
            replyBox.hide();
        }
        $("#submit").prop('disabled', true);
        $(document).ready(function (){

        })
    </script>
    <script type="text/javascript">
        var viewer = Crocodoc.createViewer('.viewer', {
            url: 'http://localhost:8000/doc.xlsx'
        });
        viewer.load();
    </script>
@endsection
