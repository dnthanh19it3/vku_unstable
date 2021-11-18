@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <!-- Thông tin cá nhân -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Thông tin cá nhân</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="col-xl-2">
                        <label class="btn fileinput-button img-thumbnail form-group" style="width: 100%;">
                            <div class="anh">
                                <div id="imagePreview">
                                    <img id="anhdaidien" src="/img/no-user-image.gif" style="width: 100%;">
                                </div>
                            </div>
                            <i class="glyphicon glyphicon-plus"></i>
                            <div>Chọn ảnh...</div>
                            <input type="file" name="data[User][anh]" id="uploadFile">
                        </label>
                    </div>
                    <div class="group1 col-lg-6 col-xl-5">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Đơn vị <span
                                        style="color:red">(*)</span>:</label>
                            <input type="hidden" name="data[User][madonvi]" id="donvi_id" value="">
                            <div class="col-lg-9">
                                <a rel="facebox" href="/users/tree_donvi">
                                    <input type="text" name="data[User][donvi_id]" class="form-control rounded"
                                           id="TenDonVi" value="">
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Mã nhân viên <span
                                        style="color:red">(*)</span></label>
                            <div class="col-lg-9">
                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" name="data[User][manv]" class="form-control rounded"
                                               readonly="" placeholder="Mã đơn vị" id="manv" value="D2509000">
                                    </div>
                                    <span class="lb-manv">.</span>
                                    <div class="col">
                                        <input name="data[User][manv2]" class="form-control rounded" id="manv2"
                                               data-inputmask="'mask': '999999'" required="required" type="text"
                                               placeholder="">
                                    </div>
                                </div>
                                <b>Quy ước đánh mã nhân viên: </b><i>Mã đơn vị + 06 số với quy ước gồm: : 02 số đầu tiên
                                    là năm tuyển dụng, 02 số tiếp theo là đợt tuyển dụng, 02 số cuối cùng là số thứ tự
                                    theo danh sách trúng tuyển.</i>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Số CMND( Căn cước):</label>
                            <div class="col-lg-9">
                                <input type="number" name="data[User][cmnd]" class="form-control rounded" id="cmnd"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày cấp:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaycap]" class="form-control rounded hasDatepicker"
                                       id="ngaycap" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Nơi cấp:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][noicap]" class="form-control rounded" id="noicap"
                                       value="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Diện ƯT gia đình:</label>
                            <div class="col-lg-9">
                                <select name="data[User][dienuutien_gd_id]"
                                        class="input_dutgd form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="2">Anh hùng Lao động</option>
                                    <option value="1">Anh hùng LLVT</option>
                                    <option value="3">Bà mẹ VN anh hùng</option>
                                    <option value="5">BB có thương tật đặc biệt</option>
                                    <option value="4">Bệnh binh</option>
                                    <option value="11">Gia đình bệnh binh</option>
                                    <option value="9">Gia đình có công với CM</option>
                                    <option value="7">Gia đình liệt sỹ</option>
                                    <option value="13">Gia đình thương binh</option>
                                    <option value="6">GĐ có người bị địch bắt tù đầy</option>
                                    <option value="8">Lão thành CM</option>
                                    <option value="10">Người hưởng CS như T.binh</option>
                                    <option value="12">Quân nhân bị bệnh nghề nghiệp</option>
                                    <option value="14">TB có thương tật đặc biệt</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Diện ƯT bản thân:</label>
                            <div class="col-lg-9">
                                <select name="data[User][dienuutien_bt_id]"
                                        class="input_dutbt form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="7">Học bổng AUF</option>
                                    <option value="4">Kinh phí bộ GD &amp; ĐT</option>
                                    <option value="6">Kinh phí Thành phố</option>
                                    <option value="5">Kinh phí trường</option>
                                    <option value="2">Tự túc</option>
                                    <option value="1">Đề án 132</option>
                                    <option value="3">Đề án 133</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Tôn giáo:</label>
                            <div class="col-lg-9">
                                <select name="data[User][tongiao_id]"
                                        class="input_tongiao form-control custom-select rounded" id="UserTongiaoId">
                                    <option value="">Chọn</option>
                                    <option value="3">Cao đài</option>
                                    <option value="2">Công giáo</option>
                                    <option value="4">Hoà hảo</option>
                                    <option value="6">Hồi giáo</option>
                                    <option value="7">Không</option>
                                    <option value="1">Phật giáo</option>
                                    <option value="5">Tin lành</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hôn nhân:</label>
                            <div class="col-lg-9">
                                <select name="data[User][honnhan]" class="input_hn form-control custom-select rounded"
                                        id="UserHonnhan">
                                    <option value="">Chọn</option>
                                    <option value="Độc thân">Độc thân</option>
                                    <option value="Có gia đình">Có gia đình</option>
                                    <option value="Ly thân">Ly thân</option>
                                    <option value="Ly hôn">Ly hôn</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Xuất thân:</label>
                            <div class="col-lg-9">
                                <select name="data[User][xuatthan_id]"
                                        class="input_xuatthan form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="3">Cán bộ</option>
                                    <option value="12">Công chức NN</option>
                                    <option value="1">Công nhân</option>
                                    <option value="2">Nông dân</option>
                                    <option value="6">Quân nhân</option>
                                    <option value="7">Thợ thủ công</option>
                                    <option value="9">Tiểu chủ</option>
                                    <option value="8">Tiểu thương</option>
                                    <option value="5">Trí thức</option>
                                    <option value="11">Tư sản</option>
                                    <option value="4">Viên chức</option>
                                    <option value="10">Điạ chủ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Tr.thái làm việc:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trangthailamviec_id]"
                                        class="input_ttlamviec form-control custom-select rounded"
                                        id="UserTrangthailamviecId">
                                    <option value="">Chọn</option>
                                    <option value="8">Chuyển đi nơi khác</option>
                                    <option value="4">Đang làm việc</option>
                                    <option value="10">Kỷ luật, bị thôi việc</option>
                                    <option value="3">Nghỉ hưu</option>
                                    <option value="6">Qua đời</option>
                                    <option value="7">Thôi việc</option>
                                    <option value="9">Tự ý bỏ việc, di học quá hạn</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="group2 col-lg-6 col-xl-5">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Họ tên: <span
                                        style="color:red">(*)</span>:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][tennv]" class="form-control rounded" id="tennv"
                                       value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Username: <span style="color:red">(*)</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][username]" class="form-control rounded"
                                       id="username" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-lg-3 col-form-label">Giới tính:</label>
                            <div class="col-lg-9">
                                <select name="data[User][gioitinh]"
                                        class="input_dutgd form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày sinh:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaysinh]"
                                       class="form-control rounded hasDatepicker" id="ngaysinh" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Nơi sinh:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][noisinh]" class="form-control rounded" id="noisinh"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Dân tộc:</label>
                            <div class="col-lg-9">
                                <select name="data[User][dantoc_id]"
                                        class="input_tinhthanh custom-select rounded form-control" id="dantoc_id">
                                    <option value="">Chọn</option>
                                    <option value="1">Kinh</option>
                                    <option value="2">Tày</option>
                                    <option value="3">Nùng</option>
                                    <option value="4">Mông</option>
                                    <option value="5">Mường</option>
                                    <option value="6">Dao</option>
                                    <option value="7">Khmer</option>
                                    <option value="8">Êđê</option>
                                    <option value="9">CaoLan</option>
                                    <option value="10">Thái</option>
                                    <option value="11">Gia rai</option>
                                    <option value="12">La chí</option>
                                    <option value="13">Hà nhì</option>
                                    <option value="14">Giáy</option>
                                    <option value="15">M'nông</option>
                                    <option value="16">Cà tu</option>
                                    <option value="17">Xêđăng</option>
                                    <option value="18">Xtiêng</option>
                                    <option value="19">Bana</option>
                                    <option value="20">H'rê</option>
                                    <option value="21">Gié triêng</option>
                                    <option value="22">Chăm</option>
                                    <option value="23">Cơ ho</option>
                                    <option value="24">Mạ</option>
                                    <option value="25">Sán Dìu</option>
                                    <option value="26">Thổ</option>
                                    <option value="27">Khơ mú</option>
                                    <option value="28">Vân kiều</option>
                                    <option value="29">Tà ôi</option>
                                    <option value="30">Co</option>
                                    <option value="31">Chơ ro</option>
                                    <option value="32">Xinh mun</option>
                                    <option value="33">Chu ru</option>
                                    <option value="34">Lào</option>
                                    <option value="35">Phu lá</option>
                                    <option value="36">La hú</option>
                                    <option value="37">Kháng</option>
                                    <option value="38">Lự</option>
                                    <option value="39">Pa (Thèn)</option>
                                    <option value="40">Lô lô</option>
                                    <option value="41">Chút</option>
                                    <option value="42">Mảng</option>
                                    <option value="43">Cơ lao</option>
                                    <option value="44">Bố y</option>
                                    <option value="45">La ha</option>
                                    <option value="46">Côông</option>
                                    <option value="47">Ngái</option>
                                    <option value="48">Si la</option>
                                    <option value="49">Pu péo</option>
                                    <option value="50">Brâu</option>
                                    <option value="51">Rơ măm</option>
                                    <option value="52">Ơ đu</option>
                                    <option value="53">Hoa</option>
                                    <option value="54">Ra glai</option>
                                    <option value="55">Cơ tu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row form-warring">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-9 lb-add-user">
                                <input type="text" name="data[User][email]" class="form-control rounded" id="email"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Số di động:</label>
                            <div class="col-lg-9">
                                <input type="number" name="data[User][sdt]" class="form-control rounded" id="sdt"
                                       value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Quê quán:</label>
                            <div class="col-lg-9">
                                <div class="form-row">
                                    <div class="col">
                                        <select name="data[User][tinh_thanhpho_id]"
                                                class="input_tinhthanh custom-select rounded form-control"
                                                id="UserTinhThanhphoId">
                                            <option value="">Tỉnh/thành</option>
                                            <option value="100">An Giang</option>
                                            <option value="200">Bà Rịa-VT</option>
                                            <option value="300">Bạc Liêu</option>
                                            <option value="400">Bắc Kạn</option>
                                            <option value="500">Bắc Giang</option>
                                            <option value="600">Bắc Ninh</option>
                                            <option value="700">Bến Tre</option>
                                            <option value="800">Bình Dương</option>
                                            <option value="900">Bình Phước</option>
                                            <option value="1000">Bình Thuận</option>
                                            <option value="1100">Bình Định</option>
                                            <option value="1200">Cao Bằng</option>
                                            <option value="1300">Cà Mau</option>
                                            <option value="1400">Cần Thơ</option>
                                            <option value="1500">Gia Lai</option>
                                            <option value="1600">Hoà Bình</option>
                                            <option value="1700">Hưng Yên</option>
                                            <option value="1800">Hà Giang</option>
                                            <option value="1900">Hà Nam</option>
                                            <option value="2000">Hà Nội</option>
                                            <option value="2100">Hà Tây</option>
                                            <option value="2200">Hà Tĩnh</option>
                                            <option value="2300">Hải Dương</option>
                                            <option value="2400">Hải Phòng</option>
                                            <option value="2500">Hồ Chí Minh</option>
                                            <option value="2600">Khánh Hoà</option>
                                            <option value="2700">Kiên Giang</option>
                                            <option value="2800">Kon Tum</option>
                                            <option value="2900">Lai Châu</option>
                                            <option value="3000">Long An</option>
                                            <option value="3100">Lâm Đồng</option>
                                            <option value="3200">Lào Cai</option>
                                            <option value="3300">Lạng Sơn</option>
                                            <option value="3400">Nam Định</option>
                                            <option value="3500">Nghệ An</option>
                                            <option value="3600">Ninh Bình</option>
                                            <option value="3700">Ninh Thuận</option>
                                            <option value="3800">Phú Thọ</option>
                                            <option value="3900">Phú Yên</option>
                                            <option value="4000">Quảng Bình</option>
                                            <option value="4100">Quảng Nam</option>
                                            <option value="4200">Quảng Ngãi</option>
                                            <option value="4300">Quảng Ninh</option>
                                            <option value="4400">Quảng trị</option>
                                            <option value="4500">Sơn La</option>
                                            <option value="4600">Sóc Trăng</option>
                                            <option value="4700">Thanh hoá</option>
                                            <option value="4800">Thái Bình</option>
                                            <option value="4900">Thái Nguyên</option>
                                            <option value="5000">Thừa Thiên - Huế</option>
                                            <option value="5100">Tiền Giang</option>
                                            <option value="5200">Trà Vinh</option>
                                            <option value="5300">Tuyên Quang</option>
                                            <option value="5400">Tây Ninh</option>
                                            <option value="5500">Vĩnh Long</option>
                                            <option value="5600">Vĩnh Phúc</option>
                                            <option value="5700">Yên Bái</option>
                                            <option value="5800">Đắk Lắk</option>
                                            <option value="5900">Đà Nẵng</option>
                                            <option value="6000">Đồng Nai</option>
                                            <option value="6100">Đồng Tháp</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select name="data[User][huyen_quan_id]"
                                                class="input_huyenquan custom-select rounded form-control"
                                                id="UserHuyenQuanId">
                                            <option value="">Huyện/quận</option>
                                            <option value="553">A Lưới</option>
                                            <option value="280">An Biên</option>
                                            <option value="235">An Hải</option>
                                            <option value="129">An Khê</option>
                                            <option value="86">An Lão</option>
                                            <option value="232">An Lão</option>
                                            <option value="281">An Minh</option>
                                            <option value="94">An Nhơn</option>
                                            <option value="6">An Phú</option>
                                            <option value="155">Ân Thi</option>
                                            <option value="378">Anh Sơn</option>
                                            <option value="134">Ayun Pa</option>
                                            <option value="31">Ba Bể</option>
                                            <option value="462">Ba Chẽ</option>
                                            <option value="503">Bá Thước</option>
                                            <option value="453">Ba Tơ</option>
                                            <option value="60">Ba Tri</option>
                                            <option value="189">Ba Vì</option>
                                            <option value="175">Ba Đình</option>
                                            <option value="77">Bắc Bình</option>
                                            <option value="341">Bắc Hà</option>
                                            <option value="163">Bắc Mê</option>
                                            <option value="166">Bắc Quang</option>
                                            <option value="347">Bắc Sơn</option>
                                            <option value="482">Bắc Yên</option>
                                            <option value="239">Bạch Long Vĩ</option>
                                            <option value="33">Bạch Thông</option>
                                            <option value="98">Bảo Lạc</option>
                                            <option value="325">Bảo Lâm</option>
                                            <option value="335">Bảo Thắng</option>
                                            <option value="338">Bảo Yên</option>
                                            <option value="334">Bát Xát</option>
                                            <option value="64">Bến Cát</option>
                                            <option value="587">Bến Cầu</option>
                                            <option value="312">Bến Lức</option>
                                            <option value="260">Bình Chánh</option>
                                            <option value="345">Bình Gia</option>
                                            <option value="222">Bình Giang</option>
                                            <option value="458">Bình Liêu</option>
                                            <option value="72">Bình Long</option>
                                            <option value="172">Bình Lục</option>
                                            <option value="591">Bình Minh</option>
                                            <option value="596">Bình Minh</option>
                                            <option value="443">Bình Sơn</option>
                                            <option value="255">Bình Thạnh</option>
                                            <option value="59">Bình Đại</option>
                                            <option value="421">Bố Trạch</option>
                                            <option value="71">Bù Đăng</option>
                                            <option value="635">Buôn Đôn</option>
                                            <option value="558">Cái Bè</option>
                                            <option value="559">Cai Lậy</option>
                                            <option value="113">Cái Nước</option>
                                            <option value="225">Cẩm Bình</option>
                                            <option value="221">Cẩm Giàng</option>
                                            <option value="473">Cam Lộ</option>
                                            <option value="269">Cam Ranh</option>
                                            <option value="508">Cẩm thuỷ</option>
                                            <option value="210">Cẩm Xuyên</option>
                                            <option value="262">Cần Giờ</option>
                                            <option value="317">Cần Giuộc</option>
                                            <option value="207">Can Lộc</option>
                                            <option value="316">Cần Đước</option>
                                            <option value="566">Càng Long</option>
                                            <option value="662">Cao Lãnh</option>
                                            <option value="349">Cao Lộc</option>
                                            <option value="238">Cát Hải</option>
                                            <option value="329">Cát Tiên</option>
                                            <option value="571">Cầu Ngang</option>
                                            <option value="174">Cầu Giấy</option>
                                            <option value="567">Cầu Kè</option>
                                            <option value="151">Châu Giang</option>
                                            <option value="11">Châu Phú</option>
                                            <option value="13">Châu Thành</option>
                                            <option value="277">Châu Thành</option>
                                            <option value="560">Châu Thành</option>
                                            <option value="55">Châu Thành</option>
                                            <option value="569">Châu Thành</option>
                                            <option value="314">Châu Thành</option>
                                            <option value="585">Châu Thành</option>
                                            <option value="120">Châu Thành</option>
                                            <option value="667">Châu Thành</option>
                                            <option value="18">Châu Đức</option>
                                            <option value="351">Chi Lăng</option>
                                            <option value="214">Chí Linh</option>
                                            <option value="576">Chiêm Hoá</option>
                                            <option value="561">Chợ Gạo</option>
                                            <option value="56">Chợ Lách</option>
                                            <option value="12">Chợ Mới</option>
                                            <option value="32">Chợ Đồn</option>
                                            <option value="126">Chư Păh</option>
                                            <option value="132">Chư Prông</option>
                                            <option value="133">Chư Sê</option>
                                            <option value="193">Chương Mỹ</option>
                                            <option value="467">Cô Tô</option>
                                            <option value="374">Con Cuông</option>
                                            <option value="22">Côn Đảo</option>
                                            <option value="257">Củ Chi</option>
                                            <option value="624">Cư Jút</option>
                                            <option value="623">Cư M'gar</option>
                                            <option value="324">Di Linh</option>
                                            <option value="377">Diễn Châu</option>
                                            <option value="267">Diên Khánh</option>
                                            <option value="584">Dương Minh Châu</option>
                                            <option value="169">Duy Tiên</option>
                                            <option value="431">Duy Xuyên</option>
                                            <option value="572">Duyên Hải</option>
                                            <option value="619">Ea H'leo</option>
                                            <option value="626">Ea Kar</option>
                                            <option value="622">Ea Súp</option>
                                            <option value="27">Giá Lai</option>
                                            <option value="180">Gia Lâm</option>
                                            <option value="219">Gia Lộc</option>
                                            <option value="52">Gia Lương</option>
                                            <option value="388">Gia Viễn</option>
                                            <option value="432">Giằng</option>
                                            <option value="362">Giao thủy</option>
                                            <option value="472">Gio Linh</option>
                                            <option value="278">Giồng Giềng</option>
                                            <option value="58">Giồng Trôm</option>
                                            <option value="562">Gò Công Tây</option>
                                            <option value="563">Gò Công Đông</option>
                                            <option value="588">Gò Dầu</option>
                                            <option value="279">Gò Quao</option>
                                            <option value="253">Gò Vấp</option>
                                            <option value="401">Hạ Hoà</option>
                                            <option value="107">Hạ Lang</option>
                                            <option value="100">Hà Quảng</option>
                                            <option value="274">Hà Tiên</option>
                                            <option value="519">Hà Trung</option>
                                            <option value="177">Hai Bà Trưng</option>
                                            <option value="638">Hải Châu</option>
                                            <option value="364">Hải Hậu</option>
                                            <option value="475">Hải Lăng</option>
                                            <option value="460">Hải Ninh</option>
                                            <option value="80">Hàm Tân</option>
                                            <option value="78">Hàm Thuận Bắc</option>
                                            <option value="79">Hàm Thuận Nam</option>
                                            <option value="577">Hàm Yên</option>
                                            <option value="522">Hậu Lộc</option>
                                            <option value="428">Hiên</option>
                                            <option value="42">Hiệp Hoà</option>
                                            <option value="436">Hiệp Đức</option>
                                            <option value="104">Hoà An</option>
                                            <option value="389">Hoa Lư</option>
                                            <option value="586">Hoà Thành</option>
                                            <option value="643">Hoà Vang</option>
                                            <option value="87">Hoài Ân</option>
                                            <option value="88">Hoài Nhơn</option>
                                            <option value="195">Hoài Đức</option>
                                            <option value="176">Hoàn Kiếm</option>
                                            <option value="520">Hoằng Hoá</option>
                                            <option value="164">Hoàng Su Phì</option>
                                            <option value="466">Hoành Bồ</option>
                                            <option value="258">Hóc Môn</option>
                                            <option value="275">Hòn Đất</option>
                                            <option value="227">Hồng Bàng</option>
                                            <option value="25">Hồng Dân</option>
                                            <option value="659">Hồng Ngự</option>
                                            <option value="527">Hưng Hà</option>
                                            <option value="383">Hưng Nguyên</option>
                                            <option value="476">Hướng Hoá</option>
                                            <option value="208">Hương Khê</option>
                                            <option value="204">Hương Sơn</option>
                                            <option value="550">Hương Thủy</option>
                                            <option value="548">Hương Trà</option>
                                            <option value="353">Hữu Lũng</option>
                                            <option value="416">Huyện Tuy Hoà</option>
                                            <option value="128">KBang</option>
                                            <option value="490">Kế Sách</option>
                                            <option value="270">Khánh Sơn</option>
                                            <option value="268">Khánh Vĩnh</option>
                                            <option value="230">Kiến An</option>
                                            <option value="284">Kiên Hải</option>
                                            <option value="233">Kiến Thụy</option>
                                            <option value="533">Kiến Xương</option>
                                            <option value="170">Kim Bảng</option>
                                            <option value="145">Kim Bôi</option>
                                            <option value="392">Kim Sơn</option>
                                            <option value="218">Kim Thành</option>
                                            <option value="154">Kim Động</option>
                                            <option value="217">Kinh Môn</option>
                                            <option value="130">Kông Chro</option>
                                            <option value="291">KonPlông</option>
                                            <option value="630">Krông A Na</option>
                                            <option value="631">Krông Bông</option>
                                            <option value="620">Krông Búk</option>
                                            <option value="621">Krông Năng</option>
                                            <option value="625">Krông Pắc</option>
                                            <option value="629">KrôngNô</option>
                                            <option value="135">KrôngPa</option>
                                            <option value="211">Kỳ Anh</option>
                                            <option value="372">Kỳ Sơn</option>
                                            <option value="143">Kỳ Sơn</option>
                                            <option value="136">La Grai</option>
                                            <option value="326">Lạc Dương</option>
                                            <option value="142">Lạc Sơn</option>
                                            <option value="146">Lạc Thuỷ</option>
                                            <option value="665">Lai Vung</option>
                                            <option value="632">Lắk</option>
                                            <option value="330">Lâm Hà</option>
                                            <option value="506">Lang Chánh</option>
                                            <option value="43">Lạng Giang</option>
                                            <option value="603">Lập Thạch</option>
                                            <option value="666">Lấp Vò</option>
                                            <option value="228">Lê Chân</option>
                                            <option value="424">Lệ Thuỷ</option>
                                            <option value="642">Liên Chiểu</option>
                                            <option value="350">Lộc Bình</option>
                                            <option value="70">Lộc Ninh</option>
                                            <option value="594">Long Hồ</option>
                                            <option value="651">Long Khánh</option>
                                            <option value="122">Long Mỹ</option>
                                            <option value="494">Long Phú</option>
                                            <option value="653">Long Thành</option>
                                            <option value="21">Long Đất</option>
                                            <option value="40">Lục Nam</option>
                                            <option value="38">Lục Ngạn</option>
                                            <option value="610">Lục Yên</option>
                                            <option value="144">Lương Sơn</option>
                                            <option value="171">Lý Nhân</option>
                                            <option value="442">Lý Sơn</option>
                                            <option value="627">M'Đrắk</option>
                                            <option value="140">Mai Châu</option>
                                            <option value="484">Mai Sơn</option>
                                            <option value="595">Mang Thít</option>
                                            <option value="127">Mang Yang</option>
                                            <option value="606">Mê Linh</option>
                                            <option value="159">Mèo Vạc</option>
                                            <option value="420">Minh Hoá</option>
                                            <option value="450">Minh Long</option>
                                            <option value="57">Mỏ Cày</option>
                                            <option value="451">Mộ Đức</option>
                                            <option value="487">Mộc Châu</option>
                                            <option value="307">Mộc Hoá</option>
                                            <option value="613">Mù Căng Chải</option>
                                            <option value="340">Mường Khương</option>
                                            <option value="480">Mường La</option>
                                            <option value="500">Mường Lát</option>
                                            <option value="299">Mường Lay</option>
                                            <option value="296">Mường Tè</option>
                                            <option value="357">Mỹ Lộc</option>
                                            <option value="491">Mỹ Tú</option>
                                            <option value="150">Mỹ Văn</option>
                                            <option value="492">Mỹ Xuyên</option>
                                            <option value="197">Mỹ Đức</option>
                                            <option value="575">Nà Hang</option>
                                            <option value="34">Na Rì</option>
                                            <option value="215">Nam Sách</option>
                                            <option value="359">Nam Trực</option>
                                            <option value="382">Nam Đàn</option>
                                            <option value="552">Nam Đông</option>
                                            <option value="521">Nga Sơn</option>
                                            <option value="30">Ngân Sơn</option>
                                            <option value="381">Nghi Lộc</option>
                                            <option value="206">Nghi Xuân</option>
                                            <option value="449">Nghĩa Hành</option>
                                            <option value="363">Nghĩa Hưng</option>
                                            <option value="370">Nghĩa Đàn</option>
                                            <option value="229">Ngô Quyền</option>
                                            <option value="115">Ngọc Hiển</option>
                                            <option value="288">Ngọc Hồi</option>
                                            <option value="507">Ngọc Lạc</option>
                                            <option value="641">Ngũ Hành Sơn</option>
                                            <option value="103">Nguyên Bình</option>
                                            <option value="261">Nhà Bè</option>
                                            <option value="387">Nho Quan</option>
                                            <option value="654">Nhơn Trạch</option>
                                            <option value="511">Như Thanh</option>
                                            <option value="505">Như Xuân</option>
                                            <option value="223">Ninh Giang</option>
                                            <option value="396">Ninh Hải</option>
                                            <option value="266">Ninh Hoà</option>
                                            <option value="397">Ninh Phước</option>
                                            <option value="395">Ninh Sơn</option>
                                            <option value="515">Nông Cống</option>
                                            <option value="438">Núi Thành</option>
                                            <option value="119">Ô Môn</option>
                                            <option value="543">Phổ Yên</option>
                                            <option value="408">Phong Châu</option>
                                            <option value="297">Phong Thổ</option>
                                            <option value="546">Phong Điền</option>
                                            <option value="542">Phú Bình</option>
                                            <option value="90">Phù Cát</option>
                                            <option value="152">Phù Cừ</option>
                                            <option value="551">Phú Lộc</option>
                                            <option value="538">Phú Lương</option>
                                            <option value="89">Phù Mỹ</option>
                                            <option value="256">Phú Nhuận</option>
                                            <option value="283">Phú Quốc</option>
                                            <option value="83">Phú Quý</option>
                                            <option value="8">Phú Tân</option>
                                            <option value="549">Phú Vang</option>
                                            <option value="200">Phú Xuyên</option>
                                            <option value="483">Phù Yên</option>
                                            <option value="190">Phúc Thọ</option>
                                            <option value="121">Phụng Hiệp</option>
                                            <option value="69">Phước Long</option>
                                            <option value="435">Phước Sơn</option>
                                            <option value="241">Quận 1</option>
                                            <option value="250">Quận 10</option>
                                            <option value="251">Quận 11</option>
                                            <option value="252">Quận 12</option>
                                            <option value="242">Quận 2</option>
                                            <option value="243">Quận 3</option>
                                            <option value="244">Quận 4</option>
                                            <option value="245">Quận 5</option>
                                            <option value="246">Quận 6</option>
                                            <option value="247">Quận 7</option>
                                            <option value="248">Quận 8</option>
                                            <option value="249">Quận 9</option>
                                            <option value="161">Quản Bạ</option>
                                            <option value="501">Quan Hoá</option>
                                            <option value="502">Quan Sơn</option>
                                            <option value="459">Quảng Hà</option>
                                            <option value="105">Quảng Hoà</option>
                                            <option value="423">Quảng Ninh</option>
                                            <option value="422">Quảng Trạch</option>
                                            <option value="523">Quảng Xương</option>
                                            <option value="547">Quảng Điền</option>
                                            <option value="367">Quế Phong</option>
                                            <option value="433">Quế Sơn</option>
                                            <option value="49">Quế Võ</option>
                                            <option value="192">Quốc Oai</option>
                                            <option value="368">Quỳ Châu</option>
                                            <option value="369">Quỳ Hợp</option>
                                            <option value="371">Quỳnh Lưu</option>
                                            <option value="479">Quỳnh nhai</option>
                                            <option value="526">Quỳnh Phụ</option>
                                            <option value="336">Sa Pa</option>
                                            <option value="290">Sa Thầy</option>
                                            <option value="298">Sìn Hồ</option>
                                            <option value="178">Sóc Sơn</option>
                                            <option value="579">Sơn Dương</option>
                                            <option value="447">Sơn Hà</option>
                                            <option value="414">Sơn Hoà</option>
                                            <option value="446">Son Tây</option>
                                            <option value="445">Sơn Tịnh</option>
                                            <option value="640">Sơn Trà</option>
                                            <option value="39">Sơn Động</option>
                                            <option value="412">Sông Cầu</option>
                                            <option value="415">Sông Hinh</option>
                                            <option value="486">Sông Mã</option>
                                            <option value="404">Sông Thao</option>
                                            <option value="597">Tam Bình</option>
                                            <option value="660">Tam Nông</option>
                                            <option value="407">Tam Thanh</option>
                                            <option value="602">Tam Đảo</option>
                                            <option value="582">Tân Biên</option>
                                            <option value="254">Tân Bình</option>
                                            <option value="7">Tân Châu</option>
                                            <option value="583">Tân Châu</option>
                                            <option value="276">Tân Hiệp</option>
                                            <option value="590">Tân Hiệp</option>
                                            <option value="658">Tân hồng</option>
                                            <option value="318">Tân Hưng</option>
                                            <option value="375">Tân Kỳ</option>
                                            <option value="141">Tân Lạc</option>
                                            <option value="648">Tân Phú</option>
                                            <option value="557">Tân Phước</option>
                                            <option value="19">Tân Thành</option>
                                            <option value="308">Tân Thạnh</option>
                                            <option value="315">Tân Trụ</option>
                                            <option value="65">Tân Uyên</option>
                                            <option value="41">Tân Yên</option>
                                            <option value="82">Tánh Linh</option>
                                            <option value="183">Tây Hồ</option>
                                            <option value="92">Tây Sơn</option>
                                            <option value="106">Thạch An</option>
                                            <option value="209">Thạch Hà</option>
                                            <option value="509">Thạch Thành</option>
                                            <option value="191">Thạch Thất</option>
                                            <option value="531">Thái Thụy</option>
                                            <option value="339">Than Uyên</option>
                                            <option value="434">Thăng Bình</option>
                                            <option value="402">Thanh Ba</option>
                                            <option value="661">Thanh Bình</option>
                                            <option value="380">Thanh Chương</option>
                                            <option value="216">Thanh Hà</option>
                                            <option value="309">Thạnh Hoá</option>
                                            <option value="663">Thạnh Hưng</option>
                                            <option value="639">Thanh Khê</option>
                                            <option value="173">Thanh Liêm</option>
                                            <option value="224">Thanh Miện</option>
                                            <option value="196">Thanh Oai</option>
                                            <option value="61">Thạnh Phú</option>
                                            <option value="406">Thanh Sơn</option>
                                            <option value="182">Thanh Trì</option>
                                            <option value="493">Thạnh Trị</option>
                                            <option value="184">Thanh Xuân</option>
                                            <option value="664">Tháp Mười</option>
                                            <option value="528">Thị Xã Thái Bình</option>
                                            <option value="518">Thiệu Hóa</option>
                                            <option value="513">Thiệu Yên</option>
                                            <option value="510">Thọ Xuân</option>
                                            <option value="14">Thoại Sơn</option>
                                            <option value="110">Thới Bình</option>
                                            <option value="650">Thống Nhất</option>
                                            <option value="99">Thông Nông</option>
                                            <option value="118">Thốt Nốt</option>
                                            <option value="313">Thủ Thừa</option>
                                            <option value="259">Thủ Đức</option>
                                            <option value="66">Thuận An</option>
                                            <option value="481">Thuận Châu</option>
                                            <option value="51">Thuận Thành</option>
                                            <option value="199">Thường Tín</option>
                                            <option value="504">Thường Xuân</option>
                                            <option value="234">Thuỷ Nguyên</option>
                                            <option value="532">Tiền Hải</option>
                                            <option value="236">Tiên Lãng</option>
                                            <option value="153">Tiên Lữ</option>
                                            <option value="437">Tiên Phước</option>
                                            <option value="50">Tiên Sơn</option>
                                            <option value="461">Tiên Yên</option>
                                            <option value="568">Tiểu Cần</option>
                                            <option value="9">Tịnh Biên</option>
                                            <option value="524">Tĩnh Gia</option>
                                            <option value="646">Tp Biên Hoà</option>
                                            <option value="618">Tp Buôn Ma Thuột</option>
                                            <option value="117">Tp Cần Thơ</option>
                                            <option value="455">Tp Hạ Long</option>
                                            <option value="213">Tp Hải Dương</option>
                                            <option value="545">Tp Huế</option>
                                            <option value="555">Tp Mỹ Tho</option>
                                            <option value="355">Tp Nam Định</option>
                                            <option value="264">Tp Nha Trang</option>
                                            <option value="85">Tp Quy Nhơn</option>
                                            <option value="535">Tp Thái Nguyên</option>
                                            <option value="497">Tp Thanh Hoá</option>
                                            <option value="399">Tp Việt Trì</option>
                                            <option value="366">Tp Vinh</option>
                                            <option value="16">Tp Vũng Tàu</option>
                                            <option value="320">Tp Đà Lạt</option>
                                            <option value="444">Trà Bồng</option>
                                            <option value="570">Trà Cú</option>
                                            <option value="101">Trà Lĩnh</option>
                                            <option value="439">Trà My</option>
                                            <option value="598">Trà Ôn</option>
                                            <option value="616">Trạm Tấu</option>
                                            <option value="112">Trần Văn Thời</option>
                                            <option value="615">Trấn Yên</option>
                                            <option value="589">Trảng Bàng</option>
                                            <option value="344">Tràng Định</option>
                                            <option value="10">Tri Tôn</option>
                                            <option value="474">Triệu Phong</option>
                                            <option value="514">Triệu Sơn</option>
                                            <option value="360">Trực Ninh</option>
                                            <option value="102">Trùng Khánh</option>
                                            <option value="271">Trường Sa</option>
                                            <option value="220">Tứ Kỳ</option>
                                            <option value="185">Từ Liêm</option>
                                            <option value="448">Tư Nghĩa</option>
                                            <option value="300">Tủa Chùa</option>
                                            <option value="301">Tuần Giáo</option>
                                            <option value="373">Tương Dương</option>
                                            <option value="413">Tuy An</option>
                                            <option value="76">Tuy Phong</option>
                                            <option value="95">Tuy Phước</option>
                                            <option value="419">Tuyên Hoá</option>
                                            <option value="17">Tx Bà Rịa</option>
                                            <option value="36">Tx Bắc Giang</option>
                                            <option value="29">Tx Bắc Kạn</option>
                                            <option value="24">Tx Bạc Liêu</option>
                                            <option value="47">Tx Bắc Ninh</option>
                                            <option value="321">Tx Bảo Lộc</option>
                                            <option value="54">Tx Bến tre</option>
                                            <option value="498">Tx Bỉm Sơn</option>
                                            <option value="109">Tx Cà Mau</option>
                                            <option value="456">Tx Cẩm Phả</option>
                                            <option value="333">Tx Cam Đường</option>
                                            <option value="97">Tx Cao Bằng</option>
                                            <option value="656">Tx Cao Lãnh</option>
                                            <option value="5">Tx Châu Đốc</option>
                                            <option value="556">Tx Gò Công</option>
                                            <option value="157">Tx Hà Giang</option>
                                            <option value="202">Tx Hà Tĩnh</option>
                                            <option value="187">Tx Hà Đông</option>
                                            <option value="138">Tx Hoà bình</option>
                                            <option value="426">Tx Hội An</option>
                                            <option value="203">Tx Hồng Lĩnh</option>
                                            <option value="149">Tx Hưng Yên</option>
                                            <option value="286">Tx Kon Tum</option>
                                            <option value="295">Tx Lai Châu</option>
                                            <option value="343">Tx Lạng Sơn</option>
                                            <option value="332">Tx Lào Cai</option>
                                            <option value="4">Tx Long Xuyên</option>
                                            <option value="609">Tx Nghĩa Lộ</option>
                                            <option value="385">Tx Ninh Bình</option>
                                            <option value="394">Tx Phan Rang-TC</option>
                                            <option value="75">Tx Phan Thiết</option>
                                            <option value="168">Tx Phủ Lý</option>
                                            <option value="400">Tx Phú Thọ</option>
                                            <option value="125">Tx PleiKu</option>
                                            <option value="441">Tx Quảng Ngãi</option>
                                            <option value="470">Tx Quảng Trị</option>
                                            <option value="273">Tx Rạch Giá</option>
                                            <option value="657">Tx Sa Đéc</option>
                                            <option value="499">Tx Sầm Sơn</option>
                                            <option value="489">Tx Sóc Trăng</option>
                                            <option value="478">Tx Sơn La</option>
                                            <option value="188">Tx Sơn Tây</option>
                                            <option value="536">Tx Sông Công</option>
                                            <option value="427">Tx Tam Kỳ</option>
                                            <option value="386">Tx Tam Điệp</option>
                                            <option value="305">Tx Tân An</option>
                                            <option value="581">Tx Tây Ninh</option>
                                            <option value="63">Tx Thủ Dầu Một</option>
                                            <option value="565">Tx Trà Vinh</option>
                                            <option value="410">Tx Tuy Hoà</option>
                                            <option value="574">Tx Tuyên Quang</option>
                                            <option value="457">Tx Uông Bí</option>
                                            <option value="593">Tx Vĩnh Long</option>
                                            <option value="601">Tx Vĩnh Yên</option>
                                            <option value="608">Tx Yên Bái</option>
                                            <option value="294">Tx Điện Biên Phủ</option>
                                            <option value="231">Tx Đồ Sơn</option>
                                            <option value="469">Tx Đông Hà</option>
                                            <option value="418">Tx Đồng Hới</option>
                                            <option value="68">Tx Đồng Xoài</option>
                                            <option value="111">U Minh</option>
                                            <option value="198">ứng Hoà</option>
                                            <option value="337">Văn Bàn</option>
                                            <option value="93">Vân Canh</option>
                                            <option value="614">Văn Chấn</option>
                                            <option value="346">Văn Lãng</option>
                                            <option value="265">Vạn Ninh</option>
                                            <option value="348">Văn Quan</option>
                                            <option value="611">Văn Yên</option>
                                            <option value="465">Vân Đồn</option>
                                            <option value="123">Vị Thanh</option>
                                            <option value="162">Vị Xuyên</option>
                                            <option value="44">Việt Yên</option>
                                            <option value="237">Vĩnh Bảo</option>
                                            <option value="495">Vĩnh Châu</option>
                                            <option value="647">Vĩnh Cừu</option>
                                            <option value="306">Vĩnh Hưng</option>
                                            <option value="471">Vĩnh Linh</option>
                                            <option value="512">Vĩnh Lộc</option>
                                            <option value="26">Vĩnh Lợi</option>
                                            <option value="91">Vĩnh Thạnh</option>
                                            <option value="282">Vĩnh Thuận</option>
                                            <option value="604">Vĩnh Tường</option>
                                            <option value="539">Võ Nhai</option>
                                            <option value="356">Vụ Bản</option>
                                            <option value="530">Vũ Thư</option>
                                            <option value="599">Vũng Liêm</option>
                                            <option value="165">Xín Mần</option>
                                            <option value="652">Xuân Lộc</option>
                                            <option value="361">Xuân Trường</option>
                                            <option value="20">Xuyên Mộc</option>
                                            <option value="358">ý Yên</option>
                                            <option value="612">Yên Bình</option>
                                            <option value="485">Yên Châu</option>
                                            <option value="45">Yên Dũng</option>
                                            <option value="464">Yên Hưng</option>
                                            <option value="391">Yên Khánh</option>
                                            <option value="605">Yên Lạc</option>
                                            <option value="405">Yên Lập</option>
                                            <option value="160">Yên Minh</option>
                                            <option value="390">Yên Mô</option>
                                            <option value="48">Yên Phong</option>
                                            <option value="578">Yên Sơn</option>
                                            <option value="376">Yên Thành</option>
                                            <option value="37">Yên Thế</option>
                                            <option value="147">Yên Thuỷ</option>
                                            <option value="516">Yên Định</option>
                                            <option value="139">Đà Bắc</option>
                                            <option value="327">Đạ Huoai</option>
                                            <option value="328">Đạ Tẻh</option>
                                            <option value="429">Đại Lộc</option>
                                            <option value="540">Đại Từ</option>
                                            <option value="287">Đắk Glei</option>
                                            <option value="292">Đak Hà</option>
                                            <option value="628">Đắk Mil</option>
                                            <option value="634">Đắk Nông</option>
                                            <option value="633">Đắk R'Lấp</option>
                                            <option value="289">Đắk Tô</option>
                                            <option value="114">Đầm Rơi</option>
                                            <option value="194">Đan Phượng</option>
                                            <option value="644">Đảo Hoàng Sa</option>
                                            <option value="430">Điện Bàn</option>
                                            <option value="302">Điện Biên</option>
                                            <option value="303">Điện Biên Đông</option>
                                            <option value="537">Định Hoá</option>
                                            <option value="352">Đình Lập</option>
                                            <option value="649">Định Quán</option>
                                            <option value="379">Đô Lương</option>
                                            <option value="403">Đoan Hùng</option>
                                            <option value="322">Đơn Dương</option>
                                            <option value="179">Đông Anh</option>
                                            <option value="529">Đông Hưng</option>
                                            <option value="541">Đồng Hỷ</option>
                                            <option value="73">Đồng Phú</option>
                                            <option value="517">Đông Sơn</option>
                                            <option value="463">Đông Triều</option>
                                            <option value="158">Đồng Văn</option>
                                            <option value="411">Đồng Xuân</option>
                                            <option value="181">Đống Đa</option>
                                            <option value="131">Đức Cơ</option>
                                            <option value="311">Đức Hoà</option>
                                            <option value="310">Đức Huệ</option>
                                            <option value="81">Đức Linh</option>
                                            <option value="452">Đức Phổ</option>
                                            <option value="205">Đức Thọ</option>
                                            <option value="323">Đức Trọng</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-9">
                                <div class="form-row">
                                    <input type="text" name="data[User][xa_phuong]" class="form-control rounded"
                                           placeholder="Xã/phường..." id="xa_phuong">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Thường trú:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][thuongtru]" class="form-control rounded"
                                       id="thuongtru" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Nơi ở hiện nay:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][noiohiennay]" class="form-control rounded"
                                       id="noiohiennay" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thông tin tuyển dụng và HĐLĐ -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Thông tin tuyển dụng và HĐLĐ</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group1 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày tuyển dụng:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaytuyendung]"
                                       class="form-control rounded hasDatepicker" id="ngaytuyendung" value="">
                            </div>
                        </div>
                        <!--                  <div class="form-group row">-->
                        <!--                     <label for="staticEmail" class="col-lg-3 col-form-label">Cơ quan tiếp nhận:</label>-->
                        <!--                     <div class="col-lg-9">-->
                        <!--                        <input type="text" name="data[User][coquan_tiepnhan]" class="form-control rounded" id="coquantiepnhan" value="">-->
                        <!---->
                        <!--                     </div>-->
                        <!--                  </div>-->
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày BN chức danh nghề
                                nghiệp:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaybnngach]"
                                       class="form-control rounded hasDatepicker" id="ngaybnngach" value="">
                            </div>
                        </div>
                        <!--                  <div class="form-group row">-->
                        <!--                     <label for="staticEmail" class="col-lg-3 col-form-label">Ngày về CQ hiện nay:</label>-->
                        <!--                     <div class="col-lg-9">-->
                        <!--                        <input type="text" name="data[User][ngayve_cqhiennay]" class="form-control rounded" id="ngayve_cqhiennay" value="">-->
                        <!--                     </div>-->
                        <!--                  </div>-->
                        <!--                  <div class="form-group row">-->
                        <!--                     <label for="staticEmail" class="col-lg-3 col-form-label">Ngày vào ngành GD:</label>-->
                        <!--                     <div class="col-lg-9">-->
                        <!--                        <input type="text" name="data[User][ngayvao_nganhgiaoduc]" class="form-control rounded" id="ngayvaonganhgd" value="">-->
                        <!--                     </div>-->
                        <!--                  </div>-->
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Loại HĐ <span
                                        style="color:red">(*)</span>:</label>
                            <div class="col-lg-9">
                                <select name="data[User][loaicanbo_id]"
                                        class="UserLoaicanboId form-control custom-select rounded" id="loaihopdong">
                                    <option value="">Chọn</option>
                                    <option value="1">Biên chế CC,VC</option>
                                    <option value="7">HĐ dưới 1 năm (Tập sự)</option>
                                    <option value="11">HĐ không xác định thời hạn</option>
                                    <option value="5">HĐ xác định thời hạn (1-3 năm)</option>
                                    <option value="8">Theo NĐ 68/2000/NĐ-CP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày ký:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[Hopdong][ngayky]"
                                       class="form-control rounded hasDatepicker" id="ngayky" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày bắt đầu HĐ:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[Hopdong][tungay]"
                                       class="form-control rounded hasDatepicker" id="ngayhopdong" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày hết hạn:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[Hopdong][denngay]"
                                       class="form-control rounded hasDatepicker" id="ngayhethan" value="">
                            </div>
                        </div>
                    </div>
                    <div class="group2 col-md-6">

                        <!--                  <div class="form-group row">-->
                        <!--                     <label for="staticEmail" class="col-lg-3 col-form-label">Công việc hiện nay:</label>-->
                        <!--                     <div class="col-lg-9">-->
                        <!--                        <select name="data[User][congviec_hiennay_id]" class="input_cvhn form-control custom-select rounded" id="UserCongviecHiennayId">-->
                        <!--                           <option value="">Chọn</option>-->
                        <!--                           --><!--                           <option value="--><!--">-->
                        <!--</option>-->
                        <!--                           --><!--                        </select>-->
                        <!--                     </div>-->
                        <!--                  </div>-->
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">C.việc theo HĐ:</label>
                            <div class="col-lg-9">
                                <select name="data[User][vieckhituyendung_id]" id="cvtheohd"
                                        class="input_dantoc form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="3901">Bảo vệ</option>
                                    <option value="2101">Cán bộ giảng dạy</option>
                                    <option value="2401">Cán bộ giảng dạy chuyên ngành CNTT</option>
                                    <option value="2103">Cán bộ giảng dạy kiêm quản lý</option>
                                    <option value="2301">Cán bộ giảng dạy môn Mác Lê nin</option>
                                    <option value="2501">Cán bộ giảng dạy ngoại ngữ</option>
                                    <option value="3905">Cán bộ kỹ thuật</option>
                                    <option value="2201">Cán bộ nghiên cứu</option>
                                    <option value="3903">Cấp dưỡng</option>
                                    <option value="3101">Chỉ đạo công tác chuyên môn</option>
                                    <option value="1102">Chuyên viên</option>
                                    <option value="5203">Công nhân sản xuất</option>
                                    <option value="3103">Công tác Đảng/Đoàn/CĐ</option>
                                    <option value="3211">Công tác Kế hoạch</option>
                                    <option value="3119">Công tác Quan hệ quốc tế</option>
                                    <option value="3121">Công tác TDTT</option>
                                    <option value="3305">Công tác Thanh tra</option>
                                    <option value="3115">Công tác tổ chức nhân sự</option>
                                    <option value="3113">Công tác tổng hợp/TĐKT</option>
                                    <option value="3105">Công tác tuyên huấn</option>
                                    <option value="3301">Công tác tuyển sinh đào tạo</option>
                                    <option value="4105">Diễn viên</option>
                                    <option value="">Dược sỹ</option>
                                    <option value="4107">Đạo diễn</option>
                                    <option value="3315">Giám thị</option>
                                    <option value="1105">Giảng viên</option>
                                    <option value="2601">Giảng viên cơ hữu</option>
                                    <option value="2701">Giảng viên thỉnh giảng</option>
                                    <option value="1305">Giáo viên dạy bổ túc THCS</option>
                                    <option value="1403">Giáo viên dạy bổ túc THPT</option>
                                    <option value="1203">Giáo viên dạy bổ túc Tiểu học</option>
                                    <option value="1900">Giáo viên dạy các trường ngoài công lập</option>
                                    <option value="1501">Giáo viên dạy chuyên ngữ văn Khmer</option>
                                    <option value="1700">Giáo viên dạy Nghề</option>
                                    <option value="1307">Giáo viên dạy phổ cập THCS</option>
                                    <option value="1205">Giáo viên dạy phổ cập Tiểu học</option>
                                    <option value="1301">Giáo viên dạy THCS</option>
                                    <option value="1401">Giáo viên dạy THPT</option>
                                    <option value="1600">Giáo viên Tổng phụ trách</option>
                                    <option value="1103">Giáo viên trung học</option>
                                    <option value="2801">Giáo viên Trường thực hành</option>
                                    <option value="3313">Giáo vụ</option>
                                    <option value="3317">HD thí nghiệm/thực hành</option>
                                    <option value="4101">Hoạ sỹ</option>
                                    <option value="4301">Huấn luyện viên</option>
                                    <option value="4103">Hướng dẫn viên du lịch</option>
                                    <option value="1201">Kế toán viên</option>
                                    <option value="1104">Kỹ sư</option>
                                    <option value="3907">Lái xe cơ giới</option>
                                    <option value="3909">Lái xe ô tô cơ quan</option>
                                    <option value="3921">Lễ tân</option>
                                    <option value="4501">Lực lượng vũ trang</option>
                                    <option value="5305">Nhân viên</option>
                                    <option value="3915">Nhân viên đánh máy</option>
                                    <option value="3911">Nhân viên hành chính/văn thư</option>
                                    <option value="5307">Nhân viên phục vụ</option>
                                    <option value="3913">Nhân viên quản trị</option>
                                    <option value="3303">Quản lý HSSV</option>
                                    <option value="3215">Quản lý Ký túc xá</option>
                                    <option value="3307">Quản lý nghiên cứu khoa học</option>
                                    <option value="5207">Quản lý nhân lực</option>
                                    <option value="3205">Quản lý P.Thí nghiệm/Xưởng thực hành</option>
                                    <option value="3207">Quản lý Phòng/Mạng máy tính</option>
                                    <option value="5205">Quản lý sản xuất</option>
                                    <option value="3213">Quản lý tài chính</option>
                                    <option value="3201">Quản lý thiết bị - CSVC</option>
                                    <option value="3311">Quản lý Thư viện</option>
                                    <option value="3209">Quản lý Trạm/Trại/ TT</option>
                                    <option value="3117">Quản lý trường học</option>
                                    <option value="3203">Quản lý xây dựng cơ bản</option>
                                    <option value="4505">Quân nhân</option>
                                    <option value="4503">Quân y</option>
                                    <option value="3925">Tạp vụ</option>
                                    <option value="3919">Thủ kho</option>
                                    <option value="3111">Thư ký hành chính</option>
                                    <option value="5303">Thư ký khoa</option>
                                    <option value="3109">Thư ký Lãnh đạo Trường/CQ/ĐV</option>
                                    <option value="1101">Thư viện viên</option>
                                    <option value="3319">Thư viện viên</option>
                                    <option value="2901">Trợ giảng</option>
                                    <option value="4507">Trợ lý hậu cần</option>
                                    <option value="3107">Trợ lý Lãnh đạo Trường/CQ/ĐV</option>
                                    <option value="4303">Trọng tài</option>
                                    <option value="3923">Trực tổng đài</option>
                                    <option value="5301">Văn thư khoa</option>
                                    <option value="3927">Y tế đơn vị</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label"><a href="javascript:">Đ.vị sinh
                                    hoạt chuyên môn:</a></label>
                            <div class="col-lg-9">
                                <input type="hidden" name="data[User][dvsh]" id="donvisinhhoat" value="">
                                <select name="data[User][dvsh]" class="input_cvhn form-control custom-select rounded"
                                        id="DonViSinhHoat">
                                    <option value="">Chọn</option>
                                    <option value="100">Đại học Đà Nẵng</option>
                                    <option value="100100">Cơ quan Đại học Đà Nẵng</option>
                                    <option value="100100101">Văn phòng ĐHĐN</option>
                                    <option value="100100112">Văn phòng Đảng ủy ĐHĐN</option>
                                    <option value="100100113">Văn phòng Công đoàn ĐHĐN</option>
                                    <option value="100100114">Văn phòng Đoàn thanh niên ĐHĐN</option>
                                    <option value="100100115100">Ban Giám đốc Trung tâm Đào tạo Thường xuyên</option>
                                    <option value="100100115101">Phòng TCHC Trung tâm Đào tạo Thường xuyên</option>
                                    <option value="100100115102">Phòng Giáo vụ Trung tâm Đào tạo Thường xuyên</option>
                                    <option value="100100116100">Ban Giám đốc Trung tâm TTHL và Truyền thông</option>
                                    <option value="100100116101">Phòng Hành chính Quản trị TTHL</option>
                                    <option value="100100116102">Phòng Dịch vụ Thông tin TTHL</option>
                                    <option value="100101100">Ban Giám hiệu</option>
                                    <option value="100101101">Phòng Tổ chức - Hành chính Trường ĐHBK</option>
                                    <option value="100101102">Phòng Đào tạo Trường ĐHBK</option>
                                    <option value="100101103">Phòng Kế hoạch - Tài chính Trường ĐHBK</option>
                                    <option value="100101104">Văn phòng Đảng uỷ- Công đoàn- Đoàn TN ĐHBK</option>
                                    <option value="100101105">Phòng Công tác Sinh viên Trường ĐHBK</option>
                                    <option value="100101106">Khoa Cơ khí Trường ĐHBK</option>
                                    <option value="100101128100">Bộ môn Khoa học ứng dụng</option>
                                    <option value="100101108">Khoa XD Dân dụng và CN Trường ĐHBK</option>
                                    <option value="100101109">Khoa Xây dựng Cầu đường Trường ĐHBK</option>
                                    <option value="100101109100">Bộ môn Cầu và Công trình ngầm</option>
                                    <option value="100101109101">Bộ môn Đường ô tô và Đường thành phố</option>
                                    <option value="100101109102">Bộ môn Cơ sở Kỹ thuật xây dựng</option>
                                    <option value="100101110">Khoa Xây dựng Công trình Thủy Trường ĐHBK</option>
                                    <option value="100101110100">Bộ môn Cơ sở kỹ thuật thủy lợi</option>
                                    <option value="100101110101">Bộ môn Công trình thủy</option>
                                    <option value="100101112103">Trung tâm Thí nghiệm Điện</option>
                                    <option value="100101111">Khoa Công nghệ Nhiệt - Điện lạnh Trường ĐHBK</option>
                                    <option value="100101111100">Bộ môn Cơ sở Nhiệt - Lạnh</option>
                                    <option value="100101111101">Bộ môn Kỹ thuật Nhiệt - Lạnh</option>
                                    <option value="100101111102">Bộ môn Kỹ thuật Năng lượng</option>
                                    <option value="100101112">Khoa Điện Trường ĐHBK</option>
                                    <option value="100101112100">Bộ môn Hệ thống điện</option>
                                    <option value="100101112101">Bộ môn Tự động hóa</option>
                                    <option value="100101112102">Bộ môn Điện công nghiệp</option>
                                    <option value="100101113">Khoa Hóa Trường ĐHBK</option>
                                    <option value="100101113100">Bộ môn Công nghệ vật liệu</option>
                                    <option value="100101113101">Bộ môn Công nghệ Hóa dầu và Khí</option>
                                    <option value="100101113102">Bộ môn Công nghệ thực phẩm</option>
                                    <option value="100101113103">Bộ môn Công nghệ Sinh học</option>
                                    <option value="100101114">Khoa Công nghệ Thông tin Trường ĐHBK</option>
                                    <option value="100101114100">Bộ môn Công nghệ phần mềm</option>
                                    <option value="100101114101">Bộ môn Mạng và Truyền thông</option>
                                    <option value="100101114102">Bộ môn Hệ thống nhúng</option>
                                    <option value="100101115">Dự án Đào tạo KS Chất lượng cao Trường ĐHBK</option>
                                    <option value="100101116">Khoa Điện tử - Viễn thông Trường ĐHBK</option>
                                    <option value="100101116100">Bộ môn Kỹ thuật viễn thông</option>
                                    <option value="100101116101">Bộ môn Kỹ thuật Điện tử</option>
                                    <option value="100101116102">Bộ môn Kỹ thuật máy tính</option>
                                    <option value="100101117">Khoa Cơ khí Giao thông Trường ĐHBK</option>
                                    <option value="100101117100">Bộ môn Cơ khí động lực</option>
                                    <option value="100101117101">Bộ môn Thiết kế máy - Hệ thống Công nghiệp</option>
                                    <option value="100101117102">Bộ môn Kỹ thuật Tàu thủy</option>
                                    <option value="100101118">Phòng Khoa học Công nghệ và HTQT Trường ĐHBK</option>
                                    <option value="100101119">Khoa Môi trường Trường ĐHBK</option>
                                    <option value="100101120">Khoa Quản lý dự án Trường ĐHBK</option>
                                    <option value="100101121">Trung tâm Tin học Bách khoa</option>
                                    <option value="100101122">Trung tâm Xuất sắc Trường ĐHBK</option>
                                    <option value="100101123">Phòng Khảo thí và Đảm bảo Chất lượng Giáo dục Trường
                                        ĐHBK
                                    </option>
                                    <option value="100101124">Khoa Kiến trúc Trường ĐHBK</option>
                                    <option value="100101125">Phòng Cơ sở Vật chất Trường ĐHBK</option>
                                    <option value="100101126">Phòng Thanh tra - Pháp chế Trường ĐHBK</option>
                                    <option value="100102100">Ban Giám hiệu Trường ĐHKT</option>
                                    <option value="100102101">Phòng Tổ chức - Hành chính Trường ĐHKT</option>
                                    <option value="100102102">Phòng Đào tạo Trường ĐHKT</option>
                                    <option value="100103120101">Bộ môn Chuyên ngành</option>
                                    <option value="100102103">Phòng Kế hoạch - Tài chính Trường ĐHKT</option>
                                    <option value="100102104">Phòng Công tác sinh viên Trường ĐHKT</option>
                                    <option value="100102105">Khoa Quản trị kinh doanh Trường ĐHKT</option>
                                    <option value="100102124100">Bộ môn Marketing</option>
                                    <option value="100102105101">Bộ môn Quản trị kinh doanh tổng quát</option>
                                    <option value="100102105102">Bộ môn Quản trị nguồn nhân lực</option>
                                    <option value="100102106">Khoa Thương mại Điện tử Trường ĐHKT</option>
                                    <option value="100102106100">Bộ môn Kinh doanh Thương mại</option>
                                    <option value="100102106101">Bộ môn Thương mại điện tử</option>
                                    <option value="100102107">Khoa Kinh tế Trường ĐHKT</option>
                                    <option value="100102107100">Bộ môn Kinh tế học</option>
                                    <option value="100102107101">Bộ môn Kinh tế phát triển</option>
                                    <option value="100102108">Khoa Kế toán Trường Đại học Kinh tế ĐHKT</option>
                                    <option value="100102108100">Bộ môn Kế toán</option>
                                    <option value="100102108101">Bộ môn Kiểm toán</option>
                                    <option value="100102109">Khoa Ngân hàng Trường ĐHKT</option>
                                    <option value="100102110">Khoa Lý luận chính trị Trường ĐHKT</option>
                                    <option value="100102110100">Bộ môn Triết học</option>
                                    <option value="100102110101">Bộ môn Lịch sử Đảng và Tư tưởng Hồ Chí Minh</option>
                                    <option value="100102111">Khoa Thống kê Tin học Trường ĐHKT</option>
                                    <option value="100102111100">Bộ môn Thống kê</option>
                                    <option value="100102111101">Bộ môn Tin học quản lý</option>
                                    <option value="100102112">Phòng Khoa học và HTQT Trường ĐHKT</option>
                                    <option value="100102114">Khoa Luật Trường Đại học Kinh tế ĐHKT</option>
                                    <option value="100102115">Khoa Du lịch Trường ĐHKT</option>
                                    <option value="100102115100">Bộ môn Kinh doanh Khách sạn</option>
                                    <option value="100102115101">Bộ môn Kinh doanh Lữ hành</option>
                                    <option value="100102116">Trung tâm Nghiên cứu và Phát triển Logistics</option>
                                    <option value="100102117">Văn phòng Đoàn Thanh niên</option>
                                    <option value="100102118">Tổ Ngoại ngữ Chuyên ngành</option>
                                    <option value="100102119">Trung tâm Hỗ trợ SV và Quan hệ DN</option>
                                    <option value="100102120">Trung tâm Ngoại ngữ - Tin học</option>
                                    <option value="100102121">Phòng Cơ sở Vật chất Trường ĐHKT</option>
                                    <option value="100102122">Phòng Khảo thí và Đảm bảo Chất lượng Giáo dục Trường
                                        ĐHKT
                                    </option>
                                    <option value="100102123">Phòng Thanh tra - Pháp chế Trường ĐHKT</option>
                                    <option value="100102124">Khoa Marketing Trường ĐHKT</option>
                                    <option value="100102125">Trung tâm Nghiên cứu phát triển Quản trị và Tư vấn DN
                                    </option>
                                    <option value="100102126">Trung tâm Thúc đẩy động lực cá nhân</option>
                                    <option value="100102127">Trung tâm Công nghệ Thông tin và Truyền thông</option>
                                    <option value="100102128">Khoa Tài chính Trường ĐHKT</option>
                                    <option value="100103100">Ban Giám hiệu Trường ĐHSP</option>
                                    <option value="100103101">Phòng Tổ chức - Hành chính Trường ĐHSP</option>
                                    <option value="100103102">Phòng Đào tạo Trường ĐHSP</option>
                                    <option value="100103103">Phòng Kế hoạch - Tài chính Trường ĐHSP</option>
                                    <option value="100103104">Phòng Công tác Sinh viên Trường ĐHSP</option>
                                    <option value="100103105">Văn phòng Đoàn TNCS - Đảng uỷ ĐHSP</option>
                                    <option value="100103106">Khoa Toán Trường ĐHSP</option>
                                    <option value="100103107">Khoa Vật lý Trường ĐHSP</option>
                                    <option value="100103108">Khoa Hóa học Trường ĐHSP</option>
                                    <option value="100103109">Khoa Sinh - Môi trường Trường ĐHSP</option>
                                    <option value="100103110">Khoa Lịch sử Trường ĐHSP</option>
                                    <option value="100103111">Khoa Giáo dục Tiểu học Trường ĐHSP</option>
                                    <option value="100103112">Khoa Tâm lý giáo dục Trường ĐHSP</option>
                                    <option value="100103113">Khoa Tin học Trường ĐHSP</option>
                                    <option value="100103114">Khoa Địa lý Trường ĐHSP</option>
                                    <option value="100103115">Khoa Ngữ văn Trường ĐHSP</option>
                                    <option value="100103116">Khoa Giáo dục chính trị Trường ĐHSP</option>
                                    <option value="100103117">Phòng Khoa học và HTQT Trường ĐHSP</option>
                                    <option value="100103118">Phòng Khảo thí và Đảm bảo Chất lượng Giáo dục Trường
                                        ĐHSP
                                    </option>
                                    <option value="100103119">Trung tâm Học liệu và Elearning Trường ĐHSP</option>
                                    <option value="100103120">Khoa Giáo dục Mầm non Trường ĐHSP</option>
                                    <option value="100104100">Ban Giám hiệu Trường ĐHNN</option>
                                    <option value="100104101">Phòng Tổ chức - Hành chính Trường ĐHNN</option>
                                    <option value="100104102">Phòng Đào tạo Trường ĐHNN</option>
                                    <option value="100104103">Phòng Kế hoạch - Tài chính Trường ĐHNN</option>
                                    <option value="100104104">Khoa Tiếng Anh Trường ĐHNN</option>
                                    <option value="100104105">Khoa Tiếng Nga Trường ĐHNN</option>
                                    <option value="100104106">Khoa Tiếng Pháp Trường ĐHNN</option>
                                    <option value="100104107">Khoa Tiếng Anh CN Trường ĐHNN</option>
                                    <option value="100104108">Khoa Tiếng Trung Trường ĐHNN</option>
                                    <option value="100104109">Khoa Quốc tế học Trường ĐHNN</option>
                                    <option value="100104110">Trung tâm Dịch thuật Trường ĐHNN</option>
                                    <option value="100104111">Phòng Khoa học và HTQT Trường ĐHNN</option>
                                    <option value="100104112">Khoa Ngôn ngữ và Văn hóa Nhật Bản Trường ĐHNN</option>
                                    <option value="100104113">Phòng Công tác sinh viên Trường ĐHNN</option>
                                    <option value="100104114">Phòng Khảo thí và Đảm bảo Chất lượng Giáo dục Trường
                                        ĐHNN
                                    </option>
                                    <option value="100104115">Văn phòng Đoàn TN- Đảng Uỷ ĐHNN</option>
                                    <option value="100104116">Tổ Thư viện Trường ĐHNN</option>
                                    <option value="100104117">Phòng Cơ sở Vật chất Trường ĐHNN</option>
                                    <option value="100104118">Phòng Thanh tra - Pháp chế ĐHNN</option>
                                    <option value="100105100">Ban Giám đốc phân hiệu ĐHĐN tại PHKT</option>
                                    <option value="100105101">Phòng Hành chính Tổng hợp PHKT</option>
                                    <option value="100105102">Phòng Đào tạo PHKT</option>
                                    <option value="100105103">Phòng KH-TC Phân hiệu ĐHĐN tại PHKT</option>
                                    <option value="100105104">Phòng Công tác HSSV PHKT</option>
                                    <option value="100105105">Phòng Khoa học, Sau đại học và Hợp tác Quốc tế PHKT
                                    </option>
                                    <option value="100106100">Tổ Đào tạo Khoa Y Dược</option>
                                    <option value="100106101">Tổ Hành chính Tổng hợp Khoa Y Dược</option>
                                    <option value="100107100">Ban Giám hiệu Trường Đại học Sư phạm Kỹ thuật</option>
                                    <option value="100107101">Phòng Tổ chức - Hành chính Trường Đại học SPKT</option>
                                    <option value="100107102">Phòng Đào tạo Trường Đại học SPKT</option>
                                    <option value="100107103">Phòng Kế hoạch - Tài chính Trường Đại học SPKT</option>
                                    <option value="100107104">Phòng Công tác Sinh viên Trường Đại học SPKT</option>
                                    <option value="100107105">Khoa Cơ khí Trường Đại học SPKT</option>
                                    <option value="100107106">Khoa Điện - Điện tử Trường Đại học SPKT</option>
                                    <option value="100107107">Khoa Kỹ thuật xây dựng Trường Đại học SPKT</option>
                                    <option value="100107108">Khoa Công nghệ Hóa học - Môi trường Trường Đại học SPKT
                                    </option>
                                    <option value="100107109">Phòng QL Khoa học và HTQT Trường Đại học SPKT</option>
                                    <option value="100107110">Phòng Khảo thí và Đảm bảo chất lượng giáo dục</option>
                                    <option value="100108100">Ban Giám hiệu Trường Đại học Công nghệ Thông tin và Truyền
                                        thông Việt - Hàn
                                    </option>
                                    <option value="100108101">Phòng Tổ chức - Hành chính, ĐHVH</option>
                                    <option value="100108102">Phòng Đào tạo, ĐHVH</option>
                                    <option value="100108103">Phòng Kế hoạch - Tài chính, ĐHVH</option>
                                    <option value="100108104">Khoa Kinh tế số và Thương mại Điện tử, ĐHVH</option>
                                    <option value="100108105">Khoa Khoa học máy tính, ĐHVH</option>
                                    <option value="100108106">Phòng Công tác Sinh viên, ĐHVH</option>
                                    <option value="100108107">Phòng Khảo thí - Đảm bảo chất lượng, ĐHVH</option>
                                    <option value="100108108">Phòng Khoa học Công nghệ và Hợp tác Quốc tế, ĐHVH</option>
                                    <option value="101">Hưu trí, thôi việc, chuyển công tác</option>
                                    <option value="101100">Hưu trí</option>
                                    <option value="101101">Chuyển công tác</option>
                                    <option value="101102">Chết</option>
                                    <option value="101103">Thôi việc, chấm dứt HĐ</option>
                                    <option value="101104">Kỷ luật, Buộc thôi việc</option>
                                    <option value="101105">Tự ý bỏ việc, đi học quá hạn</option>
                                    <option value="100104119">Trung tâm Ngoại ngữ Đà Nẵng</option>
                                    <option value="100101106100">Bộ môn Chế tạo Máy</option>
                                    <option value="100101106101">Bộ môn Cơ điện tử</option>
                                    <option value="100101106102">Bộ môn Công nghệ Vật liệu</option>
                                    <option value="100101108100">Bộ môn Kết cấu</option>
                                    <option value="100101108101">Bộ môn Thi công</option>
                                    <option value="100101128">Khoa Khoa Công nghệ Tiên tiến</option>
                                    <option value="100107114">Phòng Cơ sở vật chất</option>
                                    <option value="100107113">Khoa Sư phạm Công nghiệp</option>
                                    <option value="100101119100">Bộ môn Kỹ thuật Môi trường</option>
                                    <option value="100101119101">Bộ môn Quản lý Môi trường</option>
                                    <option value="100101109103">Bộ môn Vật liệu xây dựng</option>
                                    <option value="100101124100">Bộ môn Quy hoạch</option>
                                    <option value="100101124101">Bộ môn Kiến trúc</option>
                                    <option value="100101120100">Bộ môn Quản lý Dự án Xây dựng</option>
                                    <option value="100101120101">Bộ môn Quản lý Công nghiệp</option>
                                    <option value="100105106">Tổ Thư viện PHKT</option>
                                    <option value="100105107">Tổ Đảm bảo chất lượng giáo dục và khảo thí PHKT</option>
                                    <option value="100105112101">Bộ môn Kỹ thuật PHKT</option>
                                    <option value="100105109">Khoa Kinh tế PHKT</option>
                                    <option value="100105113101">Bộ môn Cơ bản PHKT</option>
                                    <option value="100105113100">Bộ môn Sư phạm PHKT</option>
                                    <option value="100105112">Khoa Kỹ thuật Nông nghiệp PHKT</option>
                                    <option value="100105113">Khoa Sư phạm &amp; dự bị đại học PHKT</option>
                                    <option value="100100115103">Phòng Tài vụ Trung tâm Đào tạo Thường xuyên</option>
                                    <option value="100102129">Thư viện Trường ĐHKT</option>
                                    <option value="100103120100">Bộ môn Cơ sở</option>
                                    <option value="100107111">Tổ Công nghệ Thông tin Trường ĐHSPKT</option>
                                    <option value="100108109">Văn phòng Đảng, Công đoàn, ĐHVH</option>
                                    <option value="100105112100">Bộ môn Nông nghiệp PHKT</option>
                                    <option value="100105109100">Bộ môn Kế toán Kiểm toán PHKT</option>
                                    <option value="100105109101">Bộ môn Quản lý Kinh tế PHKT</option>
                                    <option value="100106102">Tổ Khảo thí và Đảm bảo CLGD Khoa Y Dược</option>
                                    <option value="100106104">Bộ môn Nội</option>
                                    <option value="100106105">Bộ môn Điều dưỡng Khoa Y Dược</option>
                                    <option value="100107112">Tổ Thanh tra và pháp chế</option>
                                    <option value="100104120">Khoa Sư phạm Ngoại ngữ</option>
                                    <option value="100106107">Tổ Khoa học và Hợp tác Quốc tế Khoa Y Dược</option>
                                    <option value="100101127">Trung tâm Học liệu và Truyền thông</option>
                                    <option value="100100118100">Tổ Hành chính, Cơ sở vật chất</option>
                                    <option value="100100118101">Tổ Đào tạo, Công tác sinh viên</option>
                                    <option value="100100118102">Tổ KHCN, ĐBCL và Hợp tác Quốc tế</option>
                                    <option value="100113100">Tổ Hành chính Tổng hợp</option>
                                    <option value="100113101">Phòng Khoa học - Hợp tác Quốc tế</option>
                                    <option value="100101117103">Bộ môn Cơ Kỹ thuật</option>
                                    <option value="100101128101">Bộ môn Kỹ thuật Công nghệ Tiên tiến</option>
                                    <option value="100108110">Phòng Thanh tra - Pháp chế, ĐHVH</option>
                                    <option value="100101129">Tổ Công nghệ Thông tin</option>
                                    <option value="100104121">Trung tâm Khảo thí Ngoại ngữ</option>
                                    <option value="100102130">Văn phòng Đảng ủy</option>
                                    <option value="100102131">Văn phòng Công Đoàn</option>
                                    <option value="100102132">Khoa Kinh doanh quốc tế</option>
                                    <option value="100102132100">Bộ môn Quản trị kinh doanh quốc tế</option>
                                    <option value="100102133">Trung tâm Đào tạo quốc tế</option>
                                    <option value="100102134">Trung tâm Nghiên cứu và Tư vấn du lịch</option>
                                    <option value="100102114100">Bộ môn Luật Kinh tế - Dân sự</option>
                                    <option value="100102114101">Bộ môn Luật Hành chính - Nhà nước</option>
                                    <option value="100102109100">Bộ môn Tài Chính công</option>
                                    <option value="100102109101">Bộ môn Ngân hàng</option>
                                    <option value="100102128100">Bộ môn Tài chính Doanh nghiệp</option>
                                    <option value="100102128101">Bộ môn Đầu tư tài chính</option>
                                    <option value="100102110102">Bộ môn Hành chính công</option>
                                    <option value="100106108">Tổ Công tác Sinh viên</option>
                                    <option value="100106110">Bộ môn Giải phẩu</option>
                                    <option value="100106111">Bộ môn Y học chức năng - Xét nghiệm y học</option>
                                    <option value="100106112">Bộ môn Y tế công cộng - Dịch tễ học lâm sàng</option>
                                    <option value="100106113">Bộ môn Nhiễm - Vi sinh - Ký sinh trùng</option>
                                    <option value="100106115">Bộ môn Hóa học</option>
                                    <option value="100106116">Bộ môn Sinh lý</option>
                                    <option value="100106117">Bộ môn Lý sinh - Kỹ thuật y học</option>
                                    <option value="100106118">Bộ môn Ngoại</option>
                                    <option value="100106119">Bộ môn Phụ sản</option>
                                    <option value="100106120">Bộ môn Nhi</option>
                                    <option value="100106121">Bộ môn Liên chuyên khoa hệ nội</option>
                                    <option value="100106122">Bộ môn Liên chuyên khoa hệ ngoại</option>
                                    <option value="100106123">Bộ môn Nha khoa bệnh lý và Phẫu thuật</option>
                                    <option value="100106124">Bộ môn Nha khoa phục hồi</option>
                                    <option value="100106125">Bộ môn Nha khoa dự phòng và phát triển</option>
                                    <option value="100106126">Bộ môn Phẫu thuật tạo hình thẩm mỹ</option>
                                    <option value="100106129">Bộ môn Dược liệu - Kiểm nghiệm</option>
                                    <option value="100106131">Bộ môn Hóa dược - Công nghiệp Dược</option>
                                    <option value="100106132">Bộ môn Dược lâm sàng - Quản lý dược</option>
                                    <option value="100106133">Trung tâm Thí nghiệm và Tiền lâm sàng</option>
                                    <option value="100107106100">Bộ môn Điện tử - Viễn thông</option>
                                    <option value="100107106101">Bộ môn Tự động hóa</option>
                                    <option value="100107106102">Bộ môn Hệ thống Điện</option>
                                    <option value="100107106103">Bộ môn Công nghệ Thông tin</option>
                                    <option value="100107105100">Bộ môn Cơ Nhiệt - Điện lạnh</option>
                                    <option value="100107105101">Bộ môn Cơ khí Ô tô</option>
                                    <option value="100107105102">Bộ môn Cơ khí Chế tạo</option>
                                    <option value="100107105103">Bộ môn Cơ Điện tử</option>
                                    <option value="100107107100">Bộ môn Xây dựng</option>
                                    <option value="100107107101">Bộ môn Kiến trúc</option>
                                    <option value="100107107102">Bộ môn Cầu đường</option>
                                    <option value="100107108100">Bộ môn Công nghệ Thực phẩm</option>
                                    <option value="100107108101">Bộ môn Công nghệ Sinh học</option>
                                    <option value="100107108102">Bộ môn Công nghệ Hóa học</option>
                                    <option value="100107108103">Bộ môn Kỹ thuật Môi trường</option>
                                    <option value="100107113100">Bộ môn Cơ sở kỹ thuật</option>
                                    <option value="100107113101">Bộ môn Sư phạm kỹ thuật</option>
                                    <option value="100101130">Viện Khoa học và Công nghệ Bách khoa Đà Nẵng</option>
                                    <option value="100104122">Trung tâm Khảo thí Ngoại ngữ - Trường ĐHNN</option>
                                    <option value="100103121">Phòng Cơ sở vật chất Trường ĐHSP</option>
                                    <option value="100113102">Phòng Đào tạo</option>
                                    <option value="100101131">Trung tâm Hỗ trợ sinh viên và Quan hệ doanh nghiệp
                                    </option>
                                    <option value="100113103">Tổ Tài vụ</option>
                                    <option value="100103123">Tổ Công nghệ Thông tin và Truyền thông Trường ĐHSP
                                    </option>
                                    <option value="100107115">Trung tâm Học liệu và Truyền thông - Trường ĐHSPKT
                                    </option>
                                    <option value="100103128">Khoa Giáo dục Nghệ thuật Trường ĐHSP</option>
                                    <option value="100103124">Trung tâm Hỗ trợ sinh viên và Quan hệ doanh nghiệp Trường
                                        ĐHSP
                                    </option>
                                    <option value="100103125">Trung tâm Nghiên cứu và Bồi dưỡng Nhà giáo, Cán bộ quản lý
                                        giáo dục Trường ĐHSP
                                    </option>
                                    <option value="100103126">Trung tâm Khoa học xã hội và nhân văn</option>
                                    <option value="100102110103">Bộ môn Kinh tế chính trị và Chủ nghĩa xã hội khoa học
                                    </option>
                                    <option value="100108111">Khoa Kỹ thuật máy tính và Điện tử, ĐHVH</option>
                                    <option value="100108112">Phòng Cơ sở vật chất, ĐHVH</option>
                                    <option value="100108113">Tổ Cơ bản, ĐHVH</option>
                                    <option value="100108114">Trung tâm Ngoại ngữ - Tin học, ĐHVH</option>
                                    <option value="100108115">Trung tâm Quản trị và Phát triển CNTT, ĐHVH</option>
                                    <option value="100108116">Trung tâm Học liệu và Truyền thông, ĐHVH</option>
                                    <option value="100108118">Tổ Quản lý Ký túc xá - Phục vụ cộng đồng, ĐHVH</option>
                                    <option value="100101132">Khoa Xây dựng Công trình thủy Trường ĐHBK</option>
                                    <option value="100106135">Tổ Công nghệ Thông tin truyền thông và Thư viện</option>
                                    <option value="100101117104">Bộ môn Kỹ thuật Ô tô</option>
                                    <option value="100101110102">Bộ môn Tin học Xây dựng</option>
                                    <option value="100101108102">Bộ môn Cơ học Công trình</option>
                                    <option value="100100129">Hội đồng ĐHĐN</option>
                                    <option value="100101133">Hội đồng trường ĐHBK</option>
                                    <option value="100102135">Hội đồng trường ĐHKT</option>
                                    <option value="100104123">Hội đồng trường ĐHNN</option>
                                    <option value="100107116">Hội đồng trường ĐHSPKT</option>
                                    <option value="100103127">Hội đồng trường ĐHSP</option>
                                    <option value="100108119">Hội đồng trường ĐH CNTTTT VH</option>
                                    <option value="100110100">Phòng Hành chính - Tổng hợp</option>
                                    <option value="100110101">Phòng Đối ngoại và Chăm sóc khách hàng</option>
                                    <option value="100100130">Văn phòng Đảng ủy Cơ quan ĐHĐN</option>
                                    <option value="100113104">Tổ Khoa học và Công nghệ</option>
                                    <option value="100113104100">Bộ môn Khoa học Y sinh</option>
                                    <option value="100113105">Bộ môn Công nghệ Thông tin</option>
                                    <option value="100104124">Trung tâm Công nghệ Thông tin và Học liệu</option>
                                    <option value="100113106">Tổ Kinh tế và Kinh doanh</option>
                                    <option value="100104125">Khoa Ngôn ngữ và Văn hóa Hàn Quốc - Trường ĐHNN</option>
                                    <option value="100104127">Tổ tiếng Thái Lan</option>
                                    <option value="100100100">Ban Giám đốc ĐHĐN</option>
                                    <option value="100100102">Ban Tổ chức Cán bộ ĐHĐN</option>
                                    <option value="100100103">Ban Đào tạo ĐHĐN</option>
                                    <option value="100100104">Ban Kế hoạch - Tài chính ĐHĐN</option>
                                    <option value="100100105">Ban Khoa học, Công nghệ và Môi trường ĐHĐN</option>
                                    <option value="100100106">Ban Hợp tác quốc tế Đại học Đà Nẵng ĐHĐN</option>
                                    <option value="100100108">Ban Quản lý Cơ sở vật chất và Đầu tư ĐHĐN</option>
                                    <option value="100100109">Ban Công tác học sinh, sinh viên ĐHĐN</option>
                                    <option value="100100111">Ban Đảm bảo chất lượng Giáo dục ĐHĐN</option>
                                    <option value="100100121">Ban Thanh tra và Pháp chế</option>
                                    <option value="100101">Trường Đại học Bách khoa</option>
                                    <option value="100102">Trường Đại học Kinh tế</option>
                                    <option value="100103">Trường Đại học Sư phạm</option>
                                    <option value="100104">Trường Đại học Ngoại ngữ</option>
                                    <option value="100107">Trường Đại học Sư phạm Kỹ thuật</option>
                                    <option value="100108">Trường Đại học Công nghệ Thông tin Và Truyền thông Việt -
                                        Hàn
                                    </option>
                                    <option value="100105">Phân hiệu ĐHĐN tại KonTum</option>
                                    <option value="100106">Khoa Y - Dược ĐHĐN</option>
                                    <option value="100113">Viện Nghiên cứu và Đào tạo Việt - Anh ĐHĐN</option>
                                    <option value="100114">Viện DNIIT</option>
                                    <option value="100116">Trung tâm Nhật Bản</option>
                                    <option value="100110">Trung tâm Y Khoa</option>
                                    <option value="100111">Trung tâm Nghiên cứu quản lý rủi ro và khoa học an toàn
                                    </option>
                                    <option value="100100115">Trung tâm Đào tạo Thường xuyên ĐHĐN</option>
                                    <option value="100100117">Trung tâm Phát triển phần mềm ĐHĐN</option>
                                    <option value="100100116">Trung tâm Thông tin - Học liệu và Truyền thông</option>
                                    <option value="100100118">Khoa Giáo dục Thể chất ĐHĐN</option>
                                    <option value="100100122">TT Nghiên cứu và Tư vấn việc làm, DH tự túc</option>
                                    <option value="100100123">Trung tâm Thể thao ĐHĐN</option>
                                    <option value="100100124">Khoa Đào tạo quốc tế ĐHĐN</option>
                                    <option value="100100127">Khoa Giáo dục Quốc phòng và An ninh</option>
                                    <option value="100117">Viện Khoa học và Công nghệ tiên tiến ĐHĐN</option>
                                    <option value="100100128">Trung tâm Kiểm định Chất lượng Giáo dục - ĐHĐN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Đang nghỉ chế độ BHXH:</label>
                            <div class="col-lg-9">
                                <select name="data[User][nghi_baohiemxahoi_id]"
                                        class="input_cvhn form-control custom-select rounded"
                                        id="UserNghiBaohiemxahoiId">
                                    <option value="">Chọn</option>
                                    <option value="1">Nghỉ thai sản có lương</option>
                                    <option value="2">Nghỉ thai sản không lương</option>
                                    <option value="3">Nghỉ không lương</option>
                                    <option value="4">Nghỉ ốm dài hạn</option>
                                    <option value="5">Đi nước ngoài</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Đính kèm file QĐTD:</label>
                            <div class="col-lg-9">
                                <input type="file" name="data[Hopdong][file]" class="form-control rounded form-control-file"
                                       id="pc_thuhut" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Số sổ bảo hiểm:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][sobhxh]" class="form-control rounded" id="pc_thuhut"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Liên kết scv::</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][lienketscv]" class="form-control rounded"
                                       id="lienketscv" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thông tin chức danh nghề nghiệp, lương - Hệ số phụ cấp -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Thông tin chức danh nghề nghiệp, lương - Hệ số phụ cấp</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group2 col-md-6">
                        <input type="hidden" name="data[User][maloai]" class="form-control rounded" id="maloai"
                               value="">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Chức danh nghề nghiệp <span
                                        style="color:red">(*)</span>:</label>
                            <div class="col-lg-9">
                                <select name="data[User][ngachcc]"
                                        class="UserHochamId form-control custom-select rounded" id="ngachcc">
                                    <option value="">Chọn</option>
                                    <option value="16118">Bác sỹ</option>
                                    <option value="16116">Bác sỹ cao cấp</option>
                                    <option value="16117">Bác sỹ chính</option>
                                    <option value="01004">Cán sự</option>
                                    <option value="01003">Chuyên viên</option>
                                    <option value="01a003">Chuyên viên (trình độ cao đẳng)</option>
                                    <option value="01001">Chuyên viên cao cấp</option>
                                    <option value="01002">Chuyên viên chính</option>
                                    <option value="16134">Dược sỹ</option>
                                    <option value="16132">Dược sỹ cao cấp</option>
                                    <option value="16133">Dược sỹ chính</option>
                                    <option value="16135">Dược sỹ trung cấp</option>
                                    <option value="16136">Dược tá</option>
                                    <option value="13102">Giám định viên</option>
                                    <option value="13100">Giám định viên cao cấp</option>
                                    <option value="13101">Giám định viên chính</option>
                                    <option value="V.07.01.03">Giảng viên (hạng III)</option>
                                    <option value="V.07.01.01">Giảng viên cao cấp (hạng I)</option>
                                    <option value="V.07.01.02">Giảng viên chính (hạng II)</option>
                                    <option value="15115">Giáo viên mầm non</option>
                                    <option value="15c207">Giáo viên THPT chưa đạt chuẩn</option>
                                    <option value="15114">Giáo viên tiểu học</option>
                                    <option value="15a203">Giáo viên tiểu học cao cấp</option>
                                    <option value="15a204">Giáo viên Tiểu học chính</option>
                                    <option value="15113">Giáo viên trung học</option>
                                    <option value="15112">Giáo viên trung học cao cấp</option>
                                    <option value="15a202">Giáo viên trung học cơ sở</option>
                                    <option value="15a201">Giáo viên Trung học cơ sở chính</option>
                                    <option value="18181">Huấn luyện viên</option>
                                    <option value="18180">Huấn luyện viên chính</option>
                                    <option value="18182">Hướng dẫn viên</option>
                                    <option value="06031">Kế toán viên</option>
                                    <option value="06a031">Kế toán viên (Trình độ cao đẳng)</option>
                                    <option value="06029">Kế toán viên cao cấp</option>
                                    <option value="06030">Kế toán viên chính</option>
                                    <option value="06033">Kế toán viên sơ cấp</option>
                                    <option value="06032">Kế toán viên trung cấp</option>
                                    <option value="16126">KTV cao cấp y</option>
                                    <option value="16137">KTV chính dược</option>
                                    <option value="16127">KTV chính y</option>
                                    <option value="16138">KTV dược</option>
                                    <option value="13095">Kỹ sư</option>
                                    <option value="13a095">Kỹ sư (Trình độ cao đẳng)</option>
                                    <option value="13093">Kỹ sư cao cấp</option>
                                    <option value="13094">Kỹ sư chính</option>
                                    <option value="13096">Kỹ thuật viên</option>
                                    <option value="02016">Kỹ thuật viên lưu trữ</option>
                                    <option value="16128">Kỹ thuật viên y</option>
                                    <option value="01005">Kỹ thuật viên đánh máy</option>
                                    <option value="V.08.07.18">Kỹ thuật y</option>
                                    <option value="01010">Lái xe cơ quan</option>
                                    <option value="02014">Lưu trữ viên</option>
                                    <option value="02015">Lưu trữ viên trung cấp</option>
                                    <option value="13092">Nghiên cứu viên</option>
                                    <option value="13091">Nghiên cứu viên chính</option>
                                    <option value="01011">Nhân viên bảo vệ</option>
                                    <option value="01007">Nhân viên kỹ thuật</option>
                                    <option value="01009">Nhân viên phục vụ</option>
                                    <option value="01008">Nhân viên văn thư</option>
                                    <option value="01006">Nhân viên đánh máy</option>
                                    <option value="06035">Thủ quỹ cơ quan đơn vị</option>
                                    <option value="V.10.02.06">Thư viện viên</option>
                                    <option value="17a170">Thư viện viên (cao đẳng)</option>
                                    <option value="17169">Thư viện viên chính</option>
                                    <option value="17171">Thư viên viên trung cấp</option>
                                    <option value="V.07.01.23">Trợ giảng</option>
                                    <option value="16129">Y công</option>
                                    <option value="16119">Y sỹ</option>
                                    <option value="16122">Y tá</option>
                                    <option value="16120">Y tá cao cấp</option>
                                    <option value="16121">Y tá chính</option>
                                    <option value="V.05.08.12">Điều dưỡng</option>
                                    <option value="13099">Định chuẩn viên</option>
                                    <option value="13097">Định chuẩn viên cao cấp</option>
                                    <option value="13098">Định chuẩn viên chính</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Mã ngạch <span style="color:red">(*)</span>:</label>
                            <div class="col-lg-9">
                                <input type="text" readonly="" name="data[User][ngachcongchuc_id]"
                                       class="form-control rounded" id="mangach" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Bậc lương:</label>
                            <div class="col-lg-9 form-row">
                                <div class="col-4">
                                    <select name="data[User][bluong]" class="form-control rounded custom-select rounded"
                                            id="select_bacluong">
                                        <option value="">Chọn</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <!--                              <input type="text" name="data[User][bluong]" class="form-control rounded" id="select_bacluong" value="">-->
                                </div>
                                <div class="col-4">
                                    <input type="text" name="data[User][hesoluong]" class="form-control rounded"
                                           placeholder="Hệ số lương" id="hesoluong" value="">
                                </div>
                                <div class="col-4 d-flex flex-row pd-t8">
                                    <label>Mức hưởng</label>
                                    <div class="col-lg-6 custom-control custom-checkbox mg-l12">
                                        <input type="checkbox" class="custom-control-input" id="heso85" name="heso85">
                                    </div>
                                    <div class="col-lg-6 custom-control custom-checkbox mg-l12">
                                        <label class="custom-control-label lab85" for="heso85"
                                               style="vertical-align: sub;">
                                            85%</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Mốc tính nâng lương <span
                                        style="color:red">(*)</span>:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][moctinhnangluong]"
                                       class="form-control rounded hasDatepicker" id="moctinhnangluong" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hưởng lương từ ngày <span
                                        style="color:red">(*)</span>:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][huongtungay]"
                                       class="form-control rounded hasDatepicker" id="huongtungay" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày hưởng TNNG:</label>
                            <div class="col-lg-9">
                                <div class="form-row">
                                    <div class="col-5">
                                        <input type="text" name="data[User][thamnien_nhagiao]"
                                               class="form-control rounded hasDatepicker" placeholder=""
                                               id="thamnien_nhagiao" value="">
                                    </div>
                                    <div class="col-2 text-center" style="padding-top: 5px;">
                                        <span style="font-size: 20px;text-align: center;">+</span>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" name="data[User][tam]" class="form-control rounded"
                                               placeholder="Tỉ lệ %" id="tam" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Phần trăm vượt khung:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][vuotkhung]" class="form-control rounded"
                                       id="vuotkhung" value="">
                            </div>
                        </div>
                        <!--                      <div class="form-group row">-->
                        <!--                          <label for="staticEmail" class="col-lg-3 col-form-label">PC kiêm nhiệm:</label>-->
                        <!--                          <div class="col-lg-9">-->
                        <!--                              <input type="text" name="data[User][pc_kiemnhiem]" class="form-control rounded" id="pc_kiemnhiem" value="">-->
                        <!--                          </div>-->
                        <!--                      </div>-->
                        <!--                      <div class="form-group row">-->
                        <!--                          <label for="staticEmail" class="col-lg-3 col-form-label">PC đặc biệt:</label>-->
                        <!--                          <div class="col-lg-9">-->
                        <!--                              <input type="text" name="data[User][pc_dacbiet]" class="form-control rounded" id="pc_dacbiet" value="">-->
                        <!--                          </div>-->
                        <!--                      </div>-->
                    </div>
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Loại <span
                                        style="color:red">(*)</span></label>
                            <div class="col-lg-9">
                                <select name="data[User][loaicongchuc_id]" id="loaicongchuc_id"
                                        class="UserHochamId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="1">Công chức</option>
                                    <option value="5">HĐ dưới 1 năm</option>
                                    <option value="4">HĐ theo NĐ số 68</option>
                                    <option value="2">Viên chức</option>
                                    <option value="6">Viên chức quản lý</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">PC thu hút:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][pc_thuhut]" class="form-control rounded"
                                       id="pc_thuhut" value="">
                            </div>
                        </div>
                        <!--                      <div class="form-group row">-->
                        <!--                          <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC lưu động:</label>-->
                        <!--                          <div class="col-lg-9">-->
                        <!--                              <input type="text" name="data[User][hspc_luudong]" class="form-control rounded" id="hspc_luudong" value="">-->
                        <!--                          </div>-->
                        <!--                      </div>-->
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">PC độc hại:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][hspc_dochai]" class="form-control rounded"
                                       id="hspc_dochai" value="">
                            </div>
                        </div>
                        <!--                      <div class="form-group row">-->
                        <!--                          <label for="staticEmail" class="col-lg-3 col-form-label">PC đặc thù:</label>-->
                        <!--                          <div class="col-lg-9">-->
                        <!--                              <input type="text" name="data[User][pc_dacthu]" class="form-control rounded" id="pc_dacthu" value="">-->
                        <!--                          </div>-->
                        <!--                      </div>-->
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">PC ưu đãi:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][pc_uudai]" class="form-control rounded"
                                       id="pc_uudai" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC trách nhiệm:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][hspc_trachnhiem]" class="form-control rounded"
                                       id="hspc_trachnhiem" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC khu vực:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][hspc_khuvuc]" class="form-control rounded"
                                       id="hspc_khuvuc" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC khác:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][hspc_khac]" class="form-control rounded"
                                       id="hspc_khac" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thông tin bổ nhiệm -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Thông tin bổ nhiệm</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Chức vụ bổ nhiệm:</label>
                            <div class="col-lg-9">
                                <select name="data[User][chucvuhientai_id]"
                                        class="input_dantoc form-control custom-select rounded" id="UserChucvuhientaiId">
                                    <option value="">Chọn</option>
                                    <option value="111">Bí thư Đoàn TN Cơ quan ĐHĐN</option>
                                    <option value="81">Bí thư đoàn trường</option>
                                    <option value="17">Bí thư Đoàn ĐHĐN</option>
                                    <option value="102">Chánh Văn phòng CĐ</option>
                                    <option value="88">Chánh Văn phòng Đảng ủy</option>
                                    <option value="84">Chánh Văn phòng ĐHĐN</option>
                                    <option value="112">Chủ tịch Hội Sinh viên Việt Nam</option>
                                    <option value="106">Chủ tịch Hội đồng Trường</option>
                                    <option value="105">Chủ tịch Hội đồng ĐHĐN</option>
                                    <option value="4">Giám đốc phân hiệu</option>
                                    <option value="90">Giám đốc Trung tâm</option>
                                    <option value="68">Giám đốc ĐH Vùng</option>
                                    <option value="70">Giám đốc ĐHQG</option>
                                    <option value="86">Giám đốc ĐHĐN</option>
                                    <option value="108">Giám đốc ĐHĐN</option>
                                    <option value="3">Giáo vụ khoa</option>
                                    <option value="7">Hiệu trưởng</option>
                                    <option value="79">Kế toán trưởng</option>
                                    <option value="46">Kế toán trưởng ĐHĐN</option>
                                    <option value="110">Phó Bí thư Đoàn TN Cơ quan ĐHĐN</option>
                                    <option value="32">Phó Bí thư Đoàn ĐHĐN</option>
                                    <option value="89">Phó Chánh Văn phòng Đảng ủy</option>
                                    <option value="85">Phó Chánh Văn phòng ĐHĐN</option>
                                    <option value="113">Phó Chủ tịch Hội Sinh viên Việt Nam</option>
                                    <option value="9">Phó dân quân tự vệ</option>
                                    <option value="82">Phó Giám đốc phân hiệu</option>
                                    <option value="69">Phó Giám đốc ĐH Vùng</option>
                                    <option value="71">Phó Giám đốc ĐHQG</option>
                                    <option value="109">Phó Giám đốc ĐHĐN</option>
                                    <option value="10">Phó GĐ Trung tâm</option>
                                    <option value="12">Phó GĐ TT Ngoại ngữ - Tin học</option>
                                    <option value="15">Phó Hiệu trưởng</option>
                                    <option value="60">Phó Kế toán ĐHĐN</option>
                                    <option value="18">Phó Trưởng ban</option>
                                    <option value="91">Phó Trưởng ban phụ trách</option>
                                    <option value="19">Phó Trưởng Bộ môn</option>
                                    <option value="114">Phó Trưởng bộ môn</option>
                                    <option value="115">Phó Trưởng bộ môn phụ trách</option>
                                    <option value="20">Phó Trưởng Khoa</option>
                                    <option value="22">Phó Trưởng khoa PT</option>
                                    <option value="21">Phó Trưởng phòng</option>
                                    <option value="101">Phó Trưởng phòng phụ trách</option>
                                    <option value="11">Phó Trưởng phòng PT</option>
                                    <option value="119">Phó Trưởng Trung tâm</option>
                                    <option value="67">Phó Viện trưởng</option>
                                    <option value="100">Phó Viện trưởng phụ trách</option>
                                    <option value="103">Phó Viện trưởng phụ trách</option>
                                    <option value="104">Phụ trách kế toán</option>
                                    <option value="121">Phụ trách kế toán</option>
                                    <option value="47">Phụ trách kế toán trường</option>
                                    <option value="118">Quyền Giám đốc Phân hiệu</option>
                                    <option value="26">Quyền Giám đốc Trung tâm</option>
                                    <option value="73">Quyền Giám đốc ĐH Vùng</option>
                                    <option value="27">Quyền Hiệu trưởng</option>
                                    <option value="28">Quyền Trưởng ban</option>
                                    <option value="29">Quyền Trưởng khoa</option>
                                    <option value="30">Quyền Trưởng phòng</option>
                                    <option value="117">Thư ký Hội đồng Trường</option>
                                    <option value="116">Thư ký Hội đồng ĐHĐN</option>
                                    <option value="98">Tổ phó</option>
                                    <option value="33">Tổ Phó chuyên môn</option>
                                    <option value="99">Tổ phó phụ trách</option>
                                    <option value="97">Tổ trưởng</option>
                                    <option value="37">Tổ trưởng Bộ môn</option>
                                    <option value="35">Tổ Trưởng chuyên môn</option>
                                    <option value="92">Tổ trưởng Tổ Bảo vệ</option>
                                    <option value="96">Tổ trưởng Tổ Cơ sở vật chất</option>
                                    <option value="95">Tổ trưởng Tổ Lễ tân - Vệ sinh</option>
                                    <option value="93">Tổ trưởng Tổ Quản trị mạng</option>
                                    <option value="94">Tổ trưởng Tổ xe</option>
                                    <option value="38">Trưởng ban</option>
                                    <option value="40">Trưởng Bộ môn</option>
                                    <option value="41">Trưởng Khoa</option>
                                    <option value="6">Trưởng khối DQ Tự vệ</option>
                                    <option value="44">Trưởng Ngân quỷ trường</option>
                                    <option value="5">Trưởng Ngân quỷ ĐHĐN</option>
                                    <option value="43">Trưởng Ngân qủy ĐHĐN</option>
                                    <option value="42">Trưởng Phòng</option>
                                    <option value="120">Trưởng Trung tâm</option>
                                    <option value="66">Viện trưởng</option>
                                    <option value="107">Vụ trưởng Vụ Kế hoạch - Tài chính</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày bổ nhiệm:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaybonhiem]"
                                       class="form-control rounded hasDatepicker" id="ngaybonhiem" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Đến ngày:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaykt_bonhiem]"
                                       class="form-control rounded hasDatepicker" id="ngaykt_bonhiem" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">CV kiêm nhiệm:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][cvcqkiemnhiem]" class="form-control rounded"
                                       id="cvcqkiemnhiem" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Chức vụ cơ quan cao nhất đã
                                qua:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][cvcqcaonhat]" class="form-control rounded"
                                       id="cvcqcaonhat" value="">
                            </div>
                        </div>
                    </div>
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PCCV</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][hspc]" class="form-control rounded" id="hspc"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Số QĐ bổ nhiệm</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][soqdbonhiem]" class="form-control rounded" id="hspc"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Đính kèm file QĐBN:</label>
                            <div class="col-lg-9">
                                <input type="file" name="data[User][file_qdtuyendung]" class="form-control rounded"
                                       id="fileQDTD" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thông tin đoàn thể -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Thông tin đoàn thể</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày vào Đảng CSVN:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngayvaodang]" class="form-control rounded hasDatepicker" id="ngayvaodang" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngày chính thức:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][ngaychinhthuc]" class="form-control rounded hasDatepicker" id="ngaychinhthuc" value="">
                            </div>
                        </div>

                    </div>
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">CV Đảng hiện tại:</label>
                            <div class="col-lg-9">
                                <select name="data[User][chucvudang_id]" class="UserChucvudangId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="61">Bí thư Ban cán sự Đảng</option>
                                    <option value="5">Bí thư chi bộ</option>
                                    <option value="75">Bí thư Đảng bộ Cơ quan ĐHĐN</option>
                                    <option value="50">Bí thư Đảng uỷ bộ phận</option>
                                    <option value="67">Bí thư Đảng uỷ cơ quan ĐHĐN</option>
                                    <option value="2">Bí thư Đảng ủy ngành</option>
                                    <option value="3">Bí thư Đảng uỷ Trường</option>
                                    <option value="12">Bí thư Đảng uỷ ĐHĐN</option>
                                    <option value="6">Chi ủy viên</option>
                                    <option value="14">Phó Bí thư Ban Cán sự Đảng</option>
                                    <option value="62">Phó bí thư Ban cán sự Đảng</option>
                                    <option value="9">Phó Bí thư chi bộ</option>
                                    <option value="76">Phó Bí thư Đảng bộ Cơ quan ĐHĐN</option>
                                    <option value="52">Phó Bí thư Đảng uỷ bộ phận</option>
                                    <option value="68">Phó bí thư Đảng uỷ cơ quan ĐHĐN</option>
                                    <option value="64">Phó bí thư Đảng uỷ khối CQTW</option>
                                    <option value="8">Phó Bí thư Đảng ủy ngành</option>
                                    <option value="56">Phó bí thư Đảng uỷ Trường</option>
                                    <option value="59">Phó bí thư ĐU Đại học Đà Nẵng</option>
                                    <option value="51">Quyền Bí thư Đảng uỷ bộ phận</option>
                                    <option value="55">Quyền bí thư Đảng uỷ Trường</option>
                                    <option value="71">Quyền Bí thư ĐU Cơ quan ĐHĐN</option>
                                    <option value="58">Quyền bí thư ĐU Đại học Đà Nẵng</option>
                                    <option value="69">Thường vụ Đảng uỷ Cơ quan ĐHĐN</option>
                                    <option value="65">Thường vụ Đảng uỷ Trường</option>
                                    <option value="15">UV Ban Cán sự Đảng</option>
                                    <option value="21">UV BCH Thành uỷ</option>
                                    <option value="22">UV BCH Tỉnh uỷ</option>
                                    <option value="80">UV BCH Đảng bộ Cơ quan ĐHĐN</option>
                                    <option value="77">UV BCH Đảng bộ ĐHĐN</option>
                                    <option value="19">UV BCH Đảng uỷ cơ sở</option>
                                    <option value="20">UV BCH Đảng uỷ ngành</option>
                                    <option value="24">UV BCH Đảng uỷ trên cơ sở</option>
                                    <option value="79">UV BTV Đảng bộ Cơ quan ĐHĐN</option>
                                    <option value="78">UV BTV Đảng bộ ĐHĐN</option>
                                    <option value="13">UV Thường vụ Đảng uỷ cơ sở</option>
                                    <option value="11">UV Thường vụ Đảng ủy ngành</option>
                                    <option value="23">UV Thường vụ Đảng uỷ trên cơ sở</option>
                                    <option value="53">Uỷ viên Thường vụ ĐUBP</option>
                                    <option value="74">Uỷ viên Trung ương Đảng</option>
                                    <option value="66">Uỷ viên Đảng uỷ khối CQTW</option>
                                    <option value="70">Đảng uỷ viên cơ quan</option>
                                    <option value="57">Đảng uỷ viên Đảng uỷ cấp cơ sở</option>
                                    <option value="54">Đảng uỷ viên ĐUBP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">CV đoàn thể hiện tại:</label>
                            <div class="col-lg-9">
                                <select name="data[User][chucvudoanthe_id]" class="UserChucvudoantheId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="1">Bí thư Đoàn Cơ quan</option>
                                    <option value="2">Bí thư Đoàn Trường</option>
                                    <option value="4">Bí thư Đoàn ĐHĐN</option>
                                    <option value="3">Chủ tịch Công đoàn Cơ quan</option>
                                    <option value="6">Chủ tịch Công đoàn Trường</option>
                                    <option value="5">Chủ tịch Công đoàn ĐHĐN</option>
                                    <option value="7">Phó Bí thư Đoàn Cơ quan</option>
                                    <option value="8">Phó Bí thư Đoàn Trường</option>
                                    <option value="10">Phó bí thư Đoàn ĐHĐN</option>
                                    <option value="9">Phó Chủ tịch Công Đoàn Cơ quan</option>
                                    <option value="12">Phó Chủ tịch Công Đoàn Trường</option>
                                    <option value="11">Phó Chủ tịch Công Đoàn ĐHĐN</option>
                                    <option value="13">UV BCH Công đoàn Cơ quan</option>
                                    <option value="15">UV BCH Công đoàn Ngành</option>
                                    <option value="16">UV BCH Công đoàn Trường</option>
                                    <option value="17">UV BCH TW Đoàn</option>
                                    <option value="18">UV BCH Đoàn Cơ quan</option>
                                    <option value="19">UV BCH Đoàn Trường</option>
                                    <option value="14">UV BCH Đoàn ĐHĐN</option>
                                    <option value="20">UV Thường vụ Công đoàn Cơ quan</option>
                                    <option value="23">UV Thường vụ Công đoàn Trường</option>
                                    <option value="22">UV Thường vụ Công đoàn ĐHĐN</option>
                                    <option value="24">UV Thường vụ TW Đoàn</option>
                                    <option value="25">UV Thường vụ Đoàn Cơ quan</option>
                                    <option value="26">UV Thường vụ Đoàn Trường</option>
                                    <option value="21">UV Thường vụ Đoàn ĐHĐN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doanvien" class="col-lg-3 col-form-label">Đoàn viên</label>
                            <div class="col-lg-9 form-row">
                                <div class="radio radio-inline icheck-primary">
                                    <input type="checkbox" class="flat" name="data[User][doanvien]" id="doanvien">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thông tin về trình độ chuyên môn -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Thông tin về trình độ chuyên môn</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ hiện tại:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trinhdochuyenmon_id]" id="selecTrinhdodaotao"
                                        class="UserTrinhdochuyenmonId form-control rounded custom-select">
                                    <option value="">Chọn</option>
                                    <option value="32">Cao đẳng</option>
                                    <option value="9">Chưa qua đào tạo</option>
                                    <option value="46">Chuyên khoa I</option>
                                    <option value="45">Chuyên khoa II</option>
                                    <option value="47">Dược sỹ</option>
                                    <option value="50">Thạc sỹ</option>
                                    <option value="10">THPT</option>
                                    <option value="60">Tiến sỹ</option>
                                    <option value="61">Tiến sỹ Khoa học</option>
                                    <option value="20">Trung cấp</option>
                                    <option value="42">Đại học</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Khối ngành:</label>
                            <div class="col-lg-9">
                                <select name="data[User][khoinganh_id]"
                                        class="UserNganhDaoTaoId form-control rounded custom-select" id="khoinganh">
                                    <option value="">Chọn khối ngành</option>
                                    <option value="1">I</option>
                                    <option value="2">II</option>
                                    <option value="3">III</option>
                                    <option value="4">IV</option>
                                    <option value="5">V</option>
                                    <option value="6">VI</option>
                                    <option value="7">VII</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Lĩnh vực:</label>
                            <div class="col-lg-9">
                                <select name="data[User][linhvuc_id]" class="form-control rounded custom-select" id="linhvuc">
                                    <option value=""> Chọn lĩnh vực</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Chuyên ngành:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][chuyennganh]" class="form-control rounded"
                                       id="chuyennganh" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Hình thức đào tạo:</label>
                            <div class="col-lg-9">
                                <select name="data[User][hinhthucdaotao_id]"
                                        class="UserHinhthucdaotaoId form-control rounded custom-select" id="linhvuc">
                                    <option value="">Chọn</option>
                                    <option value="6">Bằng 2</option>
                                    <option value="1">Chính quy</option>
                                    <option value="5">Chuyên tu</option>
                                    <option value="4">Liên thông</option>
                                    <option value="7">Mở rộng</option>
                                    <option value="2">Tại chức</option>
                                    <option value="8">Từ xa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Quốc gia:</label>
                            <div class="col-lg-9">
                                <select name="data[User][quocgia_id]" id="quocgia"
                                        class="form-control rounded custom-select">
                                    <option value="">Chọn</option>
                                    <option value="14">Mỹ</option>
                                    <option value="18">Nga</option>
                                    <option value="19">Việt Nam</option>
                                    <option value="20">Trung Quốc</option>
                                    <option value="21">Lào</option>
                                    <option value="22">Ba Lan</option>
                                    <option value="23">Thái Lan</option>
                                    <option value="24">Nhật Bản</option>
                                    <option value="25">Ấn Độ</option>
                                    <option value="26">Cộng hòa Pháp</option>
                                    <option value="27">Úc</option>
                                    <option value="28">Vương quốc Anh</option>
                                    <option value="29">Vương quốc Bỉ</option>
                                    <option value="30">Hà Lan</option>
                                    <option value="31">Ý</option>
                                    <option value="32">Đài Loan</option>
                                    <option value="33">Singapore</option>
                                    <option value="34">Canada</option>
                                    <option value="35">Nauy</option>
                                    <option value="36">Belarut</option>
                                    <option value="37">Campuchia</option>
                                    <option value="38">Hàn Quốc</option>
                                    <option value="39">Indonesia</option>
                                    <option value="40">Malaysia</option>
                                    <option value="41">Áo</option>
                                    <option value="42">Hungary</option>
                                    <option value="43">Cộng hòa Séc</option>
                                    <option value="44">Hồng Kông</option>
                                    <option value="45">Phần Lan</option>
                                    <option value="46">Thụy Điển</option>
                                    <option value="47">Tanzania</option>
                                    <option value="48">Bồ Đào Nha</option>
                                    <option value="49">New Zealand</option>
                                    <option value="50">Maroc</option>
                                    <option value="51">Senegal</option>
                                    <option value="52">Rumani</option>
                                    <option value="53">Cộng hòa LB Đức</option>
                                    <option value="54">UAE</option>
                                    <option value="55">Cộng hòa Serbia</option>
                                    <option value="56">Thổ Nhi Kỳ</option>
                                    <option value="57">Kazakhstan</option>
                                    <option value="58">Tây Ban Nha</option>
                                    <option value="59">Nam Phi</option>
                                    <option value="60">TRINIDAD AND TOBAGO</option>
                                    <option value="61">TUNISIA</option>
                                    <option value="62">TURKMENISTAN</option>
                                    <option value="63">URUGUAY</option>
                                    <option value="64">UZBEKISTAN</option>
                                    <option value="65">VENEZUELA</option>
                                    <option value="66">YEMEN</option>
                                    <option value="67">ZAMBIA</option>
                                    <option value="68">Philippines</option>
                                    <option value="69">Hy Lạp</option>
                                    <option value="70">Cộng hòa Litva</option>
                                    <option value="71">Ai-Len</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Cơ sở đào tạo:</label>
                            <div class="col-lg-9">
                                <input type="text" name="data[User][noidaotao_id]" class="form-control rounded"
                                       id="noidaotao_id" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Năm tốt nghiệp:</label>
                            <div class="col-lg-9">
                                <input type="number" name="data[User][namtotnghiep]" class="form-control rounded"
                                       id="namtotnghiep" value="">
                            </div>
                        </div>

                        <!--                   <div class="form-group row">-->
                        <!--                       <div class="col-9">-->
                        <!--                           <button type="button" class="btn btn-info bd-r4" data-toggle="modal" data-target="#modalTrinhdodaotao"><i class="fas fa-plus"></i></button>-->
                        <!--                           <span>Bổ sung Trình độ đào tạo</span>-->
                        <!--                       </div>-->
                        <!--                   </div>-->

                    </div>
                    <div class="group2 col-md-6">

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Chức danh hiện tại:</label>
                            <div class="col-lg-9">
                                <select name="data[User][hocham_id]" id="selectChucDanh"
                                        class="UserHochamId form-control rounded custom-select">
                                    <option value="">Chọn</option>
                                    <option value="2">Giáo sư</option>
                                    <option value="1">Phó Giáo sư</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Năm công nhận:</label>
                            <div class="col-lg-9">
                                <input type="number" name="data[User][namcongnhan]" class="form-control rounded"
                                       id="namcongnhan" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Danh hiệu nhà giáo:</label>
                            <div class="col-lg-9">
                                <select name="data[User][danhhieu_id]"
                                        class="UserDanhhieuId form-control rounded custom-select">
                                    <option value="">Chọn</option>
                                    <option value="1">Anh hùng Lao động</option>
                                    <option value="3">Anh hùng Lực lượng vũ trang</option>
                                    <option value="4">Nhà giáo Nhân dân</option>
                                    <option value="5">Nhà giáo Ưu tú</option>
                                    <option value="8">Thầy thuốc nhân dân</option>
                                    <option value="9">Thầy thuốc ưu tú</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Năm công nhận:</label>
                            <div class="col-lg-9">
                                <input type="number" name="data[User][namcongnhannhagiao]" class="form-control rounded"
                                       id="namcongnhannhagiao" value="">
                            </div>
                        </div>
                        <!--               <div class="form-group row">-->
                        <!--                   <div class="col-9">-->
                        <!--                       <button type="button" class="btn btn-info bd-r4" data-toggle="modal" data-target="#modalHocHam"><i class="fas fa-plus"></i></button>-->
                        <!--                       <span>Bổ sung chức danh</span>-->
                        <!--                   </div>-->
                        <!--               </div>-->

                    </div>
                </div>
            </div>
        </div>
        <!-- Trình độ lý luận CT/ Ngoại ngữ - Tin học - Quản lý NN - Quản lý GD -->
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Trình độ lý luận CT/ Ngoại ngữ - Tin học - Quản lý NN - Quản lý GD</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ lý luận chính
                                trị:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trinhdochinhtri_id]"
                                        class="UserTrinhdochinhtriId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="3">Cao cấp</option>
                                    <option value="1">Sơ cấp</option>
                                    <option value="2">Trung cấp</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngoại ngữ thành thạo
                                nhất:</label>
                            <div class="col-lg-9">
                                <select name="data[User][ngoaingu_id]"
                                        class="UserNgoainguId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="22">Tiếng A rập</option>
                                    <option value="19">Tiếng ấn Độ</option>
                                    <option value="21">Tiếng Ytalia</option>
                                    <option value="15">Tiếng An Ba Ni</option>
                                    <option value="1">Tiếng Anh</option>
                                    <option value="13">Tiếng Ba Lan</option>
                                    <option value="11">Tiếng Bồ Đào Nha</option>
                                    <option value="10">Tiếng Bungaria</option>
                                    <option value="7">Tiếng Cam Pu Chia</option>
                                    <option value="16">Tiếng Hàn Quốc</option>
                                    <option value="20">Tiếng Hungaria</option>
                                    <option value="6">Tiếng Lào</option>
                                    <option value="3">Tiếng Nga</option>
                                    <option value="5">Tiếng Nhật</option>
                                    <option value="2">Tiếng Pháp</option>
                                    <option value="18">Tiếng Phi Lip Pin</option>
                                    <option value="17">Tiếng Singapore</option>
                                    <option value="14">Tiếng Tây Ban Nha</option>
                                    <option value="8">Tiếng Thái Lan</option>
                                    <option value="23">Tiếng Thổ Nhĩ Kỳ</option>
                                    <option value="12">Tiếng Tiệp Khắc</option>
                                    <option value="4">Tiếng Trung</option>
                                    <option value="9">Tiếng Đức</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ ngoại ngữ
                                khác:</label>
                            <div class="col-lg-9">
                                <div class="SumoSelect sumo_trinhdongoaingukhac" tabindex="0" role="button"
                                     aria-expanded="false"><select name="trinhdongoaingukhac[]"
                                                                   class="UserTrinhdongoaingukhac form-control custom-select rounded SumoUnder"
                                                                   multiple="" tabindex="-1">
                                        <option value="An ba ni A">An ba ni A</option>
                                        <option value="An ba ni B">An ba ni B</option>
                                        <option value="An ba ni C">An ba ni C</option>
                                        <option value="An ba ni D">An ba ni D</option>
                                        <option value="An ba ni S">An ba ni S</option>
                                        <option value="Anh A">Anh A</option>
                                        <option value="Anh B">Anh B</option>
                                        <option value="Anh C">Anh C</option>
                                        <option value="Anh D">Anh D</option>
                                        <option value="Anh S">Anh S</option>
                                        <option value="Ba Lan A">Ba Lan A</option>
                                        <option value="Ba Lan B">Ba Lan B</option>
                                        <option value="Ba Lan C">Ba Lan C</option>
                                        <option value="Ba Lan D">Ba Lan D</option>
                                        <option value="Ba Lan S">Ba Lan S</option>
                                        <option value="Bồ Đào Nha A">Bồ Đào Nha A</option>
                                        <option value="Bồ Đào Nha B">Bồ Đào Nha B</option>
                                        <option value="Bồ Đào Nha C">Bồ Đào Nha C</option>
                                        <option value="Bồ Đào Nha D">Bồ Đào Nha D</option>
                                        <option value="Bồ Đào Nha S">Bồ Đào Nha S</option>
                                        <option value="Bungaria A">Bungaria A</option>
                                        <option value="Bungaria B">Bungaria B</option>
                                        <option value="Bungaria C">Bungaria C</option>
                                        <option value="Bungaria D">Bungaria D</option>
                                        <option value="Bungaria S">Bungaria S</option>
                                        <option value="Hung ga ri A">Hung ga ri A</option>
                                        <option value="Hung ga ri B">Hung ga ri B</option>
                                        <option value="Hung ga ri C">Hung ga ri C</option>
                                        <option value="Hung ga ri D">Hung ga ri D</option>
                                        <option value="Hung ga ri S">Hung ga ri S</option>
                                        <option value="IELTS">IELTS</option>
                                        <option value="IELTS 4.5">IELTS 4.5</option>
                                        <option value="IELTS 5.0">IELTS 5.0</option>
                                        <option value="IELTS 5.5">IELTS 5.5</option>
                                        <option value="IELTS 6.0">IELTS 6.0</option>
                                        <option value="IELTS 6.5">IELTS 6.5</option>
                                        <option value="IELTS 7.0">IELTS 7.0</option>
                                        <option value="IELTS 7.5">IELTS 7.5</option>
                                        <option value="IELTS 8.0">IELTS 8.0</option>
                                        <option value="IELTS 8.5">IELTS 8.5</option>
                                        <option value="Lào A">Lào A</option>
                                        <option value="Lào B">Lào B</option>
                                        <option value="Lào C">Lào C</option>
                                        <option value="Lào D">Lào D</option>
                                        <option value="Lào S">Lào S</option>
                                        <option value="Nga A">Nga A</option>
                                        <option value="Nga B">Nga B</option>
                                        <option value="Nga C">Nga C</option>
                                        <option value="Nga D">Nga D</option>
                                        <option value="Nga S">Nga S</option>
                                        <option value="Nhật A">Nhật A</option>
                                        <option value="Nhật B">Nhật B</option>
                                        <option value="Nhật C">Nhật C</option>
                                        <option value="Nhật D">Nhật D</option>
                                        <option value="Nhật S">Nhật S</option>
                                        <option value="Pháp A">Pháp A</option>
                                        <option value="Pháp B">Pháp B</option>
                                        <option value="Pháp C">Pháp C</option>
                                        <option value="Pháp D">Pháp D</option>
                                        <option value="Pháp S">Pháp S</option>
                                        <option value="Tây ban nha A">Tây ban nha A</option>
                                        <option value="Tây ban nha B">Tây ban nha B</option>
                                        <option value="Tây ban nha C">Tây ban nha C</option>
                                        <option value="Tây ban nha D">Tây ban nha D</option>
                                        <option value="Tây ban nha S">Tây ban nha S</option>
                                        <option value="Tiệp A">Tiệp A</option>
                                        <option value="Tiệp B">Tiệp B</option>
                                        <option value="Tiệp C">Tiệp C</option>
                                        <option value="Tiệp D">Tiệp D</option>
                                        <option value="Tiệp S">Tiệp S</option>
                                        <option value="TOEFL">TOEFL</option>
                                        <option value="Trung A">Trung A</option>
                                        <option value="Trung B">Trung B</option>
                                        <option value="Trung C">Trung C</option>
                                        <option value="Trung D">Trung D</option>
                                        <option value="Trung S">Trung S</option>
                                        <option value="TĐ An ba ni D">TĐ An ba ni D</option>
                                        <option value="TĐ Anh D">TĐ Anh D</option>
                                        <option value="TĐ Ba Lan D">TĐ Ba Lan D</option>
                                        <option value="TĐ Bồ Đào Nha D">TĐ Bồ Đào Nha D</option>
                                        <option value="TĐ Bungaria D">TĐ Bungaria D</option>
                                        <option value="TĐ Hung ga ri D">TĐ Hung ga ri D</option>
                                        <option value="TĐ Lào D">TĐ Lào D</option>
                                        <option value="TĐ Nga D">TĐ Nga D</option>
                                        <option value="TĐ Nhật D">TĐ Nhật D</option>
                                        <option value="TĐ Pháp D">TĐ Pháp D</option>
                                        <option value="TĐ Tây ban nha D">TĐ Tây ban nha D</option>
                                        <option value="TĐ Tiệp D">TĐ Tiệp D</option>
                                        <option value="TĐ Trung D">TĐ Trung D</option>
                                        <option value="TĐ Đức D">TĐ Đức D</option>
                                        <option value="Đức A">Đức A</option>
                                        <option value="Đức B">Đức B</option>
                                        <option value="Đức C">Đức C</option>
                                        <option value="Đức D">Đức D</option>
                                        <option value="Đức S">Đức S</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ ngoại ngữ:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trinhdongoaingu_id]"
                                        class="UserTrinhdotinhocId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="23">B1-Châu Âu</option>
                                    <option value="24">B2-Châu Âu</option>
                                    <option value="49">B3-Châu Âu</option>
                                    <option value="50">B4-Châu Âu</option>
                                    <option value="51">B5-Châu Âu</option>
                                    <option value="52">B6-Châu Âu</option>
                                    <option value="7">Cao đẳng</option>
                                    <option value="35">Cấp độ A1 (DELF Prim, DELF Junior/Scolaire, DELF Tous Publics và
                                        DELF Pro)
                                    </option>
                                    <option value="34">Cấp độ A1.1 (DILF et DELF Prim)</option>
                                    <option value="36">Cấp độ A2 (DELF Prim, DELF Junior/Scolaire, DELF Tous Publics và
                                        DELF Pro)
                                    </option>
                                    <option value="37">Cấp độ B1 (DELF Junior/Scolaire, DELF Tous Publics và DELF Pro)
                                    </option>
                                    <option value="38">Cấp độ B2 (DELF Junior/Scolaire, DELF Tous Publics và DELF Pro)
                                    </option>
                                    <option value="39">Cấp độ C1 (DALF)</option>
                                    <option value="40">Cấp độ C2 (DALF)</option>
                                    <option value="46">HSK 1 – HSK 2: Trình độ sơ cấp thấp tiếng Trung</option>
                                    <option value="47">HSK 3 – HSK 4: Trình độ sơ cấp trung tiếng Trung</option>
                                    <option value="48">HSK 5 – HSK 6: Cao cấp tiếng Trung</option>
                                    <option value="20">IELTS</option>
                                    <option value="25">IELTS 4.5</option>
                                    <option value="26">IELTS 5.0</option>
                                    <option value="27">IELTS 5.5</option>
                                    <option value="28">IELTS 6.0</option>
                                    <option value="29">IELTS 6.5</option>
                                    <option value="30">IELTS 7.0</option>
                                    <option value="31">IELTS 7.5</option>
                                    <option value="32">IELTS 8.0</option>
                                    <option value="33">IELTS 8.5</option>
                                    <option value="41">N1-tiếng Nhật</option>
                                    <option value="42">N2-tiếng Nhật</option>
                                    <option value="43">N3-tiếng Nhật</option>
                                    <option value="44">N4-tiếng Nhật</option>
                                    <option value="45">N5-tiếng Nhật</option>
                                    <option value="12">Sau đại học</option>
                                    <option value="13">Thạc sỹ</option>
                                    <option value="14">Tiến sỹ</option>
                                    <option value="21">TOEFL</option>
                                    <option value="22">TOEIC</option>
                                    <option value="1">Trình độ A</option>
                                    <option value="2">Trình độ B</option>
                                    <option value="3">Trình độ C</option>
                                    <option value="11">Trình độ D</option>
                                    <option value="5">Trình độ S</option>
                                    <option value="6">Trung cấp</option>
                                    <option value="10">Đại học</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Mô tả trình độ ngoại
                                ngữ:</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="5"
                                          name="data[User][motatrinhdongoaingu]"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ tin học:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trinhdotinhoc_id]"
                                        class="UserTrinhdotinhocId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="11">Cao đẳng</option>
                                    <option value="26">Chuẩn kỹ năng CNTT cơ bản</option>
                                    <option value="27">Chuẩn kỹ năng CNTT nâng cao</option>
                                    <option value="20">Đại học</option>
                                    <option value="7">Kỹ thuật viên</option>
                                    <option value="3">Lập trình cơ bản</option>
                                    <option value="10">Lập trình viên</option>
                                    <option value="21">Sau đại học</option>
                                    <option value="1">Soạn thảo văn bản</option>
                                    <option value="2">Sử dụng mạng</option>
                                    <option value="22">Thạc sỹ</option>
                                    <option value="23">Tiến sỹ</option>
                                    <option value="24">Tiến sỹ Khoa học</option>
                                    <option value="25">Tin học cơ bản</option>
                                    <option value="8">Tin học VP</option>
                                    <option value="4">Trình độ A</option>
                                    <option value="5">Trình độ B</option>
                                    <option value="6">Trình độ C</option>
                                    <option value="9">Trung cấp</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ quản lý nhà
                                nước:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trinhdoqlnhanuoc_id]"
                                        class="UserDanhhieuId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="6">Chuyên viên</option>
                                    <option value="8">Chuyên viên cao cấp</option>
                                    <option value="7">Chuyên viên chính</option>
                                    <option value="1">Cử nhân hành chính</option>
                                    <option value="11">Giảng viên cao cấp</option>
                                    <option value="10">Giảng viên chính</option>
                                    <option value="9">Nghiệp vụ sư phạm</option>
                                    <option value="5">QLHC Doanh nghiệp</option>
                                    <option value="4">QLHC Văn phòng</option>
                                    <option value="2">Thạc sỹ QLHCNN</option>
                                    <option value="3">Trung cấp hành chính</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ quản lý giáo
                                dục:</label>
                            <div class="col-lg-9">
                                <select name="data[User][trinhdoqlgiaoduc_id]"
                                        class="UserTrinhdochinhtriId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="3">CBQL các Khoa, Phòng, Ban trường ĐH</option>
                                    <option value="7">CBQL các trường Mầm non</option>
                                    <option value="8">CBQL các trường PTDT nội trú</option>
                                    <option value="6">CBQL các trường TH và THCS</option>
                                    <option value="5">CBQL các trường THPT</option>
                                    <option value="1">Chứng chỉ Nghiệp vụ sư phạm</option>
                                    <option value="4">Chứng chỉ Quản lý giáo dục</option>
                                    <option value="2">Chứng chỉ Triết học sau Đại học</option>
                                    <option value="11">Cử nhân QLGD</option>
                                    <option value="9">Nữ CBQL trường ĐH, CĐ</option>
                                    <option value="10">Thạc sỹ QLGD</option>
                                    <option value="12">Tiến sỹ QLGD</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection