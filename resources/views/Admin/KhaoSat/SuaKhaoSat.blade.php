@extends('layout.admin_layout')
@section('body')
    <form method="post" action="{{route('admin.khaosat.suakhaosat.post', ['id' => $mau->id])}}" class="row">
       {{csrf_field()}}
        <input id="delete_key_input" name="delete_key" type="text" hidden>
       <div class="col-md-5">
           <div class="bg-white p-3 mb-3">
               <h6><i class="fa fa-info-circle mr-2"></i>Thông tin khảo sát</h6>
               <hr/>
               <div class="form-group">
                   <label for="tenmau">Tên mẫu khảo sát</label>
                   <input id="tenmau" name="tenmau" placeholder="Tên mẫu khảo sát" type="text" required="required" value="{{$mau->tenmau}}" class="form-control rounded">
               </div>
               <div class="form-group">
                   <label for="slug">Slug</label>
                   <input id="slug" name="slug" placeholder="Slug" type="text" required="required" value="{{$mau->slug}}" class="form-control rounded">
               </div>
               <div class="form-group">
                   <label for="mota">Mô tả khảo sát</label>
                   <textarea id="mota" name="mota" cols="40" rows="5" class="form-control rounded">{{$mau->mota }}</textarea>
               </div>
               <div class="form-group row mt-3">
                   <div class="col-md-12"><button type="submit" class="form-control btn btn-primary btn-sm">Lưu</button></div>
               </div>
           </div>

       </div>
        <div class="col-md-7">
            <div class="bg-white p-3">
                <div id="noidungkhaosat">
                    <h6><i class="fa fa-question mr-2"></i>Nội dung khảo sát</h6>
                    <hr/>
                    @foreach($ds_cauhoi as $key => $item)
                        <div class="form-group row poll-hover">
                            <div class="col-md-8">
                                <input type="hidden" name="cauhoi_id[]" value="{{$item->id}}">
                                <input id="tenmau" name="noidungcauhoi[]" placeholder="Nội dung câu hỏi" type="text" required="required" value="{{$item->cauhoi}}"
                                       class="form-control rounded">
                            </div>
                            <div class="col-md-3">
                                <select id="loai" name="loai[]" class="custom-select rounded">
                                    @foreach($ds_loai as $value)
                                        <option value="{{$value->id}}" {{$item->loai == $value->id ? "selected" : ""}}>{{$value->tenloai}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="hidden" id="quest{{{$item->id}}}" value="{{$item->id}}">
                                <button class="btn btn-danger btn-sm form-control" onclick="xoaFunction(this, quest{{{$item->id}}})" type="button"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                    </div>

                <div class="form-group row">
                    <div class="col-md-12" style="padding: 16px; margin-bottom: -24px">
                        <button id="btn_themcauhoi" type="button" class="btn btn-primary btn-sm form-control">
                            <i class="fa fa-plus-circle mr-2"></i>Thêm
                        </button>
                    </div>
                </div>
            </div>


            </div>
   </form>
@endsection
@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/survey.css')}}">
    <style>
        .noidungcauhoi {
            border: none; border-bottom: 1px solid #cdcdcd; font-size: 18px
        }
        .poll-hover:hover {
            background: rgba(205, 205, 205, 0.2);
        }

        .poll-hover {
            border-radius: 8px;
            padding: 16px 8px;
        }

    </style>
@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#mota' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        document.querySelectorAll('.feedback li').forEach(entry => entry.addEventListener('click', e => {
            if(!entry.classList.contains('active')) {
                document.querySelector('.feedback li.active').classList.remove('active');
                entry.classList.add('active');
            }
            e.preventDefault();
        }));
    </script>
    <script>
        const noidungkhaosat = $('#noidungkhaosat');
        const loai_html = "@foreach($ds_loai as $value) <option value='{{$value->id}}'>{{$value->tenloai}}</option> @endforeach";
        let dapan = 0;
        let add = [];
        let remove = [];
        function xoaFunction(element, element_id){
            let delete_key = element_id.value;
            remove.push(delete_key);
            let delete_key_input = document.getElementById('delete_key_input');
            delete_key_input.value = remove.join(',');
            element.parentElement.parentElement.remove();
        }
        $(document).ready(attr=>{
            $('#btn_themcauhoi').click(function (attr){
                /**
                 * Tao object
                 * */
                //Div
                let divcau = document.createElement('div');
                let divnoidungcauhoi = document.createElement('div');
                let divloaicauhoi = document.createElement('div');
                let divbtn = document.createElement('div');
                //Btn xoa
                let btn_xoa = document.createElement('button');
                btn_xoa.classList.add('btn', 'btn-danger', 'btn-sm', 'form-control')
                btn_xoa.innerHTML = "<i class=\"fa fa-trash\"></i>";
                btn_xoa.setAttribute('onclick', 'this.parentElement.parentElement.remove()');
                btn_xoa.setAttribute('type', 'button');

                //Input
                let input_noidung = document.createElement('input');
                input_noidung.classList.add('form-control', 'rounded');
                input_noidung.name = 'noidungcauhoi_add[]';
                //Loai
                let select_loai = document.createElement('select');
                select_loai.classList.add('form-control', 'rounded');
                select_loai.innerHTML = loai_html;
                select_loai.name = "loai_add[]";

                divcau.classList.add('form-group', 'row', 'poll-hover');
                divnoidungcauhoi.classList.add('col-md-8');
                divloaicauhoi.classList.add('col-md-3');
                divbtn.classList.add('col-md-1');


                divcau.append(divnoidungcauhoi, divloaicauhoi, divbtn);
                divnoidungcauhoi.append(input_noidung);
                divloaicauhoi.append(select_loai);
                divbtn.append(btn_xoa);

                noidungkhaosat.append(divcau);

                dapan++;
            });
        });
    </script>
@endsection