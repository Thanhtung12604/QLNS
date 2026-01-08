<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="text-muted mb-1">
                    <a href="<?= BASE_URL ?>position">Chức danh</a> / Chỉnh sửa
                </div>
                <h2 class="page-title">Chỉnh sửa chức danh</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="<?= BASE_URL ?>position/edit/<?= $position['id'] ?>">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin chức danh</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Mã chức danh</label>
                                <input type="text" name="ma_chuc_danh" class="form-control" value="<?= htmlspecialchars($position['ma_chuc_danh']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Tên chức danh</label>
                                <input type="text" name="ten_chuc_danh" class="form-control" value="<?= htmlspecialchars($position['ten_chuc_danh']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($position['mo_ta'] ?? '') ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mức lương cơ bản (VNĐ)</label>
                                <input type="number" name="muc_luong_co_ban" class="form-control" step="100000" value="<?= $position['muc_luong_co_ban'] ?>">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="<?= BASE_URL ?>position" class="btn">
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