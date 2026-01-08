<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Quản lý bảng lương</h3>
        <div class="d-flex gap-2 align-items-center">
            <form method="get" class="d-flex gap-2">
                <select name="thang" class="form-select form-select-sm">
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?= $m ?>" <?= $m == $thang ? 'selected' : '' ?>>
                            Tháng <?= $m ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <select name="nam" class="form-select form-select-sm">
                    <?php for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++): ?>
                        <option value="<?= $y ?>" <?= $y == $nam ? 'selected' : '' ?>>
                            <?= $y ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="ti ti-search"></i> Xem
                </button>
            </form>

            <?php if (Auth::hasPermission('salary.manage')): ?>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#calculateModal">
                    <i class="ti ti-calculator"></i> Tính lương
                </button>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($salaries)): ?>
            <div class="alert alert-warning">
                <i class="ti ti-alert-triangle me-2"></i>
                Chưa có bảng lương tháng <?= $thang ?>/<?= $nam ?>. Vui lòng tính lương trước.
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
                            <th class="text-end">Lương CB</th>
                            <th class="text-end">Phụ cấp</th>
                            <th class="text-end">Tổng lương</th>
                            <th class="text-end">BHXH</th>
                            <th class="text-end">BHYT</th>
                            <th class="text-end">BHTN</th>
                            <th class="text-end">Giảm trừ BT</th>
                            <th class="text-end">Giảm trừ PT</th>
                            <th class="text-end">TNCN chịu thuế</th>
                            <th class="text-end">Thuế TNCN</th>
                            <th class="text-end">Thực lĩnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salaries as $index => $salary): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><strong><?= htmlspecialchars($salary['ma_nhan_vien']) ?></strong></td>
                                <td><?= htmlspecialchars($salary['ho_ten']) ?></td>
                                <td><?= htmlspecialchars($salary['ten_phong_ban'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($salary['ten_chuc_danh'] ?? 'N/A') ?></td>
                                <td class="text-end"><?= number_format($salary['luong_co_ban']) ?></td>
                                <td class="text-end"><?= number_format($salary['phu_cap']) ?></td>
                                <td class="text-end"><strong><?= number_format($salary['tong_luong']) ?></strong></td>
                                <td class="text-end"><?= number_format($salary['bhxh']) ?></td>
                                <td class="text-end"><?= number_format($salary['bhyt']) ?></td>
                                <td class="text-end"><?= number_format($salary['bhtn']) ?></td>
                                <td class="text-end"><?= number_format($salary['giam_tru_ban_than'] ?? 15500000) ?></td>
                                <td class="text-end"><?= number_format($salary['giam_tru_phu_thuoc'] ?? 0) ?></td>
                                <td class="text-end"><?= number_format($salary['thu_nhap_chiu_thue'] ?? 0) ?></td>
                                <td class="text-end text-danger"><?= number_format($salary['thue_tncn']) ?></td>
                                <td class="text-end">
                                    <strong class="text-success"><?= number_format($salary['thuc_linh']) ?></strong>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-active">
                            <td colspan="7" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td class="text-end"><strong><?= number_format($total['tong_luong'] ?? 0) ?></strong></td>
                            <td class="text-end"><strong><?= number_format($total['bhxh'] ?? 0) ?></strong></td>
                            <td class="text-end"><strong><?= number_format($total['bhyt'] ?? 0) ?></strong></td>
                            <td class="text-end"><strong><?= number_format($total['bhtn'] ?? 0) ?></strong></td>
                            <td colspan="3"></td>
                            <td class="text-end"><strong class="text-danger"><?= number_format($total['thue_tncn'] ?? 0) ?></strong></td>
                            <td class="text-end"><strong class="text-success"><?= number_format($total['thuc_linh'] ?? 0) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Tính lương -->
<div class="modal modal-blur fade" id="calculateModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tính lương tháng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="<?= BASE_URL ?>salary/calculate">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tháng</label>
                        <select name="thang" class="form-select" required>
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?= $m ?>" <?= $m == $thang ? 'selected' : '' ?>>
                                    Tháng <?= $m ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Năm</label>
                        <select name="nam" class="form-select" required>
                            <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                                <option value="<?= $y ?>" <?= $y == $nam ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="alert alert-info mb-0">
                        <i class="ti ti-info-circle me-2"></i>
                        Hệ thống sẽ tính lương cho tất cả nhân viên theo công thức Việt Nam 2026 (giảm trừ bản thân 15.5M, người phụ thuộc 5.5M/người).
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-calculator"></i> Tính lương
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>