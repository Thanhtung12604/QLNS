<?php

class AuthController extends Controller
{
    public function login()
    {
        // Clear any corrupted session data on login page
        if (isset($_SESSION['user_id']) && !is_numeric($_SESSION['user_id'])) {
            session_destroy();
            session_start();
        }

        if (Auth::check()) {
            $this->redirect('home');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];
                $_SESSION['nhan_vien_id'] = $user['nhan_vien_id'];

                $roleModel = $this->model('Role');
                $permissions = $roleModel->getPermissions($user['role_id']);
                $_SESSION['permissions'] = array_column($permissions, 'name');

                $userModel->updateLastLogin($user['id']);

                $this->redirect('home');
            } else {
                $data = [
                    'title' => 'Đăng nhập',
                    'error' => 'Tên đăng nhập hoặc mật khẩu không đúng!'
                ];
                $this->view('auth/login', $data);
            }
        } else {
            $data = ['title' => 'Đăng nhập'];
            $this->view('auth/login', $data);
        }
    }

    public function logout()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        $this->redirect('auth/login');
    }
}
