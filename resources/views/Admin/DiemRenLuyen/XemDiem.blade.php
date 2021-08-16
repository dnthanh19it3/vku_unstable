@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Danh sách sinh viên</h5>
                </div>
                <div class="x_content">
                    <form class="row" action="" method="get" onchange="this.submit()">
                        <div class="col-md-6">
                            <label>Lớp sinh hoạt</label>
                            <select name="lop" class="form-control">
                                <option>Chọn lớp</option>
                                @foreach($lop as $item)
                                    <option @if($lop_dangchon == $item->id) selected
                                            @endif value="{{$item->id}}">{{$item->tenlop}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Học kỳ</label>
                            <select name="hocky" class="form-control">
                                <option value="all">Tất cả học kì</option>
                                @forelse($hocky as $item)
                                    <option @if($hocky_dangchon == $item->namhoc_key) selected
                                            @endif value="{{$item->namhoc_key}}">{{"HK" . $item->hocky." ". $item->nambatdau." ".$item->namketthuc}}</option>
                                @empty
                                    <option>Chưa có tổng kết</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tìm kiếm</label>
                            <button class="btn btn-sm btn-primary form-control">Tìm kiểm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_content">
                    <!-- Ren luyen chung -->
                    @isset($diemrenluyen_chung)
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th>
                                        <div class="icheckbox_flat-green" style="position: relative;"><input
                                                type="checkbox" id="check-all" class="flat"
                                                style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </th>
                                    <th class="column-title">Họ và tên</th>
                                    <th class="column-title">Mã sinh viên</th>
                                    <th class="column-title">Lớp</th>
                                    @foreach($hocky as $item)
                                        <th>{{"HK" . $item->hocky." ". $item->nambatdau." ".$item->namketthuc}}</th>
                                    @endforeach
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($diemrenluyen_chung_ds as $key => $item1)

                                    <tr class="even pointer">

                                        <td class="a-center ">
                                            <div class="icheckbox_flat-green" style="position: relative;"><input
                                                    type="checkbox" class="flat" name="table_records"
                                                    style="position: absolute; opacity: 0;">
                                                <ins class="iCheck-helper"
                                                     style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div>
                                        </td>
                                        <td class=" ">{{$item1->hodem . $item1->ten}}</td>
                                        <td class=" ">{{$item1->masv}}</td>
                                        <td class=" ">{{$item1->tenlop}}</td>
                                        @forelse($diemrenluyen_chung as $item3)
                                            @if($item1->masv == $item3->masv)
                                                <td>{{($item3->diem)}}</td>
                                            @endif
                                        @empty
                                            <td>N/A</td>
                                        @endforelse
                                        {{--                                        @foreach($hocky as $item2)--}}
                                        {{--                                            <td>--}}

                                        {{--                                            </td>--}}
                                        {{--                                        @endforeach--}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @endisset
                        <!-- Rèn luyện học kì -->
                            @isset($diemrenluyen_hocky)
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th>
                                                <div class="icheckbox_flat-green" style="position: relative;"><input
                                                        type="checkbox" id="check-all" class="flat"
                                                        style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper"
                                                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                            </th>
                                            <th class="column-title">Họ và tên</th>
                                            <th class="column-title">Mã sinh viên</th>
                                            <th class="column-title">Lớp</th>
                                            <th class="column-title">Điểm</th>
                                            <th class="column-title">Xếp loại</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($diemrenluyen_hocky as $key => $item1)

                                            <tr class="even pointer">

                                                <td class="a-center ">
                                                    <div class="icheckbox_flat-green" style="position: relative;"><input
                                                            type="checkbox" class="flat" name="table_records"
                                                            style="position: absolute; opacity: 0;">
                                                        <ins class="iCheck-helper"
                                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                    </div>
                                                </td>
                                                <td class=" ">{{$item1->hodem . $item1->ten}}</td>
                                                <td class=" ">{{$item1->masv}}</td>
                                                <td class=" ">{{$item1->tenlop}}</td>
                                                <td class=" ">{{$item1->diem}}</td>
                                                <td class=" ">{{$item1->xeploai}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @endisset
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
