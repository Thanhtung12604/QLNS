<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Quản lý Nhân viên</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <?php if (Auth::hasPermission('employee.create')): ?>
                    <a href="<?= BASE_URL ?>employee/add" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Thêm nhân viên
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <!-- Search Card -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="<?= BASE_URL ?>employee" class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Mã NV</label>
                        <input type="text" name="ma_nhan_vien" class="form-control"
                            value="<?= htmlspecialchars($_GET['ma_nhan_vien'] ?? '') ?>"
                            placeholder="Mã nhân viên">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="ho_ten" class="form-control"
                            value="<?= htmlspecialchars($_GET['ho_ten'] ?? '') ?>"
                            placeholder="Họ tên">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control"
                            value="<?= htmlspecialchars($_GET['email'] ?? '') ?>"
                            placeholder="Email">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">SĐT</label>
                        <input type="text" name="dien_thoai" class="form-control"
                            value="<?= htmlspecialchars($_GET['dien_thoai'] ?? '') ?>"
                            placeholder="Số điện thoại">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Phòng ban</label>
                        <select name="phong_ban_id" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= ($_GET['phong_ban_id'] ?? '') == $dept['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dept['ten_phong_ban']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Chức danh</label>
                        <select name="chuc_danh_id" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?= $pos['id'] ?>" <?= ($_GET['chuc_danh_id'] ?? '') == $pos['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pos['ten_chuc_danh']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Loại nhân viên</label>
                        <select name="loai_nhan_vien" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <option value="bien_che" <?= ($_GET['loai_nhan_vien'] ?? '') == 'bien_che' ? 'selected' : '' ?>>Biên chế</option>
                            <option value="hop_dong" <?= ($_GET['loai_nhan_vien'] ?? '') == 'hop_dong' ? 'selected' : '' ?>>Hợp đồng</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <option value="dang_lam" <?= ($_GET['trang_thai'] ?? '') == 'dang_lam' ? 'selected' : '' ?>>Đang làm</option>
                            <option value="nghi_viec" <?= ($_GET['trang_thai'] ?? '') == 'nghi_viec' ? 'selected' : '' ?>>Nghỉ việc</option>
                            <option value="nghi_huu" <?= ($_GET['trang_thai'] ?? '') == 'nghi_huu' ? 'selected' : '' ?>>Nghỉ hưu</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block">
                            <i class="ti ti-search"></i> Tìm
                        </button>
                    </div>
                    <div class="col-auto">
                        <label class="form-label">&nbsp;</label>
                        <a href="<?= BASE_URL ?>employee" class="btn btn-outline-secondary d-block">
                            <i class="ti ti-refresh"></i> Làm mới
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách nhân viên</h3>
                <div class="ms-auto text-muted"><?= $pagination->renderInfo() ?></div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã NV</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Phòng ban</th>
                            <th>Chức danh</th>
                            <th>Loại NV</th>
                            <th>Trạng thái</th>
                            <th class="w-1">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($employees)): ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted py-5">
                                    <i class="ti ti-users-off" style="font-size: 48px;"></i>
                                    <div class="mt-2">Không tìm thấy nhân viên</div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php
                            $offset = $pagination->getOffset();
                            foreach ($employees as $index => $emp):
                            ?>
                                <tr>
                                    <td><?= $offset + $index + 1 ?></td>
                                    <td>
                                        <span class="badge bg-azure-lt"><?= htmlspecialchars($emp['ma_nhan_vien']) ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2">
                                                <?= strtoupper(mb_substr($emp['ho_ten'], 0, 1)) ?>
                                            </span>
                                            <div class="flex-fill">
                                                <div class="fw-bold"><?= htmlspecialchars($emp['ho_ten']) ?></div>
                                                <div class="text-muted small"><?= htmlspecialchars($emp['email'] ?? '') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($emp['ngay_sinh'])) ?></td>
                                    <td>
                                        <?php if ($emp['gioi_tinh'] == 'Nam'): ?>
                                            <i class="ti ti-gender-male text-blue"></i> Nam
                                        <?php else: ?>
                                            <i class="ti ti-gender-female text-pink"></i> Nữ
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($emp['ten_phong_ban'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($emp['ten_chuc_danh'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge bg-<?= $emp['loai_nhan_vien'] == 'bien_che' ? 'blue' : 'cyan' ?>-lt">
                                            <?= $emp['loai_nhan_vien'] == 'bien_che' ? 'Biên chế' : 'Hợp đồng' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClass = [
                                            'dang_lam' => 'green',
                                            'nghi_viec' => 'red',
                                            'nghi_huu' => 'yellow'
                                        ];
                                        $statusText = [
                                            'dang_lam' => 'Đang làm',
                                            'nghi_viec' => 'Nghỉ việc',
                                            'nghi_huu' => 'Nghỉ hưu'
                                        ];
                                        ?>
                                        <span class="badge bg-<?= $statusClass[$emp['trang_thai']] ?>-lt">
                                            <?= $statusText[$emp['trang_thai']] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= BASE_URL ?>employee/detail/<?= $emp['id'] ?>"
                                                class="btn btn-sm btn-outline-primary" title="Xem">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <?php if (Auth::hasPermission('employee.edit')): ?>
                                                <a href="<?= BASE_URL ?>employee/edit/<?= $emp['id'] ?>"
                                                    class="btn btn-sm btn-outline-warning" title="Sửa">
                                                    <i class="ti ti-edit"></i>
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
                        <?= $pagination->render(BASE_URL . 'employee', [
                            'ma_nhan_vien' => $_GET['ma_nhan_vien'] ?? '',
                            'ho_ten' => $_GET['ho_ten'] ?? '',
                            'email' => $_GET['email'] ?? '',
                            'dien_thoai' => $_GET['dien_thoai'] ?? '',
                            'phong_ban_id' => $_GET['phong_ban_id'] ?? '',
                            'chuc_danh_id' => $_GET['chuc_danh_id'] ?? '',
                            'loai_nhan_vien' => $_GET['loai_nhan_vien'] ?? '',
                            'trang_thai' => $_GET['trang_thai'] ?? ''
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>