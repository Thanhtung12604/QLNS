<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách nhân viên đến kỳ nâng lương</h3>
    </div>
    <div class="card-body">
        <?php if (empty($employees)): ?>
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                Không có nhân viên nào đến kỳ nâng lương (đủ 3 năm kể từ lần nâng lương gần nhất).
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-vcenter table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã NV</th>
                            <th>Họ tên</th>
                            <th>Phòng ban</th>
                            <th>Chức danh</th>
                            <th>Bậc lương hiện tại</th>
                            <th>Hệ số lương</th>
                            <th>Ngày nâng lương gần nhất</th>
                            <th>Số ngày đã qua</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $index => $emp): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><strong><?= htmlspecialchars($emp['ma_nhan_vien']) ?></strong></td>
                                <td><?= htmlspecialchars($emp['ho_ten']) ?></td>
                                <td><?= htmlspecialchars($emp['ten_phong_ban'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($emp['ten_chuc_danh'] ?? 'N/A') ?></td>
                                <td><?= $emp['bac_luong'] ?></td>
                                <td><?= number_format($emp['he_so_luong'], 2) ?></td>
                                <td><?= date('d/m/Y', strtotime($emp['ngay_nang_luong_gan_nhat'])) ?></td>
                                <td>
                                    <span class="badge bg-warning">
                                        <?= $emp['so_ngay'] ?> ngày
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>