@extends('layout.admin_layout')
@section('body')
    <div class="card">
        <div class="card-header border-bottom">Tổng hợp điểm rèn luyện</div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('admin.danhgiarenluyen.importexcel')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-9">
                                <input class="form-control-file" type="file" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png" max="10240" name="excel_file">
                            </div>
                            <div class="col-md-3">
                                <input class="btn btn-primary" type="submit" value="Tải lên">
                            </div>
                        </div>
                    </form>
                    <p>Chấp nhận file xls, xlsx, csv</p>
                </div>
            </div>
        </div>
    </div>
@endsection
