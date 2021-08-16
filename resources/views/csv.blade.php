<form action="{{route('nhapdrl.post')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="csv">
    <input type="submit">
</form>