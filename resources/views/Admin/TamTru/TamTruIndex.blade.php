@extends('layouts/ad_master')
@section('body')
    <div class="card">
        <div class="card-header border-bottom">Tạm trú</div>
        <div class="card-body">
            <div class="row">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-sm btn-primary">Taọ mới</a>
                        </div>
                    </div>
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-container">
                            <table id="datatablesSimple" class="dataTable-table">
                                <thead>
                                <tr>
                                    <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">STT</a>
                                    </th>
                                    <th data-sortable="" style="width: 55%;"><a href="#" class="dataTable-sorter">Học
                                            kì</a>
                                    </th>
                                    <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Năm
                                            học</a>
                                    </th>
                                    <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Trạng
                                            thái</a>
                                    </th>
                                    <th data-sortable="" style="width: 10%%;"><a href="#" class="dataTable-sorter">Hành
                                            dộng</a>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($hocky as $key => $item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$item->hocky}}</td>
                                        <td>{{$item->namhoc}}</td>
                                        <td>
                                            @if($item->tamtru == 1)
                                                <span class="badge badge-primary">Đang mở</span>
                                            @else
                                                <span class="badge badge-danger">Đã đóng</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->tamtru == 0)
                                                <a class="btn btn-sm btn-primary" href="{{route('tamtru.mo', ['hocky' => $item->id])}}">Mở</a>
                                            @else
                                                <a class="btn btn-sm btn-danger" href="{{route('tamtru.dong', ['hocky' => $item->id])}}">Đóng</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
