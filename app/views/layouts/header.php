<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Hệ thống quản lý nhân sự' ?></title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
</head>

<body>
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="<?= BASE_URL ?>">
                        <i class="ti ti-users me-2"></i>
                        <span>QLNS</span>
                    </a>
                </h1>

                <div class="navbar-nav flex-row d-lg-none">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                            <span class="avatar avatar-sm">
                                <i class="ti ti-user"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="<?= BASE_URL ?>auth/logout" class="dropdown-item">
                                <i class="ti ti-logout me-2"></i>Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>home">
                                <span class="nav-link-icon d-lg-inline-block">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="nav-link-title">Trang chủ</span>
                            </a>
                        </li>

                        <!-- Danh mục -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-categories" data-bs-toggle="dropdown" role="button">
                                <span class="nav-link-icon d-lg-inline-block">
                                    <i class="ti ti-folder"></i>
                                </span>
                                <span class="nav-link-title">Danh mục</span>
                            </a>
                            <div class="dropdown-menu">
                                <?php if (Auth::hasPermission('department.view')): ?>
                                    <a class="dropdown-item" href="<?= BASE_URL ?>department">
                                        <i class="ti ti-building me-2"></i>Phòng ban
                                    </a>
                                <?php endif; ?>
                                <?php if (Auth::hasPermission('position.view')): ?>
                                    <a class="dropdown-item" href="<?= BASE_URL ?>position">
                                        <i class="ti ti-award me-2"></i>Chức danh
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>

                        <?php if (Auth::hasPermission('employee.view')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>employee">
                                    <span class="nav-link-icon d-lg-inline-block">
                                        <i class="ti ti-users"></i>
                                    </span>
                                    <span class="nav-link-title">Nhân viên</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (Auth::hasPermission('attendance.view')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>attendance">
                                    <span class="nav-link-icon d-lg-inline-block">
                                        <i class="ti ti-calendar-check"></i>
                                    </span>
                                    <span class="nav-link-title">Chấm công</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (Auth::hasPermission('salary.view')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>salary">
                                    <span class="nav-link-icon d-lg-inline-block">
                                        <i class="ti ti-coin"></i>
                                    </span>
                                    <span class="nav-link-title">Lương</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (Auth::hasPermission('report.view')): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-reports" data-bs-toggle="dropdown" role="button">
                                    <span class="nav-link-icon d-lg-inline-block">
                                        <i class="ti ti-chart-bar"></i>
                                    </span>
                                    <span class="nav-link-title">Báo cáo</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= BASE_URL ?>report/nangLuong">
                                        <i class="ti ti-arrow-up-circle me-2"></i>Đến kỳ nâng lương
                                    </a>
                                    <a class="dropdown-item" href="<?= BASE_URL ?>report/nghiHuu">
                                        <i class="ti ti-beach me-2"></i>Đến tuổi nghỉ hưu
                                    </a>
                                    <a class="dropdown-item" href="<?= BASE_URL ?>report/sinhNhat">
                                        <i class="ti ti-cake me-2"></i>Sinh nhật tháng
                                    </a>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Page wrapper -->
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title"><?= $title ?? 'Trang chủ' ?></h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <a href="#" class="btn">
                                        <i class="ti ti-user me-2"></i>
                                        <?= $_SESSION['ho_ten'] ?? $_SESSION['username'] ?>
                                    </a>
                                </span>
                                <a href="<?= BASE_URL ?>auth/logout" class="btn btn-danger">
                                    <i class="ti ti-logout me-2"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="ti ti-check alert-icon"></i>
                                </div>
                                <div>
                                    <?= $_SESSION['success'] ?>
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="ti ti-alert-circle alert-icon"></i>
                                </div>
                                <div>
                                    <?= $_SESSION['error'] ?>
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>