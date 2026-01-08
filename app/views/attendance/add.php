<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="text-muted mb-1">
                    <a href="<?= BASE_URL ?>attendance">Chấm công</a> / Thêm mới
                </div>
                <h2 class="page-title">Thêm chấm công</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="<?= BASE_URL ?>attendance/add">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin chấm công</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Nhân viên</label>
                                <select name="nhan_vien_id" class="form-select" required>
                                    <option value="">-- Chọn nhân viên --</option>
                                    <?php foreach ($employees as $emp): ?>
                                        <option value="<?= $emp['id'] ?>">
                                            <?= htmlspecialchars($emp['ma_nhan_vien']) ?> - <?= htmlspecialchars($emp['ho_ten']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Tháng</label>
                                    <select name="thang" class="form-select" required>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?= $i ?>" <?= date('m') == $i ? 'selected' : '' ?>>Tháng <?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Năm</label>
                                    <select name="nam" class="form-select" required>
                                        <?php for ($y = date('Y'); $y >= date('Y') - 2; $y--): ?>
                                            <option value="<?= $y ?>"><?= $y ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Số ngày công</label>
                                    <input type="number" name="so_ngay_cong" class="form-control" min="0" max="31" step="0.5" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nghỉ phép</label>
                                    <input type="number" name="so_ngay_nghi_phep" class="form-control" min="0" value="0" step="0.5">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nghỉ không phép</label>
                                    <input type="number" name="so_ngay_nghi_khong_phep" class="form-control" min="0" value="0" step="0.5">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Số lần đi trễ/về sớm</label>
                                    <input type="number" name="di_tre_ve_som" class="form-control" min="0" value="0">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ghi chú</label>
                                <textarea name="ghi_chu" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="<?= BASE_URL ?>attendance" class="btn">
                                <i class="ti ti-x"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Lưu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>