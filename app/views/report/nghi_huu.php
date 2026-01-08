<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách nhân viên đến tuổi nghỉ hưu</h3>
    </div>
    <div class="card-body">
        <?php if (empty($employees)): ?>
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                Không có nhân viên nào đến tuổi nghỉ hưu (Nam: 60 tuổi, Nữ: 55 tuổi).
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-vcenter table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã NV</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Tuổi</th>
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
                                <td>
                                    <?php if ($emp['gioi_tinh'] == 'Nam'): ?>
                                        <span class="badge bg-blue">Nam</span>
                                    <?php else: ?>
                                        <span class="badge bg-pink">Nữ</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($emp['ngay_sinh'])) ?></td>
                                <td>
                                    <span class="badge bg-danger">
                                        <?= $emp['tuoi'] ?> tuổi
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