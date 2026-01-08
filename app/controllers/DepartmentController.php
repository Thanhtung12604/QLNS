<?php

class DepartmentController extends Controller
{
    private $departmentModel;

    public function __construct()
    {
        Auth::requireLogin();
        $this->departmentModel = $this->model('Department');
    }

    public function index()
    {
        Auth::requirePermission('department.view');

        // Search & Filter
        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 20;

        // Build conditions
        $conditions = [];
        $params = [];

        if ($search) {
            $conditions[] = "(ma_phong_ban LIKE ? OR ten_phong_ban LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if ($status) {
            $conditions[] = "trang_thai = ?";
            $params[] = $status;
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

        // Count total
        $countSql = "SELECT COUNT(*) as total FROM phong_ban $where";
        $result = $this->departmentModel->query($countSql, $params);
        $total = $result[0]['total'];

        // Pagination
        $pagination = new Pagination($total, $perPage, $page);

        // Get data
        $sql = "SELECT * FROM phong_ban $where ORDER BY id DESC LIMIT ? OFFSET ?";
        $params[] = $pagination->getLimit();
        $params[] = $pagination->getOffset();
        $departments = $this->departmentModel->query($sql, $params);

        $data = [
            'departments' => $departments,
            'pagination' => $pagination,
            'search' => $search,
            'status' => $status,
            'canCreate' => Auth::hasPermission('department.create'),
            'canEdit' => Auth::hasPermission('department.edit'),
            'canDelete' => Auth::hasPermission('department.delete')
        ];

        $this->view('department/index', $data);
    }

    public function add()
    {
        Auth::requirePermission('department.create');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ma_phong_ban' => $_POST['ma_phong_ban'] ?? '',
                'ten_phong_ban' => $_POST['ten_phong_ban'] ?? '',
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'ngay_thanh_lap' => $_POST['ngay_thanh_lap'] ?? null,
                'trang_thai' => $_POST['trang_thai'] ?? 'active'
            ];

            if ($this->departmentModel->create($data)) {
                $_SESSION['success'] = 'Thêm phòng ban thành công!';
                header('Location: ' . BASE_URL . 'department');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $this->view('department/add');
    }

    public function edit($id)
    {
        Auth::requirePermission('department.edit');

        $department = $this->departmentModel->find($id);
        if (!$department) {
            $_SESSION['error'] = 'Không tìm thấy phòng ban!';
            header('Location: ' . BASE_URL . 'department');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ma_phong_ban' => $_POST['ma_phong_ban'] ?? '',
                'ten_phong_ban' => $_POST['ten_phong_ban'] ?? '',
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'ngay_thanh_lap' => $_POST['ngay_thanh_lap'] ?? null,
                'trang_thai' => $_POST['trang_thai'] ?? 'active'
            ];

            if ($this->departmentModel->update($id, $data)) {
                $_SESSION['success'] = 'Cập nhật phòng ban thành công!';
                header('Location: ' . BASE_URL . 'department');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $this->view('department/edit', ['department' => $department]);
    }

    public function delete($id)
    {
        Auth::requirePermission('department.delete');

        // Check if department has employees
        $sql = "SELECT COUNT(*) as count FROM nhan_vien WHERE phong_ban_id = ?";
        $result = $this->departmentModel->query($sql, [$id]);

        if ($result[0]['count'] > 0) {
            $_SESSION['error'] = 'Không thể xóa phòng ban đang có nhân viên!';
        } else {
            if ($this->departmentModel->delete($id)) {
                $_SESSION['success'] = 'Xóa phòng ban thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        header('Location: ' . BASE_URL . 'department');
        exit;
    }
}
