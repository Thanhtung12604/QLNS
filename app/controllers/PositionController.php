<?php

class PositionController extends Controller
{
    private $positionModel;

    public function __construct()
    {
        Auth::requireLogin();
        $this->positionModel = $this->model('Position');
    }

    public function index()
    {
        Auth::requirePermission('position.view');

        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($search) {
            $conditions[] = "(ma_chuc_danh LIKE ? OR ten_chuc_danh LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

        $countSql = "SELECT COUNT(*) as total FROM chuc_danh $where";
        $result = $this->positionModel->query($countSql, $params);
        $total = $result[0]['total'];

        $pagination = new Pagination($total, $perPage, $page);

        $sql = "SELECT * FROM chuc_danh $where ORDER BY id DESC LIMIT ? OFFSET ?";
        $params[] = $pagination->getLimit();
        $params[] = $pagination->getOffset();
        $positions = $this->positionModel->query($sql, $params);

        $data = [
            'positions' => $positions,
            'pagination' => $pagination,
            'search' => $search,
            'canCreate' => Auth::hasPermission('position.create'),
            'canEdit' => Auth::hasPermission('position.edit'),
            'canDelete' => Auth::hasPermission('position.delete')
        ];

        $this->view('position/index', $data);
    }

    public function add()
    {
        Auth::requirePermission('position.create');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ma_chuc_danh' => $_POST['ma_chuc_danh'] ?? '',
                'ten_chuc_danh' => $_POST['ten_chuc_danh'] ?? '',
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'muc_luong_co_ban' => $_POST['muc_luong_co_ban'] ?? 0
            ];

            if ($this->positionModel->create($data)) {
                $_SESSION['success'] = 'Thêm chức danh thành công!';
                header('Location: ' . BASE_URL . 'position');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $this->view('position/add');
    }

    public function edit($id)
    {
        Auth::requirePermission('position.edit');

        $position = $this->positionModel->find($id);
        if (!$position) {
            $_SESSION['error'] = 'Không tìm thấy chức danh!';
            header('Location: ' . BASE_URL . 'position');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ma_chuc_danh' => $_POST['ma_chuc_danh'] ?? '',
                'ten_chuc_danh' => $_POST['ten_chuc_danh'] ?? '',
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'muc_luong_co_ban' => $_POST['muc_luong_co_ban'] ?? 0
            ];

            if ($this->positionModel->update($id, $data)) {
                $_SESSION['success'] = 'Cập nhật chức danh thành công!';
                header('Location: ' . BASE_URL . 'position');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        $this->view('position/edit', ['position' => $position]);
    }

    public function delete($id)
    {
        Auth::requirePermission('position.delete');

        $sql = "SELECT COUNT(*) as count FROM nhan_vien WHERE chuc_danh_id = ?";
        $result = $this->positionModel->query($sql, [$id]);

        if ($result[0]['count'] > 0) {
            $_SESSION['error'] = 'Không thể xóa chức danh đang có nhân viên!';
        } else {
            if ($this->positionModel->delete($id)) {
                $_SESSION['success'] = 'Xóa chức danh thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }

        header('Location: ' . BASE_URL . 'position');
        exit;
    }
}
