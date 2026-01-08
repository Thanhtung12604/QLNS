<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="d-flex mb-3">
    <div class="text-muted">
        <a href="<?= BASE_URL ?>employee" class="text-muted">Nhân viên</a> / Thêm mới
    </div>
</div>

<form method="POST" action="<?= BASE_URL ?>employee/add">
    <div class="row">
        <div class="col-md-8">
            <!-- Thông tin cá nhân -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title"><i class="ti ti-user me-2"></i>Thông tin cá nhân</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">Mã nhân viên</label>
                            <input type="text" name="ma_nhan_vien" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">Họ và tên</label>
                            <input type="text" name="ho_ten" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label required">Ngày sinh</label>
                            <input type="date" name="ngay_sinh" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Giới tính</label>
                            <select name="gioi_tinh" class="form-select" required>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dân tộc</label>
                            <input type="text" name="dan_toc" class="form-control" value="Kinh">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">Số CMND/CCCD</label>
                            <input type="text" name="so_cmnd" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ngày cấp</label>
                            <input type="date" name="ngay_cap_cmnd" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nơi cấp</label>
                            <input type="text" name="noi_cap_cmnd" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Tôn giáo</label>
                            <input type="text" name="ton_giao" class="form-control" placeholder="Không">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tình trạng hôn nhân</label>
                            <select name="tinh_trang_hon_nhan" class="form-select">
                                <option value="doc_than">Độc thân</option>
                                <option value="da_ket_hon">Đã kết hôn</option>
                                <option value="ly_hon">Ly hôn</option>
                                <option value="goa">Góa</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Số con</label>
                            <input type="number" name="so_con" class="form-control" value="0" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ hiện tại</label>
                        <textarea name="dia_chi_hien_tai" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ thường trú</label>
                        <textarea name="dia_chi_thuong_tru" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hộ khẩu thường trú</label>
                        <textarea name="ho_khau_thuong_tru" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <!-- Thông tin trình độ -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title"><i class="ti ti-school me-2"></i>Trình độ chuyên môn</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Trình độ học vấn</label>
                            <select name="trinh_do_hoc_van" class="form-select">
                                <option value="">-- Chọn --</option>
                                <option value="Trung học">Trung học</option>
                                <option value="Trung cấp">Trung cấp</option>
                                <option value="Cao đẳng">Cao đẳng</option>
                                <option value="Đại học">Đại học</option>
                                <option value="Thạc sĩ">Thạc sĩ</option>
                                <option value="Tiến sĩ">Tiến sĩ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trình độ chuyên môn</label>
                            <input type="text" name="trinh_do_chuyen_mon" class="form-control" placeholder="VD: Kỹ sư">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Chuyên ngành</label>
                            <input type="text" name="chuyen_nganh" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tin học</label>
                            <input type="text" name="tin_hoc" class="form-control" placeholder="VD: Tin học văn phòng">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bằng cấp</label>
                        <textarea name="bang_cap" class="form-control" rows="2"
                            placeholder="Liệt kê các bằng cấp, phân cách bằng dấu chấm phẩy (;)"></textarea>
                        <small class="form-hint">VD: Bằng Cử nhân Công nghệ thông tin; Chứng chỉ PMP</small>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Trình độ ngoại ngữ</label>
                            <input type="text" name="trinh_do_ngoai_ngu" class="form-control"
                                placeholder="VD: Tiếng Anh B1, Tiếng Trung HSK3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Chứng chỉ ngoại ngữ</label>
                            <textarea name="chung_chi_ngoai_ngu" class="form-control" rows="1"
                                placeholder="TOEIC 750, IELTS 6.5"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin chính trị - xã hội -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title"><i class="ti ti-flag me-2"></i>Thông tin chính trị - xã hội</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Ngày vào Đoàn</label>
                            <input type="date" name="ngay_vao_doan" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ngày vào Đảng</label>
                            <input type="date" name="ngay_vao_dang" class="form-control" id="ngay_vao_dang">
                        </div>
                        <div class="col-md-4">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="la_dang_vien" id="la_dang_vien">
                                <label class="form-check-label" for="la_dang_vien">
                                    Là Đảng viên
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diện chính sách</label>
                        <input type="text" name="dien_chinh_sach" class="form-control"
                            placeholder="VD: Con thương binh, Con liệt sĩ">
                    </div>
                </div>
            </div>

            <!-- Thông tin gia đình -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title"><i class="ti ti-users me-2"></i>Thông tin gia đình</h3>
                </div>
                <div class="card-body">
                    <div id="family-list">
                        <div class="row family-item mb-2">
                            <div class="col-md-2">
                                <select name="family_relation[]" class="form-select form-select-sm">
                                    <option value="">Quan hệ</option>
                                    <option value="cha">Cha</option>
                                    <option value="me">Mẹ</option>
                                    <option value="vo">Vợ</option>
                                    <option value="chong">Chồng</option>
                                    <option value="con">Con</option>
                                    <option value="anh_trai">Anh trai</option>
                                    <option value="chi_gai">Chị gái</option>
                                    <option value="em_trai">Em trai</option>
                                    <option value="em_gai">Em gái</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="family_name[]" class="form-control form-control-sm" placeholder="Họ tên">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="family_year[]" class="form-control form-control-sm" placeholder="Năm sinh" min="1900">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="family_job[]" class="form-control form-control-sm" placeholder="Nghề nghiệp">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="family_phone[]" class="form-control form-control-sm" placeholder="Số điện thoại">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFamily()">
                        <i class="ti ti-plus"></i> Thêm thành viên
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Thông tin công tác -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title"><i class="ti ti-briefcase me-2"></i>Thông tin công tác</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Loại nhân viên</label>
                        <select name="loai_nhan_vien" class="form-select" id="loai_nhan_vien" required>
                            <option value="bien_che">Biên chế</option>
                            <option value="hop_dong">Hợp đồng</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phòng ban</label>
                        <select name="phong_ban_id" class="form-select">
                            <option value="">-- Chọn --</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>"><?= $dept['ten_phong_ban'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Chức danh</label>
                        <select name="chuc_danh_id" class="form-select">
                            <option value="">-- Chọn --</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?= $pos['id'] ?>"><?= $pos['ten_chuc_danh'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Ngày vào làm</label>
                        <input type="date" name="ngay_vao_lam" class="form-control" required>
                    </div>

                    <div id="bien_che_fields">
                        <div class="mb-3">
                            <label class="form-label">Bậc lương</label>
                            <input type="number" name="bac_luong" class="form-control" min="1" max="20">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hệ số lương</label>
                            <input type="number" name="he_so_luong" class="form-control" step="0.01" min="1">
                        </div>
                    </div>

                    <div id="hop_dong_fields" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Mức lương hợp đồng</label>
                            <input type="number" name="muc_luong_hop_dong" class="form-control" step="1000">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-footer text-end">
            <a href="<?= BASE_URL ?>employee" class="btn">
                <i class="ti ti-x"></i> Hủy
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> Lưu
            </button>
        </div>
    </div>
</form>

<script>
    // Toggle loại nhân viên
    document.getElementById('loai_nhan_vien').addEventListener('change', function() {
        if (this.value === 'bien_che') {
            document.getElementById('bien_che_fields').style.display = 'block';
            document.getElementById('hop_dong_fields').style.display = 'none';
        } else {
            document.getElementById('bien_che_fields').style.display = 'none';
            document.getElementById('hop_dong_fields').style.display = 'block';
        }
    });

    // Toggle Đảng viên
    document.getElementById('la_dang_vien').addEventListener('change', function() {
        document.getElementById('ngay_vao_dang').disabled = !this.checked;
    });

    // Thêm thành viên gia đình
    function addFamily() {
        const template = document.querySelector('.family-item').cloneNode(true);
        template.querySelectorAll('input, select').forEach(input => input.value = '');
        document.getElementById('family-list').appendChild(template);
    }
</script>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>