<?php

/**
 * Base Controller Class
 */
class Controller
{
    /**
     * Load model
     */
    protected function model($model)
    {
        $modelPath = APP_PATH . 'models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        }
        die("Model {$model} không tồn tại");
    }

    /**
     * Load view
     */
    protected function view($view, $data = [])
    {
        extract($data);
        $viewPath = APP_PATH . 'views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View {$view} không tồn tại");
        }
    }

    /**
     * Redirect to another page
     */
    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    /**
     * Check if user is logged in
     */
    protected function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
    }
}
