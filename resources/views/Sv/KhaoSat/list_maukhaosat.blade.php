@extends('admincp.ad_master')
@section('content')
<!-- page content -->
  <!-- top tiles -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Danh sách Mẫu phiếu</u></b> </h2><a href="<?php echo route('ad.getMaukhaosat'); ?>"><button style="float:right;" type="button" class="btn btn-success fa fa-plus" > Thêm mẫu mới</button></a>
            <div class="clearfix"></div>
            
        </div>
        <div class="x_content">

            <table  class=" table table-striped jambo_table bulk_action">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mẫu khảo sát</th>
                    <th>Thời gian tạo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $stt=1; ?>
                    @foreach($ds_mauphieu as $item)
                        <tr class="even pointer">
                            <td class=" ">{!! $stt++ !!}</td>
                            <td class=" "><a href="{!! URL::route('ad.getMauphieuDelete',$item->id) !!}"> {!! $item->tenmau !!} </a><br></td>
                            <td class=" ">Học kỳ {!! $item->hocky !!} - Năm học {!! $item->nambatdau !!}-{!! $item->namketthuc !!} </td>
                            @if($item->trangthai==0)
                                <td class=" ">
                                    <a onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa?')" href="{!! URL::route('ad.getMauphieuDelete',$item->id) !!}"><button style="float:right;" type="button" class="btn btn-default fa fa-trash-o" ></a>
                                    <a href=""><button style="float:right;" type="button" class="btn btn-default fa fa-bar-chart" ></a>
                                    <a href=""><button style="float:right;" type="button" class="btn btn-default fa fa-pencil" ></a> 
                                    <a href=""><button style="float:right;" type="button" class="btn btn-success fa fa-check" ></a>                    
                                </td>                          
                            @else
                                <td>
                                    <a onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa?')" href="{!! URL::route('ad.getMauphieuDelete',$item->id) !!}"><button style="float:right;" type="button" class="btn btn-default fa fa-trash-o" ></a>
                                    <a href=""><button style="float:right;" type="button" class="btn btn-default fa fa-bar-chart" ></a>
                                    <a href=""><button style="float:right;" type="button" class="btn btn-default fa fa-pencil" ></a> 
                                    <a href=""><button style="float:right;" type="button" class="btn btn-danger fa fa-close" ></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
          
                </tbody>
            </table>
        </div>
    </div>
</div>
  <!-- /top tiles -->
<!-- /page content -->
@stop