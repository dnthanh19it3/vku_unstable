<form method="post" action="{{route('nopdon.Store', ['donid' => $maudon_id])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <div class="col-12">
            <h5>Thông tin cơ bản</h5>
        </div>
    </div>
    <div class="form-group row">
        @foreach ($truong as $item)

                @if ($item->input_type == 'file')
                    @php
                        $flag = 1;
                    @endphp
                @elseif ($item->input_type == 'text')
                <div class="col-md-4 mb-2">
                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                    <input id="tenmaudon" name="tentruong[{{ $item->id }}]" placeholder=""
                        type="text" class="form-control" required="required">
                </div>
                @elseif ($item->input_type == 'datetime')
                <div class="col-md-4 mb-2">
                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                    <input id="tenmaudon" name="tentruong[{{ $item->id }}]" placeholder=""
                        type="date" class="form-control" required="required">
                </div>
                @elseif ($item->input_type == 'number')
                <div class="col-md-4 mb-2">
                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                    <input id="tenmaudon" name="tentruong[{{ $item->id }}]" placeholder=""
                        type="number" class="form-control" required="required">
                </div>
                @elseif ($item->input_type == 'textarea')
                <div class="col-md-4 mb-2">
                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                    <textarea id="tenmaudon" name="tentruong[{{ $item->id }}]" placeholder=""
                        class="form-control" required="required"></textarea>
                </div>
                @endif
        @endforeach
    </div>
    <!-- THÔNG TIN ĐÍNH KÈM -->
    @isset($flag)
        <div class="form-group row">
            <div class="col-12">
                <h5>Đính kèm</h5>
            </div>
        </div>
        @foreach ($truong as $item)
            @if ($item->input_type == 'file')
                <div class="form-group row">
                    <div class="col-md-12 mb-2">
                        <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                        <input id="tenmaudon" name="tentruong[{{ $item->id }}]" placeholder=""
                            type="file" class="form-control" required="required">
                    </div>
                </div>
            @endif
        @endforeach
    @endisset
    <!-- SUMIT -->
    <div class="form-group row">
        <div class="col-12">
            <button type="submit" class="btn btn-block btn-primary">Cập nhật</button>
        </div>
    </div>
</form>
