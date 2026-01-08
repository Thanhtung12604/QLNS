<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="text-muted mb-1">
                    <a href="<?= BASE_URL ?>attendance">Chấm công</a> / Chỉnh sửa
                </div>
                <h2 class="page-title">Chỉnh sửa chấm công</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="<?= BASE_URL ?>attendance/edit/<?= $attendance['id'] ?>">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin chấm công</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nhân viên</label>
                                <input type="text" class="form-control"
                                    value="<?= htmlspecialchars($employee['ma_nhan_vien']) ?> - <?= htmlspecialchars($employee['ho_ten']) ?>"
                                    disabled>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tháng</label>
                                    <input type="text" class="form-control" value="Tháng <?= $attendance['thang'] ?>/<?= $attendance['nam'] ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Số ngày công</label>
                                    <input type="number" name="so_ngay_cong" class="form-control"
                                        value="<?= $attendance['so_ngay_cong'] ?>" min="0" max="31" step="0.5" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nghỉ phép</label>
                                    <input type="number" name="so_ngay_nghi_phep" class="form-control"
                                        value="<?= $attendance['so_ngay_nghi_phep'] ?? 0 ?>" min="0" step="0.5">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nghỉ không phép</label>
                                    <input type="number" name="so_ngay_nghi_khong_phep" class="form-control"
                                        value="<?= $attendance['so_ngay_nghi_khong_phep'] ?? 0 ?>" min="0" step="0.5">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số lần đi trễ/về sớm</label>
                                <input type="number" name="di_tre_ve_som" class="form-control"
                                    value="<?= $attendance['di_tre_ve_som'] ?? 0 ?>" min="0">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ghi chú</label>
                                <textarea name="ghi_chu" class="form-control" rows="3"><?= htmlspecialchars($attendance['ghi_chu'] ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="<?= BASE_URL ?>attendance?thang=<?= $attendance['thang'] ?>&nam=<?= $attendance['nam'] ?>" class="btn">
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