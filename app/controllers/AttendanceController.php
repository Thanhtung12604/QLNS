<?php

class AttendanceController extends Controller
{
    private $attendanceModel;
    private $employeeModel;

    public function __construct()
    {
        Auth::requireLogin();
        $this->attendanceModel = $this->model('Attendance');
        $this->employeeModel = $this->model('Employee');
    }

    public function index()
    {
        Auth::requirePermission('attendance.view');

        $thang = isset($_GET['thang']) ? (int)$_GET['thang'] : date('m');
        $nam = isset($_GET['nam']) ? (int)$_GET['nam'] : date('Y');
        $nhan_vien_id = $_GET['nhan_vien_id'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 20;

        // Build query
        $conditions = ["cc.thang = ? AND cc.nam = ?"];
        $params = [$thang, $nam];

        if ($nhan_vien_id) {
            $conditions[] = "cc.nhan_vien_id = ?";
            $params[] = $nhan_vien_id;
        }

        $where = 'WHERE ' . implode(' AND ', $conditions);

        // Count total
        $countSql = "SELECT COUNT(*) as total FROM cham_cong cc $where";
        $result = $this->attendanceModel->query($countSql, $params);
        $total = $result[0]['total'];

        // Pagination
        $pagination = new Pagination($total, $perPage, $page);

        // Get data
        $sql = "SELECT cc.*, nv.ma_nhan_vien, nv.ho_ten, pb.ten_phong_ban, cd.ten_chuc_danh
                FROM cham_cong cc
                LEFT JOIN nhan_vien nv ON cc.nhan_vien_id = nv.id
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                $where
                ORDER BY nv.ma_nhan_vien
                LIMIT ? OFFSET ?";
        $params[] = $pagination->getLimit();
        $params[] = $pagination->getOffset();
        $attendances = $this->attendanceModel->query($sql, $params);

        $employees = $this->employeeModel->getAll();

        $data = [
            'attendances' => $attendances,
            'employees' => $employees,
            'pagination' => $pagination,
            'thang' => $thang,
            'nam' => $nam,
            'nhan_vien_id' => $nhan_vien_id,
            'canCreate' => Auth::hasPermission('attendance.create'),
            'canEdit' => Auth::hasPermission('attendance.edit'),
            'canDelete' => Auth::hasPermission('attendance.delete')
        ];

        $this->view('attendance/index', $data);
    }

    public function add()
    {
        Auth::requirePermission('attendance.create');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nhan_vien_id' => $_POST['nhan_vien_id'],
                'thang' => $_POST['thang'],
                'nam' => $_POST['nam'],
                'so_ngay_cong' => $_POST['so_ngay_cong'],
                'so_ngay_nghi_phep' => $_POST['so_ngay_nghi_phep'] ?? 0,
                'so_ngay_nghi_khong_phep' => $_POST['so_ngay_nghi_khong_phep'] ?? 0,
                'di_tre_ve_som' => $_POST['di_tre_ve_som'] ?? 0,
                'ghi_chu' => $_POST['ghi_chu'] ?? '',
                'nguoi_cham_id' => Auth::id()
            ];

            if ($this->attendanceModel->create($data)) {
                $_SESSION['success'] = 'Thêm chấm công thành công!';
                header('Location: ' . BASE_URL . 'attendance?thang=' . $data['thang'] . '&nam=' . $data['nam']);
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $employees = $this->employeeModel->getAll();
        $this->view('attendance/add', ['employees' => $employees]);
    }

    public function edit($id)
    {
        Auth::requirePermission('attendance.edit');

        $attendance = $this->attendanceModel->find($id);
        if (!$attendance) {
            $_SESSION['error'] = 'Không tìm thấy bản ghi chấm công!';
            header('Location: ' . BASE_URL . 'attendance');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'so_ngay_cong' => $_POST['so_ngay_cong'],
                'so_ngay_nghi_phep' => $_POST['so_ngay_nghi_phep'] ?? 0,
                'so_ngay_nghi_khong_phep' => $_POST['so_ngay_nghi_khong_phep'] ?? 0,
                'di_tre_ve_som' => $_POST['di_tre_ve_som'] ?? 0,
                'ghi_chu' => $_POST['ghi_chu'] ?? '',
                'nguoi_cham_id' => Auth::id()
            ];

            if ($this->attendanceModel->update($id, $data)) {
                $_SESSION['success'] = 'Cập nhật chấm công thành công!';
                header('Location: ' . BASE_URL . 'attendance?thang=' . $attendance['thang'] . '&nam=' . $attendance['nam']);
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $employee = $this->employeeModel->find($attendance['nhan_vien_id']);
        $this->view('attendance/edit', ['attendance' => $attendance, 'employee' => $employee]);
    }

    public function delete($id)
    {
        Auth::requirePermission('attendance.delete');

        $attendance = $this->attendanceModel->find($id);
        if ($attendance) {
            if ($this->attendanceModel->delete($id)) {
                $_SESSION['success'] = 'Xóa chấm công thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        header('Location: ' . BASE_URL . 'attendance');
        exit;
    }
}
