<?php

class SalaryController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    public function index()
    {
        Auth::requirePermission('salary.view');

        $thang = $_GET['thang'] ?? date('m');
        $nam = $_GET['nam'] ?? date('Y');

        $salaryModel = $this->model('Salary');
        $salaries = $salaryModel->getByMonth($thang, $nam);
        $total = $salaryModel->getTotalByMonth($thang, $nam);

        $data = [
            'title' => 'Quản lý lương',
            'salaries' => $salaries,
            'total' => $total,
            'thang' => $thang,
            'nam' => $nam
        ];

        $this->view('salary/index', $data);
    }

    public function calculate()
    {
        Auth::requirePermission('salary.manage');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];

            $salaryModel = $this->model('Salary');
            $count = $salaryModel->calculateMonthSalary($thang, $nam);

            $this->redirect('salary?thang=' . $thang . '&nam=' . $nam);
        }
    }
}
