<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Đăng nhập' ?></title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class="d-flex flex-column bg-white">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <h1 class="mb-0">
                        <i class="ti ti-users text-primary" style="font-size: 3rem;"></i>
                    </h1>
                </a>
            </div>

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Đăng nhập hệ thống</h2>
                    <p class="text-muted text-center mb-4">Quản lý nhân sự</p>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="ti ti-alert-circle alert-icon"></i>
                                </div>
                                <div>
                                    <?= $error ?>
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= BASE_URL ?>auth/login" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Nhập tên đăng nhập"
                                    autocomplete="off" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <i class="ti ti-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Nhập mật khẩu"
                                    autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-login me-2"></i>
                                Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center text-muted mt-3">
                <div class="alert alert-info">
                    <i class="ti ti-info-circle me-2"></i>
                    Tài khoản mặc định: <strong>admin</strong> / <strong>123123123</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js"></script>
</body>

</html>