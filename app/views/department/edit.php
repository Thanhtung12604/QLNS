<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="text-muted mb-1">
                    <a href="<?= BASE_URL ?>department">Phòng ban</a> / Chỉnh sửa
                </div>
                <h2 class="page-title">Chỉnh sửa phòng ban</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="<?= BASE_URL ?>department/edit/<?= $department['id'] ?>">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin phòng ban</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Mã phòng ban</label>
                                <input type="text" name="ma_phong_ban" class="form-control" value="<?= htmlspecialchars($department['ma_phong_ban']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Tên phòng ban</label>
                                <input type="text" name="ten_phong_ban" class="form-control" value="<?= htmlspecialchars($department['ten_phong_ban']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($department['mo_ta'] ?? '') ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ngày thành lập</label>
                                    <input type="date" name="ngay_thanh_lap" class="form-control" value="<?= $department['ngay_thanh_lap'] ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="trang_thai" class="form-select">
                                        <option value="active" <?= $department['trang_thai'] === 'active' ? 'selected' : '' ?>>Hoạt động</option>
                                        <option value="inactive" <?= $department['trang_thai'] === 'inactive' ? 'selected' : '' ?>>Ngừng hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="<?= BASE_URL ?>department" class="btn">
                                <i class="ti ti-x"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Cập nhật
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>