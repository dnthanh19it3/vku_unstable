<ol>
    @foreach($data as $item)
        @if($item['role'] == 'heading')
            <li>{{$item['content']}}</li>
            @if(isset($item['child']))
{{--                @php dd($item['child']) @endphp--}}
                @include('Sv.KhaoSat.Render', ['data' => $item['child']])
            @endif
        @endif
    @endforeach
</ol>