@extends('sv.sv_master')
@section('content')
<style>
.form-group:hover {background: #d3f1d3; padding:0px  !important}
</style>
<!-- page content -->
  <!-- top tiles -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h3>Khảo sát lớp học phần </h3><br>
            <p class="col-md-12 col-sm-12 col-xs-12"> Ý kiến phản hồi của sinh viên được sử dụng để nâng cao chất lượng dạy-học, được bảo mật và không ảnh hưởng đến kết quả học tập của sinh viên.
            Rất mong anh/chị nêu <b>ý kiến thẳng thắn, trung thực</b> về lớp học phần</p><div class="clearfix"></div>
            <div class="ln_solid"></div>
			
			
            <h4 style="color:red" >Thông tin lớp học phần: <br></h4>
			<div class="row">
				<div class="col-md-6">
					<strong>Tên lớp học phần: <span style="color:red">{!! $lhp->tenlop !!}</span></strong> <br>
					<strong>Mã học phần: <span style="color:red">{!! $mahocphan->mahocphan !!}</span></strong> <br>
					<strong>Số Tín chỉ: <span style="color:red">{!! $mahocphan->soTC !!}</span></strong> <br>
					<strong>Lịch trình giảng dạy: <span style="color:red"></span></strong> <br>
					
				</div>
				<?php
				if ($gv != null){
					?>
				<div class="col-md-3" style="text-align:center">
					<img src="http://vku.udn.vn/uploads/cocau/<?php
						$gv->email = str_replace("@vku.udn.vn", "",$gv->email);
						$gv->email = str_replace("@gmail.com", "",$gv->email);
						echo $gv->email;
						?>.png" width="100" height="135" class="img-circle" /><br/>
						<strong><span style="color:red">{!! $gv->chucdanh !!}. {!! $gv->hodem !!} {!! $gv->ten !!}</span></strong>
				</div>
				<?php } ?>
			</div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            @include('admincp.blocks.error')
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{!! route('sv.getCauhoikhaosat','$id') !!}" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                @foreach ($cauhoi as $item)
                    @if($item['loai'] == 1)
                        <div class="form-group">
                            <h5 style="color:red;" class="col-md-11 col-sm-11 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>
                            </h5>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h5 style="color:red" class="col-md-7 col-sm-7 col-xs-12" for="tenmau">
                                    </h5>
                                    <div class="col-md-1 col-sm-1 col-xs-12" >
                                        <img style=""  src="{{ url('public/img/khaosat/hoantoankhongdongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Hoàn toàn không đồng ý</span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <img style="" src="{{ url('public/img/khaosat/khongdongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Không đồng ý</span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <img style="" src="{{ url('public/img/khaosat/dongymotphan.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Đồng ý một phần</span> 
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <img style="" src="{{ url('public/img/khaosat/dongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Đồng ý</span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <img style="" src="{{ url('public/img/khaosat/hoantoandongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Hoàn toàn đồng ý</span>
                                    </div>
                                </div>
                                <!-- div class="form-group">
                                    <h5 style="color:red" class="col-md-7 col-sm-7 col-xs-12" for="tenmau">
                                    </h5>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <span style="text-align:center;" for="traloi">Hoàn toàn không đồng ý</span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <span style="text-align:center;" for="traloi">Không đồng ý</span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <span style="text-align:center;" for="traloi">Đồng ý một phần</span> 
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <span style="text-align:center;" for="traloi">Đồng ý</span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <span style="text-align:center;" for="traloi">Hoàn toàn đồng ý</span>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    @elseif($item['loai'] == 3)
                        <div class="form-group">
                        <h5 style="color:red" class="col-md-12 col-sm-12 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>
                            </h5>
                        </div>
                    @elseif($item['loai'] == 2)
                        <div class="form-group">
                            <label class="col-md-12 col-sm-12 col-xs-12" for="tenmau"><i>{!! $item['cauhoi'] !!}</i>
                            </label>
                            <textarea class="col-md-12 col-sm-12 col-xs-12" wrap="hard" name="tuluan[]" id="tuluan[]"style="height: 80px;" ></textarea>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="col-md-7 col-sm-7 col-xs-12" for="tenmau"><i>{!! $item['cauhoi'] !!}</i>
                            </label>
                            <div class="col-md-1 col-sm-1 col-xs-4">
                                <div class="radio">                        
                                    <input type="radio"  title="Hoàn toàn không đồng ý"  class="flat"  id="traloi1[{!! $item['id'] !!}]" name="traloi[{!! $item['id'] !!}][]" value="1" required>&nbsp;&nbsp;
                                    <label for="traloi1[{!! $item['id'] !!}]"><img  title="Hoàn toàn không đồng ý" src="{{ url('public/img/khaosat/hoantoankhongdongy.png') }}" alt="" ></label>                               
                                </div>                    
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-4">
                                <div class="radio">
                                    <input type="radio"  title="Không đồng ý" class="flat"  id="traloi2[{!! $item['id'] !!}]" name="traloi[{!! $item['id'] !!}][]" value="2" required>&nbsp;&nbsp;
                                    <label for="traloi2[{!! $item['id'] !!}]"><img title="Không đồng ý"  src="{{ url('public/img/khaosat/khongdongy.png') }}" alt="" ></label>
                                </div>                    
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-4">
                                <div class="radio">                                  
                                    <input type="radio" class="flat" title="Đồng ý một phần"  id="traloi3[{!! $item['id'] !!}]" name="traloi[{!! $item['id'] !!}][]" value="3" required>&nbsp;&nbsp;
                                    <label for="traloi3[{!! $item['id'] !!}]"><img title="Đồng ý một phần"  src="{{ url('public/img/khaosat/dongymotphan.png') }}" alt="" ></label>                                  
                                </div>                    
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-4">
                                <div class="radio">
                                    <input type="radio" class="flat"  title="Đồng ý"  id="traloi4[{!! $item['id'] !!}]" name="traloi[{!! $item['id'] !!}][]" value="4" required>&nbsp;&nbsp;
                                    <label for="traloi4[{!! $item['id'] !!}]"><img title="Đồng ý"  src="{{ url('public/img/khaosat/dongy.png') }}" alt="" ></input></label>                                  
                                </div>                    
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-4">
                                <div class="radio">
                                    <input type="radio" class="flat"  title="Hoàn toàn đồng ý"  id="traloi5[{!! $item['id'] !!}]" name="traloi[{!! $item['id'] !!}][]" value="5" required>&nbsp;&nbsp;
                                    <label for="traloi5[{!! $item['id'] !!}]"><img title="Hoàn toàn đồng ý"  src="{{ url('public/img/khaosat/hoantoandongy.png') }}" alt="" ></label>                           
                                </div>                    
                            </div>
                                

                                <!--<select name="traloi[]" id="traloi[]" class="form-control" required>
                                    <option value="">Đánh giá</option>
                                    <option value="1" style="color:#FF4500">Hoàn toàn không đồng ý</option>
                                    <option value="2" style="color:#FF7F50">Không đồng ý</option>
                                    <option value="3" style="color:#FFA500">Đồng ý một phần</option>
                                    <option value="4" style="color:#32CD32">Đồng ý</option>
                                    <option value="5" style="color:green">Hoàn toàn đồng ý</option>
                                </select>-->
                           
                        </div>
                    @endif
                        <div class="ln_solid"></div>
                @endforeach
                
                <!-- editor -->
                <div class="form-group danhgia">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success btn-lg">Đánh giá</button>
                        <input type="hidden" id="idlop" name="idlop" value="{!! $id !!}">
                    </div>
                </div>

                <style>
                .checkbox label, .radio label {padding-left: 0px !important}
                @media only screen and (max-width: 600px) {
                    .chuy {
                        position:fixed; bottom:0px; display: block !important; left:0px;
                        background: #FFF !important;
                        z-index:10000;
                    }
                    .chuy>div {
                        padding: 10px;
                    }

                    .danhgia {margin-bottom:70px !important}
                    }
                </style>

            </form>

            <div class="chuy" style="display:none">
                    <div>
                <div class="col-md-1 col-sm-1 col-xs-12" >
                    <img style=""  src="{{ url('public/img/khaosat/hoantoankhongdongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Hoàn toàn không đồng ý</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{ url('public/img/khaosat/khongdongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Không đồng ý</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{ url('public/img/khaosat/dongymotphan.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Đồng ý một phần</span> 
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{ url('public/img/khaosat/dongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Đồng ý</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{ url('public/img/khaosat/hoantoandongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Hoàn toàn đồng ý</span>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- /top tiles -->
<!-- /page content -->
@stop