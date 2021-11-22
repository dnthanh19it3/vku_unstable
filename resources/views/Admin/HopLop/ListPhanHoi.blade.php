@extends('layout.admin_layout')
@section('title', 'Tổng hợp phản hồi')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <form id="fillter" class="bg-white p-3 mb-3" method="get" action="{{route('ad.hoplop.linklistphanhoi')}}">
                <h6><i class="fas fa-graduation-cap mr-2"></i>Năm học</h6>
                <select id="namhoc" name="namhoc" class="form-control rounded">
                    @foreach($list_kyhoc as $key => $value)
                        <option value="{{$value->id}}" {{$selected['namhoc'] == $value->id ? "selected" : ""}}>Năm học {{$value->nambatdau . "-" .$value->namketthuc    }}</option>
                    @endforeach
                </select>
                <hr/>
                <h6 class="mt-3"><i class="fas fa-calendar-day mr-2"></i>Học kỳ</h6>
                <select id="hocky" name="hocky" class="form-control rounded mb-3">
                    <option readonly="">Học kỳ</option>
                    <option value="1" {{$selected['hocky'] == 1 ? "selected" : ""}}>HK1</option>
                    <option value="2" {{$selected['hocky'] == 2 ? "selected" : ""}}>HK2</option>
                </select>
                <button id="btn" class="btn btn-sm btn-success w-100">Chọn học kỳ</button>
            </form>
            <div class="bg-white p-3 mb-3">
                <h6 class="mt-3"><i class="fas fa-calendar-check mr-2"></i>Tháng</h6>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($months as $value)
                        <a class="nav-link{{$selected['thang'] == $value ? " active" : ""}}" id="account-tab"
                           href="{{route('ad.hoplop.tonghopphanhoi', ['namhoc' => $selected['namhoc'], 'hocky' => $selected['hocky'], 'thang' => $value])}}">
                            <span style="display:inline-block;color: white; background: #5b9bd1; border-radius: 999px;padding:8px;width: 32px;height: 32px;font-weight: 600;text-align: center;">{{(int)$value}}</span>
                            Tháng {{$value}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h6><i class="fas fa-list mr-2"></i>Tổng hợp phản hồi tháng {{$selected['thang']}}</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        @forelse($arrayMonth[0]->bienban as $key => $value)
                        <div class="mb-3">
                            <div style="background: #0b97c4; padding: 16px;text-align: left">
                                <h6 class="text-white"><i class="fas fa-check-circle mr-2"></i>Phản hồi từ {{$key}}</h6>
                            </div>
                            <div style="background: rgba(11,151,196,0.15); padding: 16px">
                                <p>{!! $value->gopy !!}</p>
                                @if($value->phanhoi)
                                    <div style="border-left: 3px solid #0b97c4;padding-left: 1rem">
                                        <h6><i class="fas fa-reply mr-2"></i>Phản hồi từ nhà trường</h6>
                                        <span>{{\Carbon\Carbon::make($value->thoigianphanhoi)->format('h:i d-m-y')}}</span>
                                        <p>{!! $value->phanhoi !!}</p>
                                        <p><a href="javascript:void(0)" id="btn_suaphanhoi_{{$key}}" class="btn btn-sm btn-primary"><i class="fas fa-pen mr-2"></i>Sửa phản hồi</a> </p>
                                        <form id="form_{{$key}}" method="post" action="{{route('ad.hoplop.phanhoi', ['id' => $value->id])}}" class="row ml-3 mb-3">
                                            {{csrf_field()}}
                                            <div class="col-12 mb-3 border p-3 rounded">
                                                <h6><i class="fas fa-edit mr-2"></i>Sửa phản hồi</h6>
                                                <textarea name="phanhoi" id="input_{{$key}}" class="form-control" rows="5">{!! $value->phanhoi !!}</textarea>
                                                <button class="btn btn-primary btn-sm mt-3"><i class="fas fa-save mr-2"></i>Sửa phản hồi</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div style="border-left: 3px solid #0b97c4;padding-left: 1rem">
                                        <h6><i class="fas fa-reply mr-2"></i>Chưa có phản hồi</h6>
                                        <p><a href="javascript:void(0)" id="btn_suaphanhoi_{{$key}}" class="btn btn-sm btn-primary"><i class="fas fa-pen mr-2"></i>Phản hồi ngay</a> </p>
                                        <form id="form_{{$key}}" method="post" action="{{route('ad.hoplop.phanhoi', ['id' => $value->id])}}" class="row ml-3 mb-3">
                                            {{csrf_field()}}
                                            <div class="col-12 mb-3 border p-3 rounded">
                                                <h6><i class="fas fa-edit mr-2"></i>Viết phản hồi</h6>
                                                <textarea name="phanhoi" id="input_{{$key}}" class="form-control" rows="5">{!! $value->phanhoi !!}</textarea>
                                                <button class="btn btn-primary btn-sm mt-3"><i class="fas fa-save mr-2"></i>Sửa phản hồi</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @empty
                            <p><i class="far fa-comments mr-2"></i><i>Không có thông tin phản hồi cho tháng này</i></p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        {{--$(document).ready(()=>{--}}
        {{--    let link = "{{route('ad.hoplop.listhoplop.nullable')}}";--}}
        {{--    let fillter = $('#fillter');--}}
        {{--    fillter.submit((event) => {--}}
        {{--        event.preventDefault();--}}
        {{--        let namhoc = $('#namhoc').val();--}}
        {{--        let hocky = $('#hocky').val();--}}
        {{--        if((!isNaN(namhoc)) && !isNaN(hocky)){--}}
        {{--            let redirect_link = (link+"/"+namhoc+"/"+hocky);--}}
        {{--            window.location = redirect_link;--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        @foreach($arrayMonth[0]->bienban as $key => $value)
        ClassicEditor
            .create( document.querySelector( '#input_{{$key}}' ) )
            .catch( error => {
                console.error( error );
            } );
        $('#form_{{$key}}').hide();
        $('#btn_suaphanhoi_{{$key}}').click(function (){
            $('#form_{{$key}}').show();
            $('#btn_suaphanhoi_{{$key}}').hide();
            $('#phanhoi_text_{{$key}}').hide();
        })
        @endforeach
    </script>
@endsection




