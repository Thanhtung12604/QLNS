<?php

class HomeController extends Controller
{
    public function index()
    {
        Auth::requireLogin();

        $employeeModel = $this->model('Employee');
        $stats = $employeeModel->getStatistics();

        $data = [
            'title' => 'Trang chủ',
            'stats' => $stats
        ];

        $this->view('home/index', $data);
    }
}
