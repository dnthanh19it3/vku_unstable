@extends('layout.admin_layout')
@section('title', 'Quản lý khen thưởng')
@section('header')
@endsection
@section('body')
    <div class="col-md-12">
        <div class="row bg-white">
            <div class="col-md-3 profile-leftpanel pr-md-3 border-right">
                @include('Admin.SinhVien.Sua.Menu', ['index' => 3])
            </div>
            <div class="col-md-9 profile-mainpanel">
                <h5>Khen thưởng</h5>
                <div class="mb-3"><a href="javascrip:void(0)" id="btnthem" style="font-size: 18px"><i class="far fa-plus-square"></i> Thêm khen thưởng</a></div>
                <form id="khenthuong-form" action="{{route('ad.suasinhvien.khenthuong.them', ['masv' => $sinhvien->masv])}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="capkhenthuong" class="col-3 col-form-label">Cấp khen thưởng</label>
                        <div class="col-9">
                            <input id="capkhenthuong" name="capkhenthuong" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="soquyetdinh" class="col-3 col-form-label">Quyết định số</label>
                        <div class="col-9">
                            <input id="soquyetdinh" name="soquyetdinh" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noidung" class="col-3 col-form-label">Nội dung</label>
                        <div class="col-9">
                            <input id="noidung" name="noidung" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thoigian" class="col-3 col-form-label">Thời gian</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input id="thoigian" name="thoigian" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-3 col-9">
                            <button name="submit" type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">STT</th>
                            <th class="column-title">Cấp khen thưởng</th>
                            <th class="column-title">Số quyết định</th>
                            <th class="column-title">Nội dung</th>
                            <th class="column-title">Thời gian</th>
                            <th class="column-title">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @forelse($khenthuong as $item)
                        <tr role="row" class="odd">
                            <td class="sorting_1">{{ $i += 1 }}</td>
                            <td>{{ $item->capkhenthuong }}</td>
                            <td>{{ $item->soquyetdinh }}</td>
                            <td>{{ $item->noidung }}</td>
                            <td>{{ $item->thoigian }}</td>
                            <td>
                                <a href="{{route('ad.suasinhvien.suakhenthuong', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="btn btn-sm btn-primary">Sửa</a>
                                <a href="{{route('ad.suasinhvien.xoakhenthuong', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="btn btn-sm btn-danger">Xoá</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Chưa có thông tin khen thưởng</td>
                        </tr>
                        @endforelse
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
@endsection
@section('custom-script')
<script>
    $(document).ready(function (){
        $('#khenthuong-form').hide();
        $('#btnthem').click(function (){
            $('#khenthuong-form').show();
        })
    })
</script>
@endsection
