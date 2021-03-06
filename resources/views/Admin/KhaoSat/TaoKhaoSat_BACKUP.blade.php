@extends('layout.admin_layout')
@section('body')
    <form method="post" action="{{route('admin.khaosat.taokhaosat.post')}}" class="row">
       {{csrf_field()}}
       <div class="col-md-5">
           <div class="bg-white p-3 mb-3">
               <h6><i class="fa fa-info-circle mr-2"></i>Thông tin khảo sát</h6>
               <hr/>
               <div class="form-group">
                   <label for="tenmau">Tên mẫu khảo sát</label>
                   <input id="tenmau" name="tenmau" placeholder="Tên mẫu khảo sát" type="text" required="required" class="form-control rounded">
               </div>
               <div class="form-group">
                   <label for="slug">Slug</label>
                   <input id="slug" name="slug" placeholder="Slug" type="text" required="required" class="form-control rounded">
               </div>
               <div class="form-group">
                   <label for="mota">Mô tả khảo sát</label>
                   <textarea id="mota" name="mota" cols="40" rows="5" class="form-control rounded"></textarea>
               </div>
               <div class="form-group row mt-3">
                   <div class="col-md-12"><button type="submit" class="form-control btn btn-primary btn-sm">Lưu</button></div>
               </div>
           </div>
       </div>
        <style>
            .mb-3{
                margin-bottom: 1rem;
            }
            .p-3{
                padding: 1rem;
            }
            .ml-24{
                margin-left: 24px;
            }
        </style>
        <div class="col-md-7">
            <div class="bg-white p-3">
                <div id="noidungkhaosat">
                    <h6><i class="fa fa-question mr-2"></i>Nội dung khảo sát</h6>
                    <hr/>

                    <div class="form-group row poll-hover">
                        <div class="col-md-8">
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12">--}}
                                    <input id="tenmau" name="noidungcauhoi[]" placeholder="Nội dung câu hỏi" type="text" required="required"
                                           class="form-control rounded custom-select">
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row" style="margin-top: 1rem">
                                <div class="col-lg-8 ml-24">
                                    <input name="traloitracnghiem[0][]" placeholder="Nội dung câu hỏi" type="text" required="required"
                                           class="form-control rounded mb-3">
                                    <input id="tenmau" name="traloitracnghiem[0][]" placeholder="Nội dung câu hỏi" type="text" required="required"
                                           class="form-control rounded mb-3">
                                    <input id="tenmau" name="traloitracnghiem[0][]" placeholder="Nội dung câu hỏi" type="text" required="required"
                                           class="form-control rounded mb-3">
                                    <input id="tenmau" name="traloitracnghiem[0][]" placeholder="Nội dung câu hỏi" type="text" required="required"
                                           class="form-control rounded mb-3">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="loai" name="loai[]" class="custom-select rounded">
                                @foreach($ds_loai as $value)
                                    <option value="{{$value->id}}">{{$value->tenloai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1"><button class="btn btn-danger btn-sm form-control" onclick="this.parentElement.parentElement.remove()" type="button">Xoá</button></div></div>
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
    <div style="display: none">
        <div id="questionrow" class="row" style="margin-top: 1rem">
            <div class="col-lg-8 ml-24">
                <input id="tempdapan" name="traloitracnghiem[0][]" placeholder="Nội dung câu hỏi" type="text" required="required"
                       class="form-control rounded mb-3">
            </div>
        </div>
    </div>
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
                btn_xoa.innerHTML = "Xoá";
                btn_xoa.setAttribute('onclick', 'this.parentElement.parentElement.remove()');
                btn_xoa.setAttribute('type', 'button');

                //Input
                let input_noidung = document.createElement('input');
                input_noidung.classList.add('form-control', 'rounded');
                input_noidung.name = 'noidungcauhoi[]';
                //Loai
                let select_loai = document.createElement('select');
                select_loai.classList.add('form-control', 'rounded');
                select_loai.innerHTML = loai_html;
                select_loai.name = "loai[]";

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