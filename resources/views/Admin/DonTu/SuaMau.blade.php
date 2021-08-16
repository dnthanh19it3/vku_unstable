@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">Thông tin chung</div>
                <div class="card-body">
                    <form method="post" action="{{ route('maudon.Store') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="tenmaudon" class="col-4 col-form-label">Tên trường</label>
                            <div class="col-12">
                                <input id="tenmaudon" name="tenmaudon" placeholder="Tên đơn" type="text"
                                       class="form-control" required="required" value="{{$maudon->tenmaudon}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tenmaudon" class="col-4 col-form-label">Thời gia xử lý</label>
                            <div class="col-12">
                                <input id="thoigianxuly" name="thoigianxuly" type="number" class="form-control"
                                       required="required" value="7" value="{{$maudon->thoigianxuly}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dieukhoan" class="col-4 col-form-label">Điều khoản</label>
                            <div class="col-12">
                                <input id="dieukhoan" name="dieukhoan" placeholder="Điều khoản" type="text"
                                       class="form-control" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dieukhoan" class="col-4 col-form-label">Mô tả</label>
                            <div class="col-12">
                                <textarea name="mota" id="editor" class="form-control" placeholder="Mô tả về đơn">{{$maudon->mota}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dieukhoan" class="col-4 col-form-label">Loại</label>
                            <div class="col-12">
                                <select name="loai_id" class="form-control" value="{{$maudon->loai_id}}">
                                    <option value="1">Yêu cầu</option>
                                    <option value="0">Đơn</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dieukhoan" class="col-4 col-form-label">Đơn vị xử lý</label>
                            <div class="col-12">
                                <select name="donvi_id" class="form-control" value="{{$maudon->loai_id}}>
                                    @foreach($phongban as $item)
                                        <option value="{{$item->id}}">{{$item->tenphongban}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input type="text" name="truong" id="truong" hidden="true">
                                <ol id="listTruongSelected">

                                </ol>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 mx-auto">
                                <button type="submit" class="btn btn-block btn-primary">Tạo đơn mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-3">
                <div class="card-header">Trường dữ liệu</div>
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            <input id="searchtruong" name="text" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="listtruong">
                            <ul id="resultdiv">
                                <li role="button">Loading...</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 d-flex flex-row-reverse pr-4">
                            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                    data-target="#modal_themtruong">Thêm trường mới</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="modal fade" id="modal_themtruong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form id="themtruongform">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm trường dữ liệu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <label for="tenmaudon" class="col-4 col-form-label">Tên trường</label>
                        <div class="form-group row">

                            <div class="col-8">
                                <input id="tentruong" name="tentruong" placeholder="Tên trường muốn thêm" type="text"
                                       class="form-control" required="required">
                            </div>

                            <div class="col-4">
                                <select name="loai_id" class="form-control">
                                    @foreach ($fileType as $item)
                                        <option value="{{ $item->loai_id }}">{{ $item->loai }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-2">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tenmaudon" class="col-4 col-form-label">Ghi chú</label>
                            <div class="col-12">
                                <input id="ghichutruong" name="ghichutruong" placeholder="Ghi chú" type="text"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-primary">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#searchtruong').keyup(function() {
                var searchkey = $(this).val();
                $.ajax({
                    url: '{{ route('ajax_searchtruong') }}',
                    type: "GET",
                    dataType: 'text',
                    data: {
                        name: searchkey
                    }
                }).done(function(result) {
                    var rs = JSON.parse(result);
                    renderReult(rs, $('#resultdiv'));
                })
            })
            $(document).ready(function() {
                reload();
            })
        })
        function reload() {
            $.ajax({
                url: '{{ route('ajax_searchtruong') }}',
                type: "GET",
                dataType: 'text',
                data: {
                    name: ''
                }
            }).done(function(result) {
                var rs = JSON.parse(result);
                renderReult(rs, $('#resultdiv'));
            })
        }

        function renderReult(data, parentdiv) {
            parentdiv.empty();
            for (var item of data) {
                console.log(item.tentruong)
                var node = document.createElement("li"); // Create a <li> node
                var textnode = document.createTextNode(item.tentruong); // Create a text node
                node.setAttribute("role", "button");
                node.setAttribute("value", item.id);
                node.setAttribute("onClick", "themTruong(" + item.id + ",'" + item.tentruong +
                    "')");
                node.appendChild(textnode); // Append the text to <li>
                parentdiv.append(node);
            }
        }

    </script>
    <script>
        $(document).ready(function() {
            $("#themtruongform").submit(function(event) {
                var ajaxRequest;
                event.preventDefault();
                var values = $(this).serialize();
                ajaxRequest = $.ajax({
                    url: "{{ route('truong.Store') }}" + '?_token=' + '{{ csrf_token() }}',
                    type: "post",
                    data: values
                });
                ajaxRequest.done(function(response, textStatus, jqXHR) {
                    var rs = JSON.parse(response);
                    var liNode = document.createElement('li');
                    var textNode = document.createTextNode(rs.tentruong);
                    liNode.setAttribute('role', 'button');
                    liNode.setAttribute("id", "node" + rs.id);
                    liNode.setAttribute("onClick", "themTruong(" + rs.id + ",'" + rs.tentruong +
                        "')");
                    $('#tentruong').val('');
                    liNode.appendChild(textNode);
                    reload();
                    $('#modal_themtruong').modal('hide');
                    // $('#listtruongContainer').append(liNode);

                });
                ajaxRequest.fail(function() {

                });
            });
        });
    </script>
    <script type="text/javascript">
        var listtruong = '';
        var truong = $('#truong');
        var listtruongContainer = $('#listtruongContainer');

        function themTruong(truongid, tentruong) {
            listtruong = listtruong += truongid + ',';
            truong.val(listtruong);
            $('#node' + truongid).remove();
            // add node to selected list
            var linode = document.createElement('li');
            var node = document.createTextNode(tentruong);
            linode.appendChild(node);
            $('#listTruongSelected').append(linode);
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
