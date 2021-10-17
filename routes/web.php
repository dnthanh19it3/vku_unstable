<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth Route
use Illuminate\Support\Facades\Route;


Route::prefix('tools')->group(function (){
    Route::get('crawl_student_image', 'ToolController@crawlAvatar');
});


Route::get('sv/login', 'SvAuthController@webLoginView')->name('sv.login.view');
Route::post('sv/login', 'SvAuthController@webLogin')->name('sv.login');

Route::get('admin/login', 'AdminAuthController@webLoginView')->name('admin.login.view');
Route::post('admin/login', 'AdminAuthController@webLogin')->name('admin.login');
Route::get('admin/logout', 'AdminAuthController@webLogout')->name('admin.logout');

Route::get('sv/ly-lich/{masv}', 'SvLyLichController@getLyLich')->name('sv.getlylich');
Route::prefix('sv')->middleware('sv')->group(function () {
    Route::prefix('khao-sat')->group(function () {
        Route::get('lam-khao-sat/{slug}', 'SvKhaoSatController@lamKhaoSat')->name('sv.khaosat.lamkhaosat');
        Route::post('lam-khao-sat', 'SvKhaoSatController@lamKhaoSatPost')->name('sv.khaosat.lamkhaosat.post');
    });
    Route::prefix('hoso')->group(function () {
        //Ho so
        Route::post('upload', 'SvHoSoController@imgUpload')->name('upload');
        Route::get('suahoso', 'SvHoSoController@suahosoIndex')->name('suahoso');
        Route::get('xemhoso', 'SvHoSoController@hosoIndex')->name('xemhoso');
        Route::get('xemhoso2', 'SvHoSoController@hosoIndex2')->name('xemhoso2');
        Route::post('suahoso', 'SvHoSoController@suahosoStore')->name('suahosoStore');
        Route::get('xuatpdf', 'SvHoSoController@exportPDF');
        //Ly Lich

    });
    Route::prefix('tam-tru')->group(function(){
        //Tam tru
        Route::get('/', 'SvTamTruController@tamTruIndex')->name('sv.tamtru.index');
        Route::get('taotamtru', 'SvTamTruController@taoTamTru')->name('taotamtru');
        Route::post('taotamtru', 'SvTamTruController@taoTamTruStore')->name('taotamtru.store');
        //Get dia chi
        Route::get('get-xa-phuong', 'SvTamTruController@getXaPhuong')->name('sv.tamtru.getxaphuong');
        Route::get('get-quan-huyen', 'SvTamTruController@getQuanHuyen')->name('sv.tamtru.getquanhuyen');
    });
    Route::prefix('hoplop')->group(function (){
        Route::get('danh-sach', 'SvHopLop@listHopLopIndex')->name('sv.hoplop.listhoplop');
        Route::get('lap-bien-ban', 'SvHopLop@taoBienBanIndex')->name('sv.hoplop.taobienban');
        Route::post('lap-bien-ban', 'SvHopLop@taoBienBanStore')->name('sv.hoplop.taobienban.store');

        Route::prefix('{id}')->group(function (){
            Route::get('sua-bien-ban', 'SvHopLop@suaBienBanIndex')->name('sv.hoplop.suabienban');
            Route::post('sua-bien-ban', 'SvHopLop@suaBienBanUpdate')->name('sv.hoplop.suabienban.update');
            Route::get('xem-bien-ban', 'SvHopLop@xemBienBanIndex')->name('sv.hoplop.xembienban');
            Route::get('duyet-bien-ban/{role}', 'SvHopLop@xacNhan')->name('sv.hoplop.xacnhan');
        });

    });
    Route::prefix('thutucmotcua')->group(function () {
        // Tao don
        Route::get('danhsach', 'SvDonTuController@taoDonIndex')->name('sv.danhsachthutuc');
        Route::get('chitiet/{maudon_id}', 'SvDonTuController@chiTietThuTuc')->name('sv.chitietthutuc');
        Route::post('nopdon/{donid}', 'SvDonTuController@nopdonStore')->name('nopdon.Store');
        Route::get('theodoidon', 'SvDonTuController@donDaNop')->name('sv.theodoidon');
        Route::get('theodoidon/{don_id}', 'SvDonTuController@donChiTiet')->name('sv.theodoidon.chitiet');
        Route::get('capnhatdon/{don_id}', 'SvDonTuController@capNhatDon')->name('capnhatdon');
        Route::get('capnhatdon/{don_id}', 'SvDonTuController@capNhatDon')->name('capnhatdon');
        Route::post('capnhatdon/{don_id}', 'SvDonTuController@capnhatdonStore')->name('capnhatdonStore');
    });
    //Cv
    Route::prefix('cv')->group(function () {
        Route::get('taocv', 'SvCvController@taoCvView')->name('taocvView');
        Route::post('taocv', 'SvCvController@taoCvStore')->name('taocvStore');
        Route::get('xem/{masv}', 'SvCvController@cvViewer')->name('cv.xem');
    });
    Route::get('logout', 'SvAuthController@webLogout')->name('sv.logout');
});



Route::prefix('admin')->middleware('chuyenvien')->group(function(){
    Route::prefix('khao-sat')->group(function (){
        Route::get('danh-sach-mau', 'AdKhaoSatController@danhSachMau')->name('admin.khaosat.danhsachmau');
        Route::get('tao-mau', 'AdKhaoSatController@taoKhaoSat')->name('admin.khaosat.taokhaosat');
        Route::post('tao-mau', 'AdKhaoSatController@taoKhaoSatPost')->name('admin.khaosat.taokhaosat.post');
        Route::get('sua-mau/{id}', 'AdKhaoSatController@suaKhaoSat')->name('admin.khaosat.suakhaosat');
        Route::post('sua-mau/{id}', 'AdKhaoSatController@suaKhaoSatPost')->name('admin.khaosat.suakhaosat.post');
        Route::get('xoa-mau/{id}', 'AdKhaoSatController@getXoaKhaoSat')->name('admin.khaosat.xoakhaosat');
        Route::get('bao-cao/{id}', 'AdKhaoSatController@getBaoCao')->name('admin.khaosat.baocao');
    });
    Route::prefix('danhgiarenluyen')->group(function (){
        Route::get('/', 'AdDanhGiaRenLuyen@danhGiaRenLuyenView')->name('admin.danhgiarenluyen.index');
        Route::get('/xem/{lop_id}', 'AdDanhGiaRenLuyen@xemDiemRenluyen')->name('admin.danhgiarenluyen.xem');
        Route::post('import_excel', 'AdDanhGiaRenLuyen@getExcel')->name('admin.danhgiarenluyen.importexcel');
        Route::post('commit', 'AdDanhGiaRenLuyen@commitData')->name('admin.danhgiarenluyen.commit');
    });
    Route::prefix('hop-lop')->group(function (){
        //Add-on route
        Route::get('get-link-bien-ban', 'AdQuanLyHopLop@getLinkBienBan')->name('ad.hoplop.linklistbienban');
        Route::get('get-link-phan-hoi', 'AdQuanLyHopLop@getLinkPhanHoi')->name('ad.hoplop.linklistphanhoi');
        Route::get('get-link-du-kien', 'AdQuanLyHopLop@getLinkDuKien')->name('ad.hoplop.linklistdukien');
        Route::post('cap-nhat-noi-dung-du-kien/{id}', 'AdQuanLyHopLop@duKienUpdate')->name('ad.hoplop.noidungdukien.capnhat');
        // Duyệt có sẵn tham số
        Route::prefix('{namhoc}/{hocky}')->group(function (){
            Route::get('danh-sach', 'AdQuanLyHopLop@listHopLopIndex')->name('ad.hoplop.listhoplop');
            Route::get('tong-hop-phan-hoi', 'AdQuanLyHopLop@listPhanHoiIndex')->name('ad.hoplop.tonghopphanhoi');
            Route::get('noi-dung-du-kien', 'AdQuanLyHopLop@noiDungDeXuatIndex')->name('ad.hoplop.noidungdukien');
            Route::post('tao-noi-dung-du-kien', 'AdQuanLyHopLop@duKienStore')->name('ad.hoplop.noidungdukien.tao');

        });
        // Duyệt chưa có tham số
        Route::get('danh-sach', 'AdQuanLyHopLop@listHopLopIndex')->name('ad.hoplop.listhoplop.nullable');
        Route::get('tong-hop-phan-hoi', 'AdQuanLyHopLop@listPhanHoiIndex')->name('ad.hoplop.tonghopphanhoi.nullable');
        Route::get('noi-dung-du-kien', 'AdQuanLyHopLop@noiDungDeXuatIndex')->name('ad.hoplop.noidungdukien.nullable');


        //Xử lý biên bản
        Route::prefix('bienban/{id}')->group(function (){
            Route::get('xem-bien-ban', 'AdQuanLyHopLop@xemBienBanIndex')->name('admin.hoplop.xembienban');
            Route::post('phan-hoi', 'AdQuanLyHopLop@phanHoi')->name('ad.hoplop.phanhoi');
            Route::prefix('duyet')->group(function (){
                Route::get('gvcn', 'AdQuanLyHopLop@duyetGvcn')->name('admin.hoplop.duyet.gvcn');
                Route::get('khoa', 'AdQuanLyHopLop@duyetKhoa')->name('admin.hoplop.duyet.khoa');
                Route::get('ctsv', 'AdQuanLyHopLop@duyetCtsv')->name('admin.hoplop.duyet.ctsv');
                Route::get('bgh', 'AdQuanLyHopLop@duyetBgh')->name('admin.hoplop.duyet.bgh');
            });
        });
    });
    Route::prefix('donthu')->group(function () {
        Route::prefix('mau')->group(function () {
            // CRUD
            Route::get('taomau', 'AdDonTuController@themDonIndex')->name('themmau');
            Route::post('taomau', 'AdDonTuController@maudonStore')->name('maudon.Store');
            Route::get('danhsach', 'AdDonTuController@danhSachMauView')->name('danhsachmauView');
            Route::get('suamau/{mau_id}', 'AdDonTuController@chiTietMauView')->name('chitietmauView');
            Route::post('suamau/{mau_id}', 'AdDonTuController@maudonUpdate')->name('maudon.Update');
            Route::get('xoamau/{mau_id}', 'AdDonTuController@xoaMau')->name('maudon.Delete');

            // AJAX
            Route::get('ajax/ajaxtruong', 'AdDonTuController@ajaxTruong')->name('ajaxTruong');
            Route::get('ajax_truong', 'AdDonTuController@ajaxSearchTruong')->name('ajax_searchtruong');
            // Truong don
            Route::prefix('truong')->group(function (){
                Route::post('store', 'AdDonTuController@truongStore')->name('truong.Store');
                Route::post('delete', 'AdDonTuController@truongStore')->name('truong.Store');
            });


        });
        Route::prefix('hoso')->group(function(){
            Route::get('danhsachhoso', 'AdDonTuController@danhSachHoSoIndex')->name('ds_hs');
            Route::get('ajaxdanhsachhs', 'AdDonTuController@ajaxDsHoSo')->name('ajax_ds_hs');
            Route::get('chitiet/{don_id}', 'AdDonTuController@xemHoSo')->name('xem_hs');
            // Ajax solve
            Route::get('tiepnhan/{don_id}', 'AdDonTuController@tiepNhanHoSo')->name('admin.thutuc.tiepnhan');
            Route::post('chuyentiep/{don_id}', 'AdDonTuController@chuyenTiep')->name('admin.thutuc.chuyentiep');
            Route::get('xuly/{don_id}', 'AdDonTuController@duyet')->name('admin.thutuc.duyet');
            Route::post('xacnhan/{don_id}', 'AdDonTuController@daXacNhan')->name('admin.thutuc.xacnhan');
            Route::get('nhan/{don_id}', 'AdDonTuController@kinhanHoSo')->name('admin.thutuc.nhan');
            Route::get('tuchoi/{don_id}', 'AdDonTuController@tuChoiHoSo')->name('admin.thutuc.tuchoi');
        });
        // Dashboard
        Route::get('dashboard', 'AdDonTuController@thuTucDashboard')->name('admin.thutuc.dashboard');
    });
    Route::prefix('quan-ly-lop')->group(function(){
        Route::get('danh-sach', 'AdQuanLyLop@danhSach')->name('admin.quanlylop.danhsach');
        Route::prefix('chi-tiet-lop/{lop_id}')->group(function (){
            Route::get('/', 'AdQuanLyLop@chiTiet')->name('admin.quanlylop.chitietlop');
            Route::get('khen-thuong-ky-luat', 'AdQuanLyLop@khenThuongKyLuat')->name('admin.quanlylop.khenthuongkyluat');
            Route::get('ban-can-su','AdQuanLyLop@banCanSu')->name('admin.quanlylop.bancansu');
            Route::get('bo-nhiem-ban-can-su','AdQuanLyLop@boNhiemBanCanSu')->name('admin.quanlylop.bonhiembancansu');
            Route::post('bo-nhiem-ban-can-su','AdQuanLyLop@boNhiemBanCanSuStore')->name('admin.quanlylop.bonhiembancansu.store');
            Route::get('diem-ren-luyen','AdQuanLyLop@diemRenLuyen')->name('admin.quanlylop.diemrenluyen');
        });
    });
    Route::prefix('quan-ly-sinh-vien')->group(function (){
        Route::get('danhsach', 'AdQuanLySv@danhSachSvView')->name('ad.danhsachsv');
        Route::prefix('{masv}')->group(function (){
            Route::get('xem', 'AdQuanLySv@chiTietSinhVienView')->name('ad.chitietsv');
            Route::prefix('chinhsua')->group(function(){
                //Sua thong tin ca nhan
                Route::get('canhan', 'AdQuanLySv@caNhanView')->name('ad.suasinhvien.canhan');
                Route::post('canhan', 'AdQuanLySv@caNhanStore')->name('ad.suasinhvien.canhan.store');
                //Anh va duyet anh
                Route::get('anh', 'AdQuanLySv@anhView')->name('ad.suasinhvien.anh');
                Route::get('duyetanh', 'AdQuanLySv@duyetAnh')->name('ad.duyetanh');
                //Khen thuong
                Route::get('khenthuong', 'AdQuanLySv@khenThuong')->name('ad.suasinhvien.khenthuong');
                Route::get('themkhenthuong', 'AdQuanLySv@themKhenThuongView')->name('ad.suasinhvien.khenthuong.themview'); //View them khen thuong
                Route::post('themkhenthuong', 'AdQuanLySv@khenThuongStore')->name('ad.suasinhvien.khenthuong.them'); //Store khenthuong
                Route::get('suakhenthuong/{id}', 'AdQuanLySv@suaKhenThuong')->name('ad.suasinhvien.suakhenthuong'); //View sua khen thuong
                Route::post('suakhenthuong/{id}', 'AdQuanLySv@suaKhenThuongStore')->name('ad.suasinhvien.suakhenthuong.store'); // Store sua khen thuong
                Route::get('xoakhenthuong/{id}', 'AdQuanLySv@xoaKhenThuong')->name('ad.suasinhvien.xoakhenthuong'); // Xoa khen thuong
                //Ky luat
                Route::get('kyluat', 'AdQuanLySv@kyLuat')->name('ad.suasinhvien.kyluat');
                Route::get('themkyluat', 'AdQuanLySv@themKyLuatView')->name('ad.suasinhvien.kyluat.themview');
                Route::post('themkyluat', 'AdQuanLySv@kyLuatStore')->name('ad.suasinhvien.kyluat.them');
                Route::get('suakyluat/{id}', 'AdQuanLySv@suaKyLuat')->name('ad.suasinhvien.suakyluat');
                Route::post('suakyluat/{id}', 'AdQuanLySv@suaKyLuatStore')->name('ad.suasinhvien.suakyluat.store');
                Route::get('xoakyluat/{id}', 'AdQuanLySv@xoaKyLuat')->name('ad.suasinhvien.xoakyluat');
            });
        });
    });
    Route::prefix('su-kien')->group(function (){
        Route::get('danh-sach', 'AdSuKienController@suKienIndex')->name('ad.sukien.danhsach');
        Route::get('tao', 'AdSuKienController@taoSuKienView')->name('ad.sukien.tao');
    });
});
Route::prefix('zalo_api')->group(function (){
    Route::get('get_follower', 'ZaloAPI@getDanhSachTheoDoi');
    Route::get('send_msg_text', 'ZaloAPI@guiTinNhanText');
});


Route::get('test-field', 'AdDonTuController@getStaticFieldData');
Route::get('email', 'AdQuanLySv@getEmail');