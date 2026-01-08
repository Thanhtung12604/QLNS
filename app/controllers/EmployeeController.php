<?php

class EmployeeController extends Controller
{
    private $employeeModel;
    private $departmentModel;
    private $positionModel;
    private $familyModel;

    public function __construct()
    {
        Auth::requireLogin();
        $this->employeeModel = $this->model('Employee');
        $this->departmentModel = $this->model('Department');
        $this->positionModel = $this->model('Position');
        $this->familyModel = $this->model('Family');
    }

    public function index()
    {
        Auth::requirePermission('employee.view');

        // Search parameters
        $search = $_GET['search'] ?? '';
        $phong_ban_id = $_GET['phong_ban_id'] ?? '';
        $chuc_danh_id = $_GET['chuc_danh_id'] ?? '';
        $loai_nhan_vien = $_GET['loai_nhan_vien'] ?? '';
        $trang_thai = $_GET['trang_thai'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 20;

        // Build query conditions
        $conditions = [];
        $params = [];

        if ($search) {
            $conditions[] = "(nv.ma_nhan_vien LIKE ? OR nv.ho_ten LIKE ? OR nv.email LIKE ? OR nv.so_dien_thoai LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if ($phong_ban_id) {
            $conditions[] = "nv.phong_ban_id = ?";
            $params[] = $phong_ban_id;
        }

        if ($chuc_danh_id) {
            $conditions[] = "nv.chuc_danh_id = ?";
            $params[] = $chuc_danh_id;
        }

        if ($loai_nhan_vien) {
            $conditions[] = "nv.loai_nhan_vien = ?";
            $params[] = $loai_nhan_vien;
        }

        if ($trang_thai) {
            $conditions[] = "nv.trang_thai = ?";
            $params[] = $trang_thai;
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

        // Count total
        $countSql = "SELECT COUNT(*) as total FROM nhan_vien nv $where";
        $result = $this->employeeModel->query($countSql, $params);
        $total = $result[0]['total'];

        // Pagination
        $pagination = new Pagination($total, $perPage, $page);

        // Get data with details
        $sql = "SELECT nv.*, pb.ten_phong_ban, cd.ten_chuc_danh 
                FROM nhan_vien nv
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                $where
                ORDER BY nv.id DESC 
                LIMIT ? OFFSET ?";
        $params[] = $pagination->getLimit();
        $params[] = $pagination->getOffset();
        $employees = $this->employeeModel->query($sql, $params);

        $departments = $this->departmentModel->getAll();
        $positions = $this->positionModel->getAll();

        $data = [
            'employees' => $employees,
            'departments' => $departments,
            'positions' => $positions,
            'pagination' => $pagination,
            'search' => $search,
            'phong_ban_id' => $phong_ban_id,
            'chuc_danh_id' => $chuc_danh_id,
            'loai_nhan_vien' => $loai_nhan_vien,
            'trang_thai' => $trang_thai,
            'canCreate' => Auth::hasPermission('employee.create'),
            'canEdit' => Auth::hasPermission('employee.edit'),
            'canDelete' => Auth::hasPermission('employee.delete')
        ];

        $this->view('employee/index', $data);
    }


    public function detail($id)
    {
        Auth::requirePermission('employee.view');

        $employee = $this->employeeModel->find($id);
        if (!$employee) {
            $_SESSION['error'] = 'Không tìm thấy nhân viên!';
            header('Location: ' . BASE_URL . 'employee');
            exit;
        }

        $department = $employee['phong_ban_id'] ? $this->departmentModel->find($employee['phong_ban_id']) : null;
        $position = $employee['chuc_danh_id'] ? $this->positionModel->find($employee['chuc_danh_id']) : null;

        $workHistoryModel = $this->model('WorkHistory');
        $workHistory = $workHistoryModel->getByEmployee($id);

        $family = $this->familyModel->getByEmployee($id);

        $data = [
            'employee' => $employee,
            'department' => $department,
            'position' => $position,
            'workHistory' => $workHistory,
            'family' => $family
        ];

        $this->view('employee/view', $data);
    }

    public function add()
    {
        Auth::requirePermission('employee.create');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeModel = $this->model('Employee');

            $data = [
                'ma_nhan_vien' => $_POST['ma_nhan_vien'],
                'ho_ten' => $_POST['ho_ten'],
                'ngay_sinh' => $_POST['ngay_sinh'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'so_cmnd' => $_POST['so_cmnd'],
                'ngay_cap_cmnd' => $_POST['ngay_cap_cmnd'] ?? null,
                'noi_cap_cmnd' => $_POST['noi_cap_cmnd'] ?? null,
                'email' => $_POST['email'] ?? null,
                'so_dien_thoai' => $_POST['so_dien_thoai'] ?? null,
                'dia_chi_hien_tai' => $_POST['dia_chi_hien_tai'] ?? null,
                'dia_chi_thuong_tru' => $_POST['dia_chi_thuong_tru'] ?? null,
                'ho_khau_thuong_tru' => $_POST['ho_khau_thuong_tru'] ?? null,
                'dan_toc' => $_POST['dan_toc'] ?? 'Kinh',
                'ton_giao' => $_POST['ton_giao'] ?? null,
                'tinh_trang_hon_nhan' => $_POST['tinh_trang_hon_nhan'] ?? 'doc_than',
                'so_con' => $_POST['so_con'] ?? 0,

                // Thông tin công tác
                'loai_nhan_vien' => $_POST['loai_nhan_vien'],
                'phong_ban_id' => $_POST['phong_ban_id'] ?? null,
                'chuc_danh_id' => $_POST['chuc_danh_id'] ?? null,
                'ngay_vao_lam' => $_POST['ngay_vao_lam'],

                // Thông tin chính trị - xã hội
                'ngay_vao_doan' => $_POST['ngay_vao_doan'] ?? null,
                'la_dang_vien' => isset($_POST['la_dang_vien']) ? 1 : 0,
                'ngay_vao_dang' => $_POST['ngay_vao_dang'] ?? null,
                'dien_chinh_sach' => $_POST['dien_chinh_sach'] ?? null,

                // Trình độ
                'trinh_do_hoc_van' => $_POST['trinh_do_hoc_van'] ?? null,
                'trinh_do_chuyen_mon' => $_POST['trinh_do_chuyen_mon'] ?? null,
                'chuyen_nganh' => $_POST['chuyen_nganh'] ?? null,
                'bang_cap' => $_POST['bang_cap'] ?? null,
                'trinh_do_ngoai_ngu' => $_POST['trinh_do_ngoai_ngu'] ?? null,
                'chung_chi_ngoai_ngu' => $_POST['chung_chi_ngoai_ngu'] ?? null,
                'tin_hoc' => $_POST['tin_hoc'] ?? null,
            ];

            if ($_POST['loai_nhan_vien'] == 'bien_che') {
                $data['bac_luong'] = $_POST['bac_luong'] ?? null;
                $data['he_so_luong'] = $_POST['he_so_luong'] ?? null;
                $data['ngay_nang_luong_gan_nhat'] = $_POST['ngay_vao_lam'];
            } else {
                $data['muc_luong_hop_dong'] = $_POST['muc_luong_hop_dong'] ?? null;
            }

            if ($employeeModel->insert($data)) {
                $nhanVienId = $this->db->lastInsertId();

                // Thêm thông tin gia đình
                if (isset($_POST['family_relation']) && is_array($_POST['family_relation'])) {
                    $familyModel = $this->model('Family');
                    foreach ($_POST['family_relation'] as $index => $relation) {
                        if (!empty($relation) && !empty($_POST['family_name'][$index])) {
                            $familyData = [
                                'nhan_vien_id' => $nhanVienId,
                                'quan_he' => $relation,
                                'ho_ten' => $_POST['family_name'][$index],
                                'nam_sinh' => $_POST['family_year'][$index] ?? null,
                                'nghe_nghiep' => $_POST['family_job'][$index] ?? null,
                                'noi_o_hien_nay' => $_POST['family_address'][$index] ?? null,
                                'so_dien_thoai' => $_POST['family_phone'][$index] ?? null,
                            ];
                            $familyModel->insert($familyData);
                        }
                    }
                }

                $_SESSION['success'] = 'Thêm nhân viên thành công!';
                $this->redirect('employee');
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm nhân viên!';
            }
        }

        $departmentModel = $this->model('Department');
        $departments = $departmentModel->getActive();

        $positionModel = $this->model('Position');
        $positions = $positionModel->getAll();

        $data = [
            'title' => 'Thêm nhân viên',
            'departments' => $departments,
            'positions' => $positions
        ];

        $this->view('employee/add', $data);
    }


    public function edit($id)
    {
        Auth::requirePermission('employee.edit');

        $employee = $this->employeeModel->find($id);
        if (!$employee) {
            $_SESSION['error'] = 'Không tìm thấy nhân viên!';
            header('Location: ' . BASE_URL . 'employee');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ma_nhan_vien' => $_POST['ma_nhan_vien'],
                'ho_ten' => $_POST['ho_ten'],
                'ngay_sinh' => $_POST['ngay_sinh'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'so_cmnd' => $_POST['so_cmnd'],
                'ngay_cap_cmnd' => $_POST['ngay_cap_cmnd'] ?? null,
                'noi_cap_cmnd' => $_POST['noi_cap_cmnd'] ?? null,
                'email' => $_POST['email'] ?? null,
                'so_dien_thoai' => $_POST['so_dien_thoai'] ?? null,
                'dia_chi_hien_tai' => $_POST['dia_chi_hien_tai'] ?? null,
                'dia_chi_thuong_tru' => $_POST['dia_chi_thuong_tru'] ?? null,
                'ho_khau_thuong_tru' => $_POST['ho_khau_thuong_tru'] ?? null,
                'dan_toc' => $_POST['dan_toc'] ?? 'Kinh',
                'ton_giao' => $_POST['ton_giao'] ?? null,
                'tinh_trang_hon_nhan' => $_POST['tinh_trang_hon_nhan'] ?? 'doc_than',
                'so_con' => $_POST['so_con'] ?? 0,
                'phong_ban_id' => $_POST['phong_ban_id'] ?? null,
                'chuc_danh_id' => $_POST['chuc_danh_id'] ?? null,
                'ngay_vao_doan' => $_POST['ngay_vao_doan'] ?? null,
                'la_dang_vien' => isset($_POST['la_dang_vien']) ? 1 : 0,
                'ngay_vao_dang' => $_POST['ngay_vao_dang'] ?? null,
                'dien_chinh_sach' => $_POST['dien_chinh_sach'] ?? null,
                'trinh_do_hoc_van' => $_POST['trinh_do_hoc_van'] ?? null,
                'trinh_do_chuyen_mon' => $_POST['trinh_do_chuyen_mon'] ?? null,
                'chuyen_nganh' => $_POST['chuyen_nganh'] ?? null,
                'bang_cap' => $_POST['bang_cap'] ?? null,
                'trinh_do_ngoai_ngu' => $_POST['trinh_do_ngoai_ngu'] ?? null,
                'chung_chi_ngoai_ngu' => $_POST['chung_chi_ngoai_ngu'] ?? null,
                'tin_hoc' => $_POST['tin_hoc'] ?? null,
                'trang_thai' => $_POST['trang_thai'] ?? 'dang_lam_viec'
            ];

            if ($employee['loai_nhan_vien'] == 'bien_che') {
                $data['bac_luong'] = $_POST['bac_luong'] ?? null;
                $data['he_so_luong'] = $_POST['he_so_luong'] ?? null;
            } else {
                $data['muc_luong_hop_dong'] = $_POST['muc_luong_hop_dong'] ?? null;
            }

            if ($this->employeeModel->update($id, $data)) {
                // Update family info
                $this->familyModel->deleteByEmployee($id);
                if (isset($_POST['family_relation']) && is_array($_POST['family_relation'])) {
                    foreach ($_POST['family_relation'] as $index => $relation) {
                        if (!empty($relation) && !empty($_POST['family_name'][$index])) {
                            $familyData = [
                                'nhan_vien_id' => $id,
                                'quan_he' => $relation,
                                'ho_ten' => $_POST['family_name'][$index],
                                'nam_sinh' => $_POST['family_year'][$index] ?? null,
                                'nghe_nghiep' => $_POST['family_job'][$index] ?? null,
                                'so_dien_thoai' => $_POST['family_phone'][$index] ?? null,
                            ];
                            $this->familyModel->create($familyData);
                        }
                    }
                }

                $_SESSION['success'] = 'Cập nhật nhân viên thành công!';
                header('Location: ' . BASE_URL . 'employee/view/' . $id);
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $departments = $this->departmentModel->getAll();
        $positions = $this->positionModel->getAll();
        $family = $this->familyModel->getByEmployee($id);

        $data = [
            'employee' => $employee,
            'departments' => $departments,
            'positions' => $positions,
            'family' => $family
        ];

        $this->view('employee/edit', $data);
    }

    public function delete($id)
    {
        Auth::requirePermission('employee.delete');

        // Check if employee has salary records
        $sql = "SELECT COUNT(*) as count FROM bang_luong WHERE nhan_vien_id = ?";
        $result = $this->employeeModel->query($sql, [$id]);

        if ($result[0]['count'] > 0) {
            $_SESSION['error'] = 'Không thể xóa nhân viên đã có bảng lương!';
        } else {
            if ($this->employeeModel->delete($id)) {
                $_SESSION['success'] = 'Xóa nhân viên thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        header('Location: ' . BASE_URL . 'employee');
        exit;
    }
}
