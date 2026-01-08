<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="d-flex mb-3">
    <div class="text-muted">
        <a href="<?= BASE_URL ?>employee" class="text-muted">Nhân viên</a> / Chỉnh sửa
    </div>
</div>

<form method="POST" action="<?= BASE_URL ?>employee/edit/<?= $employee['id'] ?>">
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
                            <input type="text" name="ma_nhan_vien" class="form-control" value="<?= htmlspecialchars($employee['ma_nhan_vien']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">Họ và tên</label>
                            <input type="text" name="ho_ten" class="form-control" value="<?= htmlspecialchars($employee['ho_ten']) ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label required">Ngày sinh</label>
                            <input type="date" name="ngay_sinh" class="form-control" value="<?= $employee['ngay_sinh'] ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Giới tính</label>
                            <select name="gioi_tinh" class="form-select" required>
                                <option value="Nam" <?= $employee['gioi_tinh'] === 'Nam' ? 'selected' : '' ?>>Nam</option>
                                <option value="Nữ" <?= $employee['gioi_tinh'] === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                                <option value="Khác" <?= $employee['gioi_tinh'] === 'Khác' ? 'selected' : '' ?>>Khác</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dân tộc</label>
                            <input type="text" name="dan_toc" class="form-control" value="<?= htmlspecialchars($employee['dan_toc'] ?? 'Kinh') ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">Số CMND/CCCD</label>
                            <input type="text" name="so_cmnd" class="form-control" value="<?= htmlspecialchars($employee['so_cmnd']) ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ngày cấp</label>
                            <input type="date" name="ngay_cap_cmnd" class="form-control" value="<?= $employee['ngay_cap_cmnd'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nơi cấp</label>
                            <input type="text" name="noi_cap_cmnd" class="form-control" value="<?= htmlspecialchars($employee['noi_cap_cmnd'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employee['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" class="form-control" value="<?= htmlspecialchars($employee['so_dien_thoai'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Tôn giáo</label>
                            <input type="text" name="ton_giao" class="form-control" value="<?= htmlspecialchars($employee['ton_giao'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tình trạng hôn nhân</label>
                            <select name="tinh_trang_hon_nhan" class="form-select">
                                <option value="doc_than" <?= $employee['tinh_trang_hon_nhan'] === 'doc_than' ? 'selected' : '' ?>>Độc thân</option>
                                <option value="da_ket_hon" <?= $employee['tinh_trang_hon_nhan'] === 'da_ket_hon' ? 'selected' : '' ?>>Đã kết hôn</option>
                                <option value="ly_hon" <?= $employee['tinh_trang_hon_nhan'] === 'ly_hon' ? 'selected' : '' ?>>Ly hôn</option>
                                <option value="goa" <?= $employee['tinh_trang_hon_nhan'] === 'goa' ? 'selected' : '' ?>>Góa</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Số con</label>
                            <input type="number" name="so_con" class="form-control" value="<?= $employee['so_con'] ?? 0 ?>" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ hiện tại</label>
                        <textarea name="dia_chi_hien_tai" class="form-control" rows="2"><?= htmlspecialchars($employee['dia_chi_hien_tai'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ thường trú</label>
                        <textarea name="dia_chi_thuong_tru" class="form-control" rows="2"><?= htmlspecialchars($employee['dia_chi_thuong_tru'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hộ khẩu thường trú</label>
                        <textarea name="ho_khau_thuong_tru" class="form-control" rows="2"><?= htmlspecialchars($employee['ho_khau_thuong_tru'] ?? '') ?></textarea>
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
                                <option value="Trung học" <?= ($employee['trinh_do_hoc_van'] ?? '') === 'Trung học' ? 'selected' : '' ?>>Trung học</option>
                                <option value="Trung cấp" <?= ($employee['trinh_do_hoc_van'] ?? '') === 'Trung cấp' ? 'selected' : '' ?>>Trung cấp</option>
                                <option value="Cao đẳng" <?= ($employee['trinh_do_hoc_van'] ?? '') === 'Cao đẳng' ? 'selected' : '' ?>>Cao đẳng</option>
                                <option value="Đại học" <?= ($employee['trinh_do_hoc_van'] ?? '') === 'Đại học' ? 'selected' : '' ?>>Đại học</option>
                                <option value="Thạc sĩ" <?= ($employee['trinh_do_hoc_van'] ?? '') === 'Thạc sĩ' ? 'selected' : '' ?>>Thạc sĩ</option>
                                <option value="Tiến sĩ" <?= ($employee['trinh_do_hoc_van'] ?? '') === 'Tiến sĩ' ? 'selected' : '' ?>>Tiến sĩ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trình độ chuyên môn</label>
                            <input type="text" name="trinh_do_chuyen_mon" class="form-control" value="<?= htmlspecialchars($employee['trinh_do_chuyen_mon'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Chuyên ngành</label>
                            <input type="text" name="chuyen_nganh" class="form-control" value="<?= htmlspecialchars($employee['chuyen_nganh'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tin học</label>
                            <input type="text" name="tin_hoc" class="form-control" value="<?= htmlspecialchars($employee['tin_hoc'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bằng cấp</label>
                        <textarea name="bang_cap" class="form-control" rows="2"><?= htmlspecialchars($employee['bang_cap'] ?? '') ?></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Trình độ ngoại ngữ</label>
                            <input type="text" name="trinh_do_ngoai_ngu" class="form-control" value="<?= htmlspecialchars($employee['trinh_do_ngoai_ngu'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Chứng chỉ ngoại ngữ</label>
                            <textarea name="chung_chi_ngoai_ngu" class="form-control" rows="1"><?= htmlspecialchars($employee['chung_chi_ngoai_ngu'] ?? '') ?></textarea>
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
                            <input type="date" name="ngay_vao_doan" class="form-control" value="<?= $employee['ngay_vao_doan'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ngày vào Đảng</label>
                            <input type="date" name="ngay_vao_dang" class="form-control" id="ngay_vao_dang" value="<?= $employee['ngay_vao_dang'] ?>">
                        </div>
                        <div class="col-md-4">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="la_dang_vien" id="la_dang_vien" <?= $employee['la_dang_vien'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="la_dang_vien">Là Đảng viên</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diện chính sách</label>
                        <input type="text" name="dien_chinh_sach" class="form-control" value="<?= htmlspecialchars($employee['dien_chinh_sach'] ?? '') ?>">
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
                        <?php if (!empty($family)): ?>
                            <?php foreach ($family as $member): ?>
                                <div class="row family-item mb-2">
                                    <div class="col-md-2">
                                        <select name="family_relation[]" class="form-select form-select-sm">
                                            <option value="">Quan hệ</option>
                                            <option value="cha" <?= $member['quan_he'] === 'cha' ? 'selected' : '' ?>>Cha</option>
                                            <option value="me" <?= $member['quan_he'] === 'me' ? 'selected' : '' ?>>Mẹ</option>
                                            <option value="vo" <?= $member['quan_he'] === 'vo' ? 'selected' : '' ?>>Vợ</option>
                                            <option value="chong" <?= $member['quan_he'] === 'chong' ? 'selected' : '' ?>>Chồng</option>
                                            <option value="con" <?= $member['quan_he'] === 'con' ? 'selected' : '' ?>>Con</option>
                                            <option value="anh_trai" <?= $member['quan_he'] === 'anh_trai' ? 'selected' : '' ?>>Anh trai</option>
                                            <option value="chi_gai" <?= $member['quan_he'] === 'chi_gai' ? 'selected' : '' ?>>Chị gái</option>
                                            <option value="em_trai" <?= $member['quan_he'] === 'em_trai' ? 'selected' : '' ?>>Em trai</option>
                                            <option value="em_gai" <?= $member['quan_he'] === 'em_gai' ? 'selected' : '' ?>>Em gái</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="family_name[]" class="form-control form-control-sm" value="<?= htmlspecialchars($member['ho_ten']) ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="family_year[]" class="form-control form-control-sm" value="<?= $member['nam_sinh'] ?>" min="1900">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="family_job[]" class="form-control form-control-sm" value="<?= htmlspecialchars($member['nghe_nghiep'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="family_phone[]" class="form-control form-control-sm" value="<?= htmlspecialchars($member['so_dien_thoai'] ?? '') ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
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
                        <?php endif; ?>
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
                        <label class="form-label">Loại nhân viên</label>
                        <input type="text" class="form-control" value="<?= $employee['loai_nhan_vien'] === 'bien_che' ? 'Biên chế' : 'Hợp đồng' ?>" disabled>
                        <small class="text-muted">Không thể thay đổi loại nhân viên</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phòng ban</label>
                        <select name="phong_ban_id" class="form-select">
                            <option value="">-- Chọn --</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= $employee['phong_ban_id'] == $dept['id'] ? 'selected' : '' ?>>
                                    <?= $dept['ten_phong_ban'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Chức danh</label>
                        <select name="chuc_danh_id" class="form-select">
                            <option value="">-- Chọn --</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?= $pos['id'] ?>" <?= $employee['chuc_danh_id'] == $pos['id'] ? 'selected' : '' ?>>
                                    <?= $pos['ten_chuc_danh'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if ($employee['loai_nhan_vien'] == 'bien_che'): ?>
                        <div class="mb-3">
                            <label class="form-label">Bậc lương</label>
                            <input type="number" name="bac_luong" class="form-control" value="<?= $employee['bac_luong'] ?>" min="1" max="20">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hệ số lương</label>
                            <input type="number" name="he_so_luong" class="form-control" value="<?= $employee['he_so_luong'] ?>" step="0.01" min="1">
                        </div>
                    <?php else: ?>
                        <div class="mb-3">
                            <label class="form-label">Mức lương hợp đồng</label>
                            <input type="number" name="muc_luong_hop_dong" class="form-control" value="<?= $employee['muc_luong_hop_dong'] ?>" step="1000">
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="dang_lam_viec" <?= $employee['trang_thai'] === 'dang_lam_viec' ? 'selected' : '' ?>>Đang làm việc</option>
                            <option value="nghi_viec" <?= $employee['trang_thai'] === 'nghi_viec' ? 'selected' : '' ?>>Nghỉ việc</option>
                            <option value="nghi_huu" <?= $employee['trang_thai'] === 'nghi_huu' ? 'selected' : '' ?>>Nghỉ hưu</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-footer text-end">
            <a href="<?= BASE_URL ?>employee/detail/<?= $employee['id'] ?>" class="btn">
                <i class="ti ti-x"></i> Hủy
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> Cập nhật
            </button>
        </div>
    </div>
</form>

<script>
    function addFamily() {
        const template = document.querySelector('.family-item').cloneNode(true);
        template.querySelectorAll('input, select').forEach(input => input.value = '');
        document.getElementById('family-list').appendChild(template);
    }
</script>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>