<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Quản lý Phòng ban</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <?php if ($canCreate): ?>
                    <a href="<?= BASE_URL ?>department/add" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Thêm phòng ban
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <!-- Search & Filter -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="<?= BASE_URL ?>department" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Tìm mã, tên phòng ban..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">-- Tất cả trạng thái --</option>
                            <option value="active" <?= $status === 'active' ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="inactive" <?= $status === 'inactive' ? 'selected' : '' ?>>Ngừng hoạt động</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search"></i> Tìm kiếm
                        </button>
                        <a href="<?= BASE_URL ?>department" class="btn btn-outline-secondary">
                            <i class="ti ti-reload"></i> Làm mới
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách phòng ban</h3>
                <div class="ms-auto text-muted">
                    <?= $pagination->renderInfo() ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên phòng ban</th>
                            <th>Ngày thành lập</th>
                            <th>Trạng thái</th>
                            <th>Số nhân viên</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($departments)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="ti ti-folder-off" style="font-size: 48px;"></i>
                                    <div class="mt-2">Không có dữ liệu</div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($departments as $dept): ?>
                                <?php
                                // Count employees
                                $db = new Database();
                                $empCount = $db->query("SELECT COUNT(*) as count FROM nhan_vien WHERE phong_ban_id = ?", [$dept['id']])[0]['count'];
                                ?>
                                <tr>
                                    <td><span class="badge bg-blue-lt"><?= htmlspecialchars($dept['ma_phong_ban']) ?></span></td>
                                    <td>
                                        <div class="fw-bold"><?= htmlspecialchars($dept['ten_phong_ban']) ?></div>
                                        <?php if ($dept['mo_ta']): ?>
                                            <div class="text-muted small"><?= htmlspecialchars($dept['mo_ta']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $dept['ngay_thanh_lap'] ? date('d/m/Y', strtotime($dept['ngay_thanh_lap'])) : '-' ?></td>
                                    <td>
                                        <?php if ($dept['trang_thai'] === 'active'): ?>
                                            <span class="badge bg-success">Hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Ngừng hoạt động</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge"><?= $empCount ?></span></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if ($canEdit): ?>
                                                <a href="<?= BASE_URL ?>department/edit/<?= $dept['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($canDelete): ?>
                                                <a href="<?= BASE_URL ?>department/delete/<?= $dept['id'] ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Bạn có chắc muốn xóa phòng ban này?')">
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
                        <?= $pagination->render(BASE_URL . 'department', ['search' => $search, 'status' => $status]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>