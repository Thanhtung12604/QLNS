<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Quản lý Chức danh</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <?php if ($canCreate): ?>
                    <a href="<?= BASE_URL ?>position/add" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Thêm chức danh
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
                <form method="GET" action="<?= BASE_URL ?>position" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Tìm mã, tên chức danh..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search"></i> Tìm kiếm
                        </button>
                        <a href="<?= BASE_URL ?>position" class="btn btn-outline-secondary">
                            <i class="ti ti-reload"></i> Làm mới
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách chức danh</h3>
                <div class="ms-auto text-muted">
                    <?= $pagination->renderInfo() ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên chức danh</th>
                            <th>Mức lương cơ bản</th>
                            <th>Số nhân viên</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($positions)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="ti ti-folder-off" style="font-size: 48px;"></i>
                                    <div class="mt-2">Không có dữ liệu</div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($positions as $pos): ?>
                                <?php
                                $db = new Database();
                                $empCount = $db->query("SELECT COUNT(*) as count FROM nhan_vien WHERE chuc_danh_id = ?", [$pos['id']])[0]['count'];
                                ?>
                                <tr>
                                    <td><span class="badge bg-purple-lt"><?= htmlspecialchars($pos['ma_chuc_danh']) ?></span></td>
                                    <td>
                                        <div class="fw-bold"><?= htmlspecialchars($pos['ten_chuc_danh']) ?></div>
                                        <?php if ($pos['mo_ta']): ?>
                                            <div class="text-muted small"><?= htmlspecialchars($pos['mo_ta']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="text-primary fw-bold"><?= number_format($pos['muc_luong_co_ban']) ?> VNĐ</span></td>
                                    <td><span class="badge"><?= $empCount ?></span></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if ($canEdit): ?>
                                                <a href="<?= BASE_URL ?>position/edit/<?= $pos['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($canDelete): ?>
                                                <a href="<?= BASE_URL ?>position/delete/<?= $pos['id'] ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Bạn có chắc muốn xóa chức danh này?')">
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
                        <?= $pagination->render(BASE_URL . 'position', ['search' => $search]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>