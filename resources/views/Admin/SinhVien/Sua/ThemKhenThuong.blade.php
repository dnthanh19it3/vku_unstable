@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12 bg-white p-3">
            <h5>Thêm khen thưởng</h5>
            <hr/>
            <form id="khenthuong-form" action="{{route('ad.suasinhvien.khenthuong.them', ['masv' => $sinhvien->masv])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="capkhenthuong" class="col-3 col-form-label">Cấp khen thưởng</label>
                    <div class="col-9">
                        <input class="form-control rounded" id="capkhenthuong" name="capkhenthuong" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soquyetdinh" class="col-3 col-form-label">Quyết định số</label>
                    <div class="col-9">
                        <input class="form-control rounded" id="soquyetdinh" name="soquyetdinh" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="noidung" class="col-3 col-form-label">Nội dung</label>
                    <div class="col-9">
                        <input class="form-control rounded" id="noidung" name="noidung" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="thoigian" class="col-3 col-form-label">Thời gian</label>
                    <div class="col-9">
                        <div class="input-group">
                            <input class="form-control rounded" id="thoigian" name="thoigian" type="date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="thoigian" class="col-3 col-form-label">Năm học</label>
                    <div class="col-9">
                        <div class="input-group\">
                           <select name="namhoc" class="form-control  rounded" required>
                               @foreach($namhoc_hocky as $key => $value)
                                <option value="{{$value->id}}">{{$value->nambatdau." ".$value->namketthuc}}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="thoigian" class="col-3 col-form-label">Học kỳ</label>
                    <div class="col-9">
                        <div class="input-group">
                           <select name="hocky" class="form-control rounded" required>
                                <option value="1">Học kỳ 1</option>
                                <option value="2">Học kỳ 2</option>
                           </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-3 col-9">
                        <button name="submit" type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection