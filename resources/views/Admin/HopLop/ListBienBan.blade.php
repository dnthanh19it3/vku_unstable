@extends('layout.admin_layout')
@section('title', 'Danh sách biên bản')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <form id="fillter" class="bg-white p-3 mb-3" method="get" action="{{route('ad.hoplop.linklistbienban')}}">
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
                           href="{{route('ad.hoplop.listhoplop', ['namhoc' => $selected['namhoc'], 'hocky' => $selected['hocky'], 'thang' => $value])}}">
                            <span style="display:inline-block;color: white; background: #5b9bd1; border-radius: 999px;padding:8px;width: 32px;height: 32px;font-weight: 600;text-align: center;">{{(int)$value}}</span>
                            Tháng {{$value}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-chart-pie mr-2"></i>Thống kê</h6>
                <hr/>
                @php $total = $thongke->danop + $thongke->chuanop; $danop_percent = ceil($thongke->danop / $total * 100)  @endphp
                <span>Đã nộp</span>
{{--                <div class="progress">--}}
{{--                    <div class="progress-bar" role="progressbar" style="width: {{$danop_percent}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$danop_percent}}%</div>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h6><i class="fas fa-list mr-2"></i>Danh sách biên bản tháng {{$selected['thang']}}</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div style="background: #0b97c4; padding: 16px;text-align: center">
                            <h6 class="text-white"><i class="fas fa-check-circle mr-2"></i> Đã nộp ({{$thongke->danop}})</h6>
                        </div>
                        <div style="background: rgba(11,151,196,0.15); padding: 16px;text-align: center">
                            <ul class="list_thang ml-0 pl-0">
                                @foreach($arrayMonth as $key => $value)
                                    @if(isset($value->bienban))
                                        @foreach($value->bienban as $lop => $noidungbienban)
                                            @if($noidungbienban != null)
                                                <li>
                                                    {{$lop}}<a class="ml-2"
                                                               href="{{route('admin.hoplop.xembienban', ['id' => $noidungbienban->id])}}"><i
                                                                class="fas fa-eye mr-1"></i>Xem</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: #ff6161; padding: 16px;text-align: center">
                            <h6 class="text-white"><i class="fas fa-times-circle mr-2"></i>Chưa nộp ({{$thongke->chuanop}})</h6>
                        </div>
                        <div style="background: rgba(255,97,97,0.15); padding: 16px;text-align: center">
                            <ul class="list_thang ml-0 pl-0">
                            @foreach($arrayMonth as $key => $value)
                                @if(isset($value->bienban))
                                    @foreach($value->bienban as $lop => $noidungbienban)
                                        @if($noidungbienban == null)
                                            <li>
                                                {{$lop}} Chưa nộp biên bản
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
{{--    <script>--}}
{{--        $(document).ready(()=>{--}}
{{--            let link = "{{route('ad.hoplop.listhoplop.nullable')}}";--}}
{{--            let fillter = $('#fillter');--}}
{{--            fillter.submit((event) => {--}}
{{--                event.preventDefault();--}}
{{--                let namhoc = $('#namhoc').val();--}}
{{--                let hocky = $('#hocky').val();--}}
{{--                if((!isNaN(namhoc)) && !isNaN(hocky)){--}}
{{--                    let redirect_link = (link+"/"+namhoc+"/"+hocky);--}}
{{--                    window.location = redirect_link;--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection