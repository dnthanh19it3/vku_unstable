<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('css/cv_css.css')}}"/>
    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div class="row head_cv">
        <div class="col-md-4 photo_block">
            <img class="img-cv" src="https://ngheannews.com/wp-content/uploads/2020/04/chup-anh-the-o-vinh-3.jpg"/>
            <div class="contact_block">
                <div class="contact_item">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contact_item">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact_item">
                    <i class="fab fa-github"></i>
                </div>
                <div class="contact_item">
                    <i class="fab fa-linkedin-in"></i>
                </div>
                <div class="contact_item mr-0">
                    <i class="fab fa-facebook"></i>
                </div>
            </div>
        </div>
        <div class="col-md-8 general-info">
            <div class="name">Đỗ Ngọc Thanh</div>
            <div class="job_title">Web Developer</div>
            <div class="info_block">
                <div class="contact_item">
                    <i class="fas fa-user"></i>
                    <span>Nam</span>
                </div>
                <div class="contact_item">
                    <i class="far fa-calendar"></i>
                    <span>5/10/1999</span>
                </div>
                <div class="contact_item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>59 Lê Thiện Trị, Phường Hoà Hải, Quận Ngũ Hành Sơn, TP Đà Nẵng</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row body_cv">
        <div class="col-md-7 body_left">
            <div class="body_item">
                <div class="title">
                    Học vấn
                </div>
                <div class="body">
                    <p><b>Đại học CNTT và truyền thông Việt Hàn</b></p>
                    <p><small>8/2019 - 12/2024</small></p>
                    <div>Tốt nghiệp loại siêu cấp vip pro (9.6/ 3.69)</div>
                </div>
            </div>
            <div class="body_item">
                <div class="title">
                   Kĩ năng
                </div>
                <div class="body">
                    êgagg<br>
                    b<br>
                    c
                </div>
            </div>
            <div class="body_item">
                <div class="title">
                    Kinh nghiệm
                </div>
                <div class="body">
                    @foreach($cv->kinhnghiem as $key => $item)
                        <h6>{{$item->kinhnghiem}}</h6>
                        <div>{{$item->batdau . " - " . $item->ketthuc}}</div>
                        <div>{{$item->chitiet}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5 body_left">
            <div class="body_item">
                <div class="title">
                    Kinh nghiệm
                </div>
                <div class="body">
                    êgagg<br>
                    b<br>
                    c
                </div>
            </div>
            <div class="body_item">
                <div class="title">
                    Kinh nghiệm
                </div>
                <div class="body">
                    êgagg<br>
                    b<br>
                    c
                </div>
            </div>
            <div class="body_item">
                <div class="title">
                    Kinh nghiệm
                </div>
                <div class="body">
                    êgagg<br>
                    b<br>
                    c
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
</body>
</html>