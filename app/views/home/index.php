<?php include APP_PATH . 'views/layouts/header.php'; ?>

<!-- Statistics Cards -->
<div class="row row-deck row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Tổng nhân viên</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-baseline">
                    <div class="h1 mb-0 me-2"><?= $stats['tong_nhan_vien'] ?? 0 ?></div>
                    <div class="me-auto">
                        <span class="badge bg-blue-lt">người</span>
                    </div>
                </div>
            </div>
            <div id="chart-employee" class="chart-sm"></div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Biên chế</div>
                </div>
                <div class="d-flex align-items-baseline">
                    <div class="h1 mb-3 me-2"><?= $stats['bien_che'] ?? 0 ?></div>
                    <div class="me-auto">
                        <span class="badge bg-green-lt">người</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Hợp đồng</div>
                </div>
                <div class="d-flex align-items-baseline">
                    <div class="h1 mb-3 me-2"><?= $stats['hop_dong'] ?? 0 ?></div>
                    <div class="me-auto">
                        <span class="badge bg-cyan-lt">người</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Đảng viên</div>
                </div>
                <div class="d-flex align-items-baseline">
                    <div class="h1 mb-3 me-2"><?= $stats['dang_vien'] ?? 0 ?></div>
                    <div class="me-auto">
                        <span class="badge bg-yellow-lt">người</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row row-deck row-cards mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-gender-bigender me-2"></i>Thống kê giới tính
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h1 text-blue"><?= $stats['nam'] ?? 0 ?></div>
                            <div class="text-muted">
                                <i class="ti ti-user me-1"></i>Nam
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h1 text-pink"><?= $stats['nu'] ?? 0 ?></div>
                            <div class="text-muted">
                                <i class="ti ti-user me-1"></i>Nữ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-briefcase me-2"></i>Tình trạng làm việc
                </h3>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="status-dot status-dot-animated bg-green d-block"></span>
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block">Đang làm việc</div>
                            </div>
                            <div class="col-auto">
                                <div class="badge bg-green-lt"><?= $stats['dang_lam'] ?? 0 ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="status-dot bg-red d-block"></span>
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block">Đã nghỉ việc</div>
                            </div>
                            <div class="col-auto">
                                <div class="badge bg-red-lt"><?= $stats['nghi_viec'] ?? 0 ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="status-dot bg-yellow d-block"></span>
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block">Nghỉ hưu</div>
                            </div>
                            <div class="col-auto">
                                <div class="badge bg-yellow-lt"><?= $stats['nghi_huu'] ?? 0 ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Access -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-bolt me-2"></i>Truy cập nhanh
                </h3>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-4">
                        <a href="<?= BASE_URL ?>employee" class="card card-link card-link-pop">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="ti ti-users text-blue" style="font-size: 3rem;"></i>
                                </div>
                                <h3 class="card-title">Quản lý nhân viên</h3>
                                <p class="text-muted">Xem danh sách, thêm mới, chỉnh sửa</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= BASE_URL ?>attendance" class="card card-link card-link-pop">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="ti ti-calendar-check text-green" style="font-size: 3rem;"></i>
                                </div>
                                <h3 class="card-title">Chấm công</h3>
                                <p class="text-muted">Chấm công và quản lý ngày công</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= BASE_URL ?>salary" class="card card-link card-link-pop">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="ti ti-coin text-yellow" style="font-size: 3rem;"></i>
                                </div>
                                <h3 class="card-title">Quản lý lương</h3>
                                <p class="text-muted">Tính lương và quản lý bảng lương</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>