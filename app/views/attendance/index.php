<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Quản lý Chấm công</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <?php if ($canCreate): ?>
                    <a href="<?= BASE_URL ?>attendance/add" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Thêm chấm công
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="<?= BASE_URL ?>attendance" class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Tháng</label>
                        <select name="thang" class="form-select">
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?= $i ?>" <?= $thang == $i ? 'selected' : '' ?>>Tháng <?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Năm</label>
                        <select name="nam" class="form-select">
                            <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                                <option value="<?= $y ?>" <?= $nam == $y ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nhân viên</label>
                        <select name="nhan_vien_id" class="form-select">
                            <option value="">-- Tất cả nhân viên --</option>
                            <?php foreach ($employees as $emp): ?>
                                <option value="<?= $emp['id'] ?>" <?= $nhan_vien_id == $emp['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($emp['ma_nhan_vien']) ?> - <?= htmlspecialchars($emp['ho_ten']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block">
                            <i class="ti ti-search"></i> Tìm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chấm công tháng <?= $thang ?>/<?= $nam ?></h3>
                <div class="ms-auto text-muted"><?= $pagination->renderInfo() ?></div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>Mã NV</th>
                            <th>Họ tên</th>
                            <th>Phòng ban</th>
                            <th>Ngày công</th>
                            <th>Nghỉ phép</th>
                            <th>Nghỉ không phép</th>
                            <th>Đi trễ/Về sớm</th>
                            <th>Ghi chú</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($attendances)): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="ti ti-calendar-off" style="font-size: 48px;"></i>
                                    <div class="mt-2">Chưa có dữ liệu chấm công</div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($attendances as $att): ?>
                                <tr>
                                    <td><span class="badge bg-azure-lt"><?= htmlspecialchars($att['ma_nhan_vien']) ?></span></td>
                                    <td>
                                        <div class="fw-bold"><?= htmlspecialchars($att['ho_ten']) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($att['ten_chuc_danh'] ?? '') ?></div>
                                    </td>
                                    <td><?= htmlspecialchars($att['ten_phong_ban'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge bg-success"><?= $att['so_ngay_cong'] ?></span>
                                    </td>
                                    <td><?= $att['so_ngay_nghi_phep'] ?></td>
                                    <td>
                                        <?php if ($att['so_ngay_nghi_khong_phep'] > 0): ?>
                                            <span class="text-danger fw-bold"><?= $att['so_ngay_nghi_khong_phep'] ?></span>
                                        <?php else: ?>
                                            0
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $att['di_tre_ve_som'] ?? 0 ?></td>
                                    <td class="text-muted small"><?= htmlspecialchars($att['ghi_chu'] ?? '') ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if ($canEdit): ?>
                                                <a href="<?= BASE_URL ?>attendance/edit/<?= $att['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($canDelete): ?>
                                                <a href="<?= BASE_URL ?>attendance/delete/<?= $att['id'] ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Xóa bản ghi chấm công này?')">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($pagination->hasPages()): ?>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted"><?= $pagination->renderInfo() ?></p>
                    <div class="ms-auto">
                        <?= $pagination->render(BASE_URL . 'attendance', [
                            'thang' => $thang,
                            'nam' => $nam,
                            'nhan_vien_id' => $nhan_vien_id
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>