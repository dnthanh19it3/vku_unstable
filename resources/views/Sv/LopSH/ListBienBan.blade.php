@extends('layout.sv_layout')
@section('body')
    <div class="row">
      <div class="col-md-12">
          <div class="bg-white p-3">
              <h5>Danh sách biên bản</h5>
              <hr/>

              <div class="table-responsive">
                  <div class="table-wrapper">
                      <div class="table-title">
                          <div class="row">
                              <div class="col-sm-5">
                                  <h6>Học kỳ {{$kyhoc_hienhanh->hocky}} năm học {{$kyhoc_hienhanh->nambatdau . " - " . $kyhoc_hienhanh->namketthuc}}</h6>
                              </div>
                              <div class="col-sm-7">
                              </div>
                          </div>
                      </div>
                      <table class="table table-striped table-hover">
                          <thead>
                          <tr>
                              <th>#</th>
                              <th>Tháng</th>
                              <th>Trạng thái nộp</th>
                              <th>Trạng thái duyệt</th>
                              <th>Người tạo biên bản</th>
                              <th>Ngày họp</th>
                              <th>Hành động</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($arrayMonth as $key => $value)

                              @if(isset($value->bienban))
                                  <tr>
                                      <td>#</td>
                                      <td>Họp lớp tháng {{$value->thang_text}}</td>
                                      <td><span class="status text-success">•</span>Đã nộp</td>
                                      <td>
                                          @if($value->bienban->xacnhan_nhatruong) <span class="status text-success">•</span> Đã duyệt @else <span class="status text-warning">•</span> Chờ duyệt @endif
                                      </td>
                                      <td>{{$value->bienban->hodem . " " . $value->bienban->ten}}</td>
                                      <td>{{\Carbon\Carbon::make($value->bienban->thoigianhop)->format('d/m/Y')}}</td>
                                      <td>
                                          <a href="{{route('sv.hoplop.xembienban', ['id' => $value->bienban->id])}}" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xe8f4;</i></a>
                                          <a href="{{route('sv.hoplop.suabienban', ['id' => $value->bienban->id])}}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xf097;</i></a>
                                      </td>
                                  </tr>
                              @else
                                  <tr>
                                      <td>#</td>
                                      <td>Họp lớp tháng {{$value->thang_text}}</td>
                                      <td colspan="5" style="text-align: center">
                                          <a href="{{route("sv.hoplop.taobienban", ['thang' => $value->thang])}}" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xe147;</i>Tạo biên bản</a>
                                      </td>
                                  </tr>
                              @endif

                          @endforeach
                          </tbody>
                      </table>
                      <div class="clearfix">
                          <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                          <ul class="pagination">
                              <li class="page-item disabled"><a href="#">Previous</a></li>
                              <li class="page-item"><a href="#" class="page-link">1</a></li>
                              <li class="page-item"><a href="#" class="page-link">2</a></li>
                              <li class="page-item active"><a href="#" class="page-link">3</a></li>
                              <li class="page-item"><a href="#" class="page-link">4</a></li>
                              <li class="page-item"><a href="#" class="page-link">5</a></li>
                              <li class="page-item"><a href="#" class="page-link">Next</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
