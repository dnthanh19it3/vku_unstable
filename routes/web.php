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
    Route::prefix('zalo-chatbot')->group(function (){
        Route::get('intent', 'AdAiController@trainAiIndex')->name('ad.zalo.trainai');

        Route::get('intent-add', 'AdAiController@addIntentView')->name('ad.zalo.addintent');
        Route::post('intent-add', 'AdAiController@addIntentPost')->name('ad.zalo.addintent.post');

        Route::get('intent-edit/{intent_id}', 'AdAiController@editIntentView')->name('ad.zalo.editintent');
        Route::post('intent-edit/{intent_id}', 'AdAiController@editIntentPost')->name('ad.zalo.editintent.post');


        Route::post('response-edit/{intent_id}', 'AdAiController@editResponsePost')->name('ad.zalo.editresponse.post');
        Route::post('response-add/{intent_id}', 'AdAiController@addResponsePost')->name('ad.zalo.addresponse.post');

        Route::post('pattern-add/{intent_id}', 'AdAiController@addPatternPost')->name('ad.zalo.addpattern.post');
        Route::post('pattern-edit/{intent_id}', 'AdAiController@editPatternPost')->name('ad.zalo.editpattern.post');

    });
    Route::prefix('hrm')->group(function (){
        Route::prefix('get-danh-muc')->group(function (){
            Route::get('bac-luong/{ngach}/{bac}', 'AdHrmController@getBacLuong')->name('ad.hrm.dm.bluong');
            Route::get('bac-luong', 'AdHrmController@getBacLuong')->name('ad.hrm.dm.bluong.noparam');
            Route::get('ma-loai', 'AdHrmController@getMaLoai')->name('ad.hrm.dm.maloai.noparam');
            Route::get('ma-loai/{ngach}', 'AdHrmController@getMaLoai')->name('ad.hrm.dm.maloai');
            Route::get('linh-vuc', 'AdHrmController@getKhoiNganh')->name('ad.hrm.dm.linhvuc.noparam');
            Route::get('linh-vuc/{khoinganh}', 'AdHrmController@getKhoiNganh')->name('ad.hrm.dm.linhvuc');
        });
        Route::prefix('quan-ly-nhan-vien')->group(function (){
            // Them nhan vien
            Route::get('them', 'AdHrmController@themNhanVienView')->name('ad.hrm.nhanvien.them');
            Route::post('them', 'AdHrmController@themNhanVienPost')->name('ad.hrm.nhanvien.them.post');
            Route::prefix('{ma_gv}')->group(function (){
                //Sua nhan vien
                Route::get('sua', 'AdHrmController@suaNhanVienView')->name('ad.hrm.nhanvien.sua');
                Route::post('sua', 'AdHrmController@suaNhanVienPost')->name('ad.hrm.nhanvien.sua.post');
                //Cong tac nuoc ngoai
                Route::get('cong-tac-ngoai-nuoc', 'AdHrmController@congTacNuocNgoaiView')->name('ad.hrm.congtacnuocngoai.view');
                Route::get('getdata-cong-tac-ngoai-nuoc', 'AdHrmController@congTacNuocNgoaiGetData')->name('ad.hrm.congtacnuocngoai.getdata');
                Route::post('them-cong-tac-ngoai-nuoc', 'AdHrmController@congTacNuocNgoaiThemPost')->name('ad.hrm.congtacnuocngoai.them.post');
                Route::post('sua-cong-tac-ngoai-nuoc', 'AdHrmController@congTacNuocNgoaiSuaPost')->name('ad.hrm.congtacnuocngoai.sua.post');
                Route::get('xoa-cong-tac-ngoai-nuoc', 'AdHrmController@congTacNuocNgoaiXoa')->name('ad.hrm.congtacnuocngoai.xoa');
                //Cong tac
                Route::get('cong-tac', 'AdHrmController@congTacView')->name('ad.hrm.congtac.view');
                Route::get('getdata-cong-tac', 'AdHrmController@congTacGetData')->name('ad.hrm.congtac.getdata');
                Route::post('them-cong-tac', 'AdHrmController@congTacThemPost')->name('ad.hrm.congtac.them.post');
                Route::post('sua-cong-tac', 'AdHrmController@congTacSuaPost')->name('ad.hrm.congtac.sua.post');
                Route::get('xoa-cong-tac', 'AdHrmController@congTacXoa')->name('ad.hrm.congtac.xoa');
                //Nghi phep
                Route::get('nghi-phep', 'AdHrmController@nghiPhepView')->name('ad.hrm.nghiphep.view');
                Route::get('getdata-nghiphep', 'AdHrmController@nghiPhepGetData')->name('ad.hrm.nghiphep.getdata');
                Route::post('them-nghi-phep', 'AdHrmController@nghiPhepThemPost')->name('ad.hrm.nghiphep.them.post');
                Route::post('sua-nghi-phep', 'AdHrmController@nghiPhepSuaPost')->name('ad.hrm.nghiphep.sua.post');
                Route::get('xoa-nghi-phep', 'AdHrmController@nghiPhepXoa')->name('ad.hrm.nghiphep.xoa');
                //Khen thuong
                Route::get('khen-thuong', 'AdHrmController@khenThuongView')->name('ad.hrm.khenthuong.view');
                Route::get('getdata-khenthuong', 'AdHrmController@khenThuongGetData')->name('ad.hrm.khenthuong.getdata');
                Route::post('them-khen-thuong', 'AdHrmController@khenThuongThemPost')->name('ad.hrm.khenthuong.them.post');
                Route::post('sua-khen-thuong', 'AdHrmController@khenThuongSuaPost')->name('ad.hrm.khenthuong.sua.post');
                Route::get('xoa-khen-thuong', 'AdHrmController@khenThuongXoa')->name('ad.hrm.khenthuong.xoa');
                //Ky luat
                Route::get('ky-luat', 'AdHrmController@kyLuatView')->name('ad.hrm.kyluat.view');
                Route::get('getdata-kyluat', 'AdHrmController@kyLuatGetData')->name('ad.hrm.kyluat.getdata');
                Route::post('them-ky-luat', 'AdHrmController@kyLuatThemPost')->name('ad.hrm.kyluat.them.post');
                Route::post('sua-ky-luat', 'AdHrmController@kyLuatSuaPost')->name('ad.hrm.kyluat.sua.post');
                Route::get('xoa-ky-luat', 'AdHrmController@kyLuatXoa')->name('ad.hrm.kyluat.xoa');
                //Dao tao
                Route::get('dao-tao', 'AdHrmController@daoTaoView')->name('ad.hrm.daotao.view');
                Route::get('getdata-daotao', 'AdHrmController@daoTaoGetData')->name('ad.hrm.daotao.getdata');
                Route::post('them-dao-tao', 'AdHrmController@daoTaoThemPost')->name('ad.hrm.daotao.them.post');
                Route::post('sua-dao-tao', 'AdHrmController@daoTaoSuaPost')->name('ad.hrm.daotao.sua.post');
                Route::get('xoa-dao-tao', 'AdHrmController@daoTaoXoa')->name('ad.hrm.daotao.xoa');
                //Boi duong
                Route::get('boi-duong', 'AdHrmController@boiDuongView')->name('ad.hrm.boiduong.view');
                Route::get('getdata-boiduong', 'AdHrmController@boiDuongGetData')->name('ad.hrm.boiduong.getdata');
                Route::post('them-boi-duong', 'AdHrmController@boiDuongThemPost')->name('ad.hrm.boiduong.them.post');
                Route::post('sua-boi-duong', 'AdHrmController@boiDuongSuaPost')->name('ad.hrm.boiduong.sua.post');
                Route::get('xoa-boi-duong', 'AdHrmController@boiDuongXoa')->name('ad.hrm.boiduong.xoa');
                //Than nhan trong nuoc
                Route::get('than-nhan-trong-nuoc', 'AdHrmController@thanNhanTrongNuocView')->name('ad.hrm.thannhantrongnuoc.view');
                Route::get('getdata-thannhantrongnuoc', 'AdHrmController@thanNhanTrongNuocGetData')->name('ad.hrm.thannhantrongnuoc.getdata');
                Route::post('them-than-nhan-trong-nuoc', 'AdHrmController@thanNhanTrongNuocThemPost')->name('ad.hrm.thannhantrongnuoc.them.post');
                Route::post('sua-than-nhan-trong-nuoc', 'AdHrmController@thanNhanTrongNuocSuaPost')->name('ad.hrm.thannhantrongnuoc.sua.post');
                Route::get('xoa-than-nhan-trong-nuoc', 'AdHrmController@thanNhanTrongNuocXoa')->name('ad.hrm.thannhantrongnuoc.xoa');
                //Than nhan nuoc ngoai
                Route::get('than-nhan-ngoai-nuoc', 'AdHrmController@thanNhanNgoaiNuocView')->name('ad.hrm.thannhanngoainuoc.view');
                Route::get('getdata-thannhanngoainuoc', 'AdHrmController@thanNhanNgoaiNuocGetData')->name('ad.hrm.thannhanngoainuoc.getdata');
                Route::post('them-than-nhan-ngoai-nuoc', 'AdHrmController@thanNhanNgoaiNuocThemPost')->name('ad.hrm.thannhanngoainuoc.them.post');
                Route::post('sua-than-nhan-ngoai-nuoc', 'AdHrmController@thanNhanNgoaiNuocSuaPost')->name('ad.hrm.thannhanngoainuoc.sua.post');
                Route::get('xoa-than-nhan-ngoai-nuoc', 'AdHrmController@thanNhanNgoaiNuocXoa')->name('ad.hrm.thannhanngoainuoc.xoa');
                //Tham gia llvt
                Route::get('tham-gia-llvt', 'AdHrmController@thamGiaLlvtView')->name('ad.hrm.thamgiallvt.view');
                Route::get('getdata-thamgiallvt', 'AdHrmController@thamGiaLlvtGetData')->name('ad.hrm.thamgiallvt.getdata');
                Route::post('them-tham-gia-llvt', 'AdHrmController@thamGiaLlvtThemPost')->name('ad.hrm.thamgiallvt.them.post');
                Route::post('sua-tham-gia-llvt', 'AdHrmController@thamGiaLlvtSuaPost')->name('ad.hrm.thamgiallvt.sua.post');
                Route::get('xoa-tham-gia-llvt', 'AdHrmController@thamGiaLlvtXoa')->name('ad.hrm.thamgiallvt.xoa');
                //Huong luong
                Route::get('huong-luong', 'AdHrmController@huongLuongView')->name('ad.hrm.huongluong.view');
                Route::get('getdata-huongluong', 'AdHrmController@huongLuongGetData')->name('ad.hrm.huongluong.getdata');
                Route::post('them-huong-luong', 'AdHrmController@huongLuongThemPost')->name('ad.hrm.huongluong.them.post');
                Route::post('sua-huong-luong', 'AdHrmController@huongLuongSuaPost')->name('ad.hrm.huongluong.sua.post');
                Route::get('xoa-huong-luong', 'AdHrmController@huongLuongXoa')->name('ad.hrm.huongluong.xoa');
                //Hop dong
                Route::get('hop-dong', 'AdHrmController@hopDongView')->name('ad.hrm.hopdong.view');
                Route::get('getdata-hopdong', 'AdHrmController@hopDongGetData')->name('ad.hrm.hopdong.getdata');
                Route::post('them-hop-dong', 'AdHrmController@hopDongThemPost')->name('ad.hrm.hopdong.them.post');
                Route::post('sua-hop-dong', 'AdHrmController@hopDongSuaPost')->name('ad.hrm.hopdong.sua.post');
                Route::get('xoa-hop-dong', 'AdHrmController@hopDongXoa')->name('ad.hrm.hopdong.xoa');
                //Hoc ham
                Route::get('hoc-ham', 'AdHrmController@hocHamView')->name('ad.hrm.hocham.view');
                Route::get('getdata-hocham', 'AdHrmController@hocHamGetData')->name('ad.hrm.hocham.getdata');
                Route::post('them-hoc-ham', 'AdHrmController@hocHamThemPost')->name('ad.hrm.hocham.them.post');
                Route::post('sua-hoc-ham', 'AdHrmController@hocHamSuaPost')->name('ad.hrm.hocham.sua.post');
                Route::get('xoa-hoc-ham', 'AdHrmController@hocHamXoa')->name('ad.hrm.hocham.xoa');
            });
        });
    });
    Route::prefix('khao-sat')->group(function (){
        Route::get('danh-sach-mau', 'AdKhaoSatController@danhSachMau')->name('admin.khaosat.danhsachmau');
        Route::get('tao-mau', 'AdKhaoSatController@taoKhaoSat')->name('admin.khaosat.taokhaosat');
        Route::post('tao-mau', 'AdKhaoSatController@taoKhaoSatPost')->name('admin.khaosat.taokhaosat.post');
        Route::get('sua-mau/{id}', 'AdKhaoSatController@suaKhaoSat')->name('admin.khaosat.suakhaosat');
        Route::post('sua-mau/{id}', 'AdKhaoSatController@suaKhaoSatPost')->name('admin.khaosat.suakhaosat.post');
        Route::get('xoa-mau/{id}', 'AdKhaoSatController@getXoaKhaoSat')->name('admin.khaosat.xoakhaosat');
        Route::get('bao-cao/{id}', 'AdKhaoSatController@baoCao')->name('admin.khaosat.baocao');
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
    Route::get('connect', 'ZaloAPI@linkPage')->name('zalo.linkpage');
    Route::post('connect', 'ZaloAPI@linkPagePost')->name('zalo.linkpage.post');
    Route::prefix('follower')->group(function (){
        Route::get('user_info', 'ZaloAPI@getThongTinNguoiDung');
    });
    Route::get('send_msg_text', 'ZaloAPI@guiTinNhanText');
});


Route::get('test-field', 'AdDonTuController@getStaticFieldData');
Route::get('email', 'AdQuanLySv@getEmail');
Route::get('get_regex', 'AdGiangVienChitietController@getInfo');
Route::get('test_ui', 'AdGiangVienChitietController@testui');
Route::get('test_zalo', 'ZaloAPI@test');

Route::get('get-intent', 'AdAiController@exportIntent')->name('ai.getintent');