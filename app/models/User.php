<?php

/**
 * User Model - Quản lý người dùng
 */
class User extends Model
{
    protected $table = 'users';

    public function login($username, $password)
    {
        $sql = "SELECT u.*, nv.ho_ten, nv.email
                FROM {$this->table} u
                LEFT JOIN nhan_vien nv ON u.nhan_vien_id = nv.id
                WHERE u.username = ? AND u.is_active = 1";

        $result = $this->query($sql, [$username]);
        $user = $result[0] ?? null;

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function updateLastLogin($userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }

    public function createUser($username, $password, $roleId, $nhanVienId = null)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->insert([
            'username' => $username,
            'password' => $hashedPassword,
            'role_id' => $roleId,
            'nhan_vien_id' => $nhanVienId,
            'is_active' => 1
        ]);
    }

    public function changePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($userId, ['password' => $hashedPassword]);
    }
}
