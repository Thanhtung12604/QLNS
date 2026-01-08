<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="row row-cards">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">
                    <i class="ti ti-arrow-up-circle text-success me-2"></i>
                    Nâng lương định kỳ
                </h3>
                <p class="text-muted">Danh sách nhân viên đã đủ 3 năm kể từ lần nâng lương gần nhất</p>
                <a href="<?= BASE_URL ?>report/nangLuong" class="btn btn-primary w-100">
                    <i class="ti ti-eye me-2"></i>Xem danh sách
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">
                    <i class="ti ti-beach text-orange me-2"></i>
                    Nghỉ hưu
                </h3>
                <p class="text-muted">Danh sách nhân viên đến tuổi nghỉ hưu (Nam: 60, Nữ: 55)</p>
                <a href="<?= BASE_URL ?>report/nghiHuu" class="btn btn-primary w-100">
                    <i class="ti ti-eye me-2"></i>Xem danh sách
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">
                    <i class="ti ti-cake text-pink me-2"></i>
                    Sinh nhật tháng
                </h3>
                <p class="text-muted">Danh sách nhân viên có sinh nhật trong tháng hiện tại</p>
                <a href="<?= BASE_URL ?>report/sinhNhat" class="btn btn-primary w-100">
                    <i class="ti ti-eye me-2"></i>Xem danh sách
                </a>
            </div>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>