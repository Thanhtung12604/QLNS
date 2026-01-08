<?php

class ReportController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    public function index()
    {
        Auth::requirePermission('report.view');

        $data = [
            'title' => 'Báo cáo và thống kê'
        ];

        $this->view('report/index', $data);
    }

    /**
     * Danh sách nhân viên đến kỳ nâng lương
     */
    public function nangLuong()
    {
        Auth::requirePermission('report.view');

        $employeeModel = $this->model('Employee');
        $employees = $employeeModel->getNangLuongDinhKy();

        $data = [
            'title' => 'Danh sách nhân viên đến kỳ nâng lương',
            'employees' => $employees
        ];

        $this->view('report/nang_luong', $data);
    }

    /**
     * Danh sách nhân viên đến tuổi nghỉ hưu
     */
    public function nghiHuu()
    {
        Auth::requirePermission('report.view');

        $employeeModel = $this->model('Employee');
        $employees = $employeeModel->getNghiHuu();

        $data = [
            'title' => 'Danh sách nhân viên đến tuổi nghỉ hưu',
            'employees' => $employees
        ];

        $this->view('report/nghi_huu', $data);
    }

    /**
     * Danh sách sinh nhật
     */
    public function sinhNhat()
    {
        Auth::requirePermission('report.view');

        $thang = $_GET['thang'] ?? date('m');
        $nam = $_GET['nam'] ?? date('Y');

        $employeeModel = $this->model('Employee');
        $employees = $employeeModel->getSinhNhatThang($thang, $nam);

        $data = [
            'title' => 'Danh sách sinh nhật tháng ' . $thang,
            'employees' => $employees,
            'thang' => $thang,
            'nam' => $nam
        ];

        $this->view('report/sinh_nhat', $data);
    }
}
