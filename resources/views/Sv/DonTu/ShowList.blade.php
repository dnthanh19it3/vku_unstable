<div class="col-md-12">
    @forelse($list as $item)
        @if($item->donvi_id == $donvi)
            <div class="row don-item" style="">
                <div class="col-md-6 left-panel">
                    <div class="inner-panel">
                        <a href="{{route('sv.chitietthutuc', ['maudon_id' => $item->maudon_id])}}"><b>{{$item->tenmaudon}}</b></a>
                    </div>
                </div>
                <div class="col-md-6 right-panel">
                    <div class="inner-panel">
                        {!! $item->mota !!}
                    </div>
                </div>
            </div>
        @endif
    @empty
        Đơn vị này chưa có mẫu đơn
    @endforelse
</div>
