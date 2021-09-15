@extends('layout.sv_layout')
@section('body')
    <form method="post" action="{{route('sv.hoplop.taobienban.store', ['thang' => $thang])}}" class="row mb-3">
        {{ csrf_field() }}
        <div class="col-md-3">
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-info-circle mr-2"></i>Thông tin biên bản</h6>
                <hr/>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Lớp sinh hoạt</h6></div>
                    <div class="col-md-6">{{$lopsh->tenlop}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Năm học</h6></div>
                    <div class="col-md-6">{{$kyhoc_hienhanh->nambatdau."-".$kyhoc_hienhanh->namketthuc}}</div>
                </div
                ><div class="row ml-3">
                    <div class="col-md-6"><h6>Học kỳ</h6></div>
                    <div class="col-md-6">{{$kyhoc_hienhanh->hocky}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Tháng</h6></div>
                    <div class="col-md-6">{{$thang}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6">
                        <h6>Thời gian họp</h6></div>
                    <div class="col-md-6">
                        <input id="thoigianhop" name="thoigianhop" type="datetime-local" class="form-control rounded">
                    </div>
                </div>
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-user-check mr-2"></i>Thành phần tham dự</h6>
                <hr/>
                @foreach($bancansu as $key => $item)
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>{{$item->chucvu}}</h6></div>
                        <div class="col-md-8"><img src="{{asset($item->avatar)}}" style="object-fit: cover;width: 32px;height: 32px; border-radius: 999px;margin-right: 16px" alt="">{{$item->hodem." ".$item->ten}}</div>
                    </div>
                @endforeach
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-file-signature mr-2"></i>Thông tin điểm danh</h6>
                <hr/>
            </div>
        </div>

        <div class="col-md-9">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white p-3 pr-6 mb-3">
                <h6><i class="fas fa-file-alt mr-2"></i>Nội dung thực hiện</h6>
                <hr/>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Chương trình họp</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="chuongtrinh" name="chuongtrinh" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Nội dung triển khai</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="noidung" name="noidung" cols="40" rows="5" class="form-control">
                            @isset($dexuat)
                                {!! $dexuat->noidung !!}
                            @endisset
                        </textarea>
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Thảo luận và góp ý</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="gopy" name="gopy" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Góp ý của GVCN</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="gvcn_nhanxet" name="gvcn_nhanxet" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row p-3">
                    <button type="submit" class="btn btn-sm btn-primary w-100 ">NỘP BIÊN BẢN</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector('#chuongtrinh' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#noidung' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#gopy' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#gvcn_nhanxet' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection