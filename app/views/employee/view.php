<?php include APP_PATH . 'views/layouts/header.php'; ?>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="text-muted mb-1">
                    <a href="<?= BASE_URL ?>employee">Nhân viên</a> / Chi tiết
                </div>
                <h2 class="page-title"><?= htmlspecialchars($employee['ho_ten']) ?></h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <?php if (Auth::hasPermission('employee.edit')): ?>
                    <a href="<?= BASE_URL ?>employee/edit/<?= $employee['id'] ?>" class="btn btn-primary">
                        <i class="ti ti-edit"></i> Chỉnh sửa
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-8">
                <!-- Thông tin cơ bản -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ti ti-user me-2"></i>Thông tin cơ bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Mã nhân viên</label>
                                <div class="fw-bold"><?= htmlspecialchars($employee['ma_nhan_vien']) ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Họ và tên</label>
                                <div class="fw-bold"><?= htmlspecialchars($employee['ho_ten']) ?></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label text-muted">Ngày sinh</label>
                                <div><?= date('d/m/Y', strtotime($employee['ngay_sinh'])) ?>
                                    <span class="text-muted">(<?= date('Y') - date('Y', strtotime($employee['ngay_sinh'])) ?> tuổi)</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted">Giới tính</label>
                                <div><?= htmlspecialchars($employee['gioi_tinh']) ?></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted">Dân tộc</label>
                                <div><?= htmlspecialchars($employee['dan_toc'] ?? 'Kinh') ?></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">CMND/CCCD</label>
                                <div><?= htmlspecialchars($employee['so_cmnd']) ?></div>
                                <?php if ($employee['ngay_cap_cmnd']): ?>
                                    <small class="text-muted">
                                        Cấp ngày <?= date('d/m/Y', strtotime($employee['ngay_cap_cmnd'])) ?>
                                        <?= $employee['noi_cap_cmnd'] ? 'tại ' . htmlspecialchars($employee['noi_cap_cmnd']) : '' ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Tình trạng hôn nhân</label>
                                <div>
                                    <?php
                                    $statusMap = [
                                        'doc_than' => 'Độc thân',
                                        'da_ket_hon' => 'Đã kết hôn',
                                        'ly_hon' => 'Ly hôn',
                                        'goa' => 'Góa'
                                    ];
                                    echo $statusMap[$employee['tinh_trang_hon_nhan']] ?? '-';
                                    ?>
                                    <?php if ($employee['so_con'] > 0): ?>
                                        <span class="text-muted">(<?= $employee['so_con'] ?> con)</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Email</label>
                                <div>
                                    <?php if ($employee['email']): ?>
                                        <a href="mailto:<?= htmlspecialchars($employee['email']) ?>">
                                            <i class="ti ti-mail"></i> <?= htmlspecialchars($employee['email']) ?>
                                        </a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Số điện thoại</label>
                                <div>
                                    <?php if ($employee['so_dien_thoai']): ?>
                                        <a href="tel:<?= htmlspecialchars($employee['so_dien_thoai']) ?>">
                                            <i class="ti ti-phone"></i> <?= htmlspecialchars($employee['so_dien_thoai']) ?>
                                        </a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if ($employee['ton_giao']): ?>
                            <div class="mb-3">
                                <label class="form-label text-muted">Tôn giáo</label>
                                <div><?= htmlspecialchars($employee['ton_giao']) ?></div>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label text-muted">Địa chỉ hiện tại</label>
                            <div><?= htmlspecialchars($employee['dia_chi_hien_tai'] ?? '-') ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Địa chỉ thường trú</label>
                            <div><?= htmlspecialchars($employee['dia_chi_thuong_tru'] ?? '-') ?></div>
                        </div>

                        <?php if ($employee['ho_khau_thuong_tru']): ?>
                            <div class="mb-3">
                                <label class="form-label text-muted">Hộ khẩu thường trú</label>
                                <div><?= htmlspecialchars($employee['ho_khau_thuong_tru']) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Thông tin trình độ -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ti ti-school me-2"></i>Trình độ chuyên môn</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Trình độ học vấn</label>
                                <div><?= htmlspecialchars($employee['trinh_do_hoc_van'] ?? '-') ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Trình độ chuyên môn</label>
                                <div><?= htmlspecialchars($employee['trinh_do_chuyen_mon'] ?? '-') ?></div>
                            </div>
                        </div>

                        <?php if ($employee['chuyen_nganh']): ?>
                            <div class="mb-3">
                                <label class="form-label text-muted">Chuyên ngành</label>
                                <div><?= htmlspecialchars($employee['chuyen_nganh']) ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($employee['bang_cap']): ?>
                            <div class="mb-3">
                                <label class="form-label text-muted">Bằng cấp</label>
                                <div><?= nl2br(htmlspecialchars($employee['bang_cap'])) ?></div>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <?php if ($employee['trinh_do_ngoai_ngu']): ?>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Ngoại ngữ</label>
                                    <div><?= htmlspecialchars($employee['trinh_do_ngoai_ngu']) ?></div>
                                    <?php if ($employee['chung_chi_ngoai_ngu']): ?>
                                        <small class="text-muted"><?= htmlspecialchars($employee['chung_chi_ngoai_ngu']) ?></small>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($employee['tin_hoc']): ?>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Tin học</label>
                                    <div><?= htmlspecialchars($employee['tin_hoc']) ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Thông tin chính trị -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ti ti-flag me-2"></i>Thông tin chính trị - xã hội</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if ($employee['ngay_vao_doan']): ?>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Ngày vào Đoàn</label>
                                    <div><?= date('d/m/Y', strtotime($employee['ngay_vao_doan'])) ?></div>
                                </div>
                            <?php endif; ?>

                            <?php if ($employee['la_dang_vien']): ?>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Đảng viên</label>
                                    <div>
                                        <span class="badge bg-red">Đảng viên Đảng Cộng sản Việt Nam</span>
                                        <?php if ($employee['ngay_vao_dang']): ?>
                                            <div class="mt-1"><small class="text-muted">Vào Đảng: <?= date('d/m/Y', strtotime($employee['ngay_vao_dang'])) ?></small></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($employee['dien_chinh_sach']): ?>
                            <div class="mb-3">
                                <label class="form-label text-muted">Diện chính sách</label>
                                <div><?= htmlspecialchars($employee['dien_chinh_sach']) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Thông tin gia đình -->
                <?php if (!empty($family)): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="ti ti-users me-2"></i>Thông tin gia đình</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Quan hệ</th>
                                        <th>Họ tên</th>
                                        <th>Năm sinh</th>
                                        <th>Nghề nghiệp</th>
                                        <th>Số điện thoại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($family as $member): ?>
                                        <tr>
                                            <td><span class="badge"><?= Family::getRelationName($member['quan_he']) ?></span></td>
                                            <td class="fw-bold"><?= htmlspecialchars($member['ho_ten']) ?></td>
                                            <td><?= $member['nam_sinh'] ?></td>
                                            <td><?= htmlspecialchars($member['nghe_nghiep'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($member['so_dien_thoai'] ?? '-') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Quá trình công tác -->
                <?php if (!empty($workHistory)): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="ti ti-history me-2"></i>Quá trình công tác</h3>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <?php foreach ($workHistory as $history): ?>
                                    <div class="timeline-event">
                                        <div class="timeline-event-icon bg-blue-lt">
                                            <i class="ti ti-briefcase"></i>
                                        </div>
                                        <div class="card timeline-event-card">
                                            <div class="card-body">
                                                <div class="text-muted text-sm">
                                                    <?= date('m/Y', strtotime($history['tu_ngay'])) ?> -
                                                    <?= $history['den_ngay'] ? date('m/Y', strtotime($history['den_ngay'])) : 'Hiện tại' ?>
                                                </div>
                                                <div class="fw-bold"><?= htmlspecialchars($history['chuc_danh']) ?></div>
                                                <div><?= htmlspecialchars($history['phong_ban']) ?></div>
                                                <?php if ($history['ghi_chu']): ?>
                                                    <div class="text-muted small mt-1"><?= htmlspecialchars($history['ghi_chu']) ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <!-- Thông tin công tác -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ti ti-briefcase me-2"></i>Thông tin công tác</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label text-muted">Loại nhân viên</label>
                            <div>
                                <?php if ($employee['loai_nhan_vien'] === 'bien_che'): ?>
                                    <span class="badge bg-blue">Biên chế</span>
                                <?php else: ?>
                                    <span class="badge bg-cyan">Hợp đồng</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Phòng ban</label>
                            <div><?= $department ? htmlspecialchars($department['ten_phong_ban']) : '-' ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Chức danh</label>
                            <div><?= $position ? htmlspecialchars($position['ten_chuc_danh']) : '-' ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Ngày vào làm</label>
                            <div><?= date('d/m/Y', strtotime($employee['ngay_vao_lam'])) ?></div>
                            <small class="text-muted">
                                Làm việc <?= floor((time() - strtotime($employee['ngay_vao_lam'])) / (365 * 24 * 60 * 60)) ?> năm
                            </small>
                        </div>

                        <?php if ($employee['loai_nhan_vien'] === 'bien_che'): ?>
                            <?php if ($employee['bac_luong']): ?>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Bậc lương</label>
                                    <div><?= $employee['bac_luong'] ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if ($employee['he_so_luong']): ?>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Hệ số lương</label>
                                    <div><?= $employee['he_so_luong'] ?></div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($employee['muc_luong_hop_dong']): ?>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Mức lương</label>
                                    <div class="text-primary fw-bold"><?= number_format($employee['muc_luong_hop_dong']) ?> VNĐ</div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label text-muted">Trạng thái</label>
                            <div>
                                <?php
                                $statusBadge = [
                                    'dang_lam_viec' => '<span class="badge bg-success">Đang làm việc</span>',
                                    'nghi_viec' => '<span class="badge bg-danger">Nghỉ việc</span>',
                                    'nghi_huu' => '<span class="badge bg-secondary">Nghỉ hưu</span>'
                                ];
                                echo $statusBadge[$employee['trang_thai']] ?? '-';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin hệ thống -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ti ti-info-circle me-2"></i>Thông tin hệ thống</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <small class="text-muted">Ngày tạo</small>
                            <div><?= date('d/m/Y H:i', strtotime($employee['created_at'])) ?></div>
                        </div>
                        <?php if ($employee['updated_at'] != $employee['created_at']): ?>
                            <div>
                                <small class="text-muted">Cập nhật lần cuối</small>
                                <div><?= date('d/m/Y H:i', strtotime($employee['updated_at'])) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include APP_PATH . 'views/layouts/footer.php'; ?>