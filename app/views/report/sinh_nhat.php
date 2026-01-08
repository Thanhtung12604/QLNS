<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Danh sách sinh nhật tháng <?= $thang ?>/<?= $nam ?></h3>
        <div>
            <form method="get" class="d-flex gap-2">
                <select name="thang" class="form-select form-select-sm">
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?= $m ?>" <?= $m == $thang ? 'selected' : '' ?>>
                            Tháng <?= $m ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <select name="nam" class="form-select form-select-sm">
                    <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                        <option value="<?= $y ?>" <?= $y == $nam ? 'selected' : '' ?>>
                            <?= $y ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="ti ti-search"></i> Xem
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($employees)): ?>
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                Không có nhân viên nào có sinh nhật trong tháng <?= $thang ?>/<?= $nam ?>.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-vcenter table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã NV</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Ngày sinh nhật</th>
                            <th>Phòng ban</th>
                            <th>Chức danh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $index => $emp): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><strong><?= htmlspecialchars($emp['ma_nhan_vien']) ?></strong></td>
                                <td><?= htmlspecialchars($emp['ho_ten']) ?></td>
                                <td><?= date('d/m/Y', strtotime($emp['ngay_sinh'])) ?></td>
                                <td>
                                    <span class="badge bg-success">
                                        <?= $emp['ngay_sinh_nhat'] ?>/<?= $thang ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($emp['ten_phong_ban'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($emp['ten_chuc_danh'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>