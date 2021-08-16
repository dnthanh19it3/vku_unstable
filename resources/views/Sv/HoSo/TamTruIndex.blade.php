@extends('layout.sv_layout')
@section('title', 'Tạm trú tạm vắng')
@section('body')
    <h6>Thông tin tạm trú</h6>
    <hr/>
    <div class="alert alert-warning">Thông tin tạm trú được cập nhật cho học kì {{$hocky->hocky}} năm học {{$hocky->nambatdau . "-" . $hocky->namketthuc}}</div>
    <div class="row">
        <div class="col-md-12">
            @if($tamtrucount < 1)
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Bạn chưa khai báo trong học kì này! Vui lòng bổ sung khai báo tạm trú!
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="{{route('taotamtru')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tạo khai báo mới</a>
                    </div>
                </div>
            @elseif($tamtru != null && $tamtrucount > 0)
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('taotamtru')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tạo khai báo mới</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
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
                    <th class="column-title">Địa chỉ</th>
                    <th class="column-title">Tên chủ hộ</th>
                    <th class="column-title">SĐT chủ hộ</th>
                    <th class="column-title">Thời gian</th>
                    <th class="column-title">Học kỳ</th>
                    <th class="column-title">Năm học</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0
                @endphp

                @forelse($listtamtru as $item)
                    <tr role="row" class="odd">
                        <td class="sorting_1">{{ $i += 1 }}</td>
                        <td>{{ $item->so_nha.", ". $item->thon_to.", ".$item->xa_phuong.", ".$item->quan_huyen.", ".$item->tinh_thanh}}</td>
                        <td>{{ $item->tenchuho }}</td>
                        <td>{{ $item->sdtchuho }}</td>
                        <td>{{ $item->thoigian }}</td>
                        <td>{{ $item->hocky }}</td>
                        <td>{{ $item->nambatdau."-".$item->namketthuc }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-danger">
                                Bạn chưa khai báo trong học kì này! Vui lòng bổ sung khai báo tạm trú trong chỉnh sửa hồ sơ!
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
