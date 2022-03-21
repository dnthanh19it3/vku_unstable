<ul class="danhsachdon">
    @forelse($list as $item)
        @if($item->donvi_id == $donvi)
            <li><a href="{{route('sv.chitietthutuc', ['maudon_id' => $item->id])}}">{{$item->tenmaudon}}</a></li>
        @endif
    @empty
        Đơn vị này chưa có mẫu đơn
    @endforelse
</ul>