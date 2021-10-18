@switch($item['loai'])
    @case(1)
    <tr style="font-weight: 700">
        <td colspan="2">{{$item['cauhoi']}}</td>
        <td style="text-align: center" colspan="6">{{$item['avg']}}</td>
    </tr>
    @break
    @case(2)
    <!-- Nothing here -->
    @break
    @case(3)
    <!-- Nothing here -->
    @break
    @case(4)

    <tr>
        <th scope="row">{{$i}}</th>
        <td style="font-weight: 500">{{$item['cauhoi']}}</td>
        <td style="text-align: center">{{$item['traloi']['1']}}</td>
        <td style="text-align: center">{{$item['traloi']['2']}}</td>
        <td style="text-align: center">{{$item['traloi']['3']}}</td>
        <td style="text-align: center">{{$item['traloi']['4']}}</td>
        <td style="text-align: center">{{$item['traloi']['5']}}</td>
        <td style="text-align: center">{{$item['avg']}}</td>
    </tr>
    @break
    @case(5)
    <tr style="font-weight: 900">
        <td colspan="8">{{$item['cauhoi']}}</td>
    </tr>
    @break
@endswitch