<?php

/**
 * Department Model - Quản lý phòng ban
 */
class Department extends Model
{
    protected $table = 'phong_ban';

    /**
     * Lấy tất cả phòng ban đang hoạt động
     */
    public function getActive()
    {
        $sql = "SELECT * FROM {$this->table} WHERE trang_thai = 'active' ORDER BY ten_phong_ban ASC";
        return $this->query($sql);
    }

    /**
     * Đếm số nhân viên trong phòng ban
     */
    public function countEmployees($id)
    {
        $sql = "SELECT COUNT(*) as total FROM nhan_vien WHERE phong_ban_id = ? AND trang_thai = 'dang_lam'";
        $result = $this->query($sql, [$id]);
        return $result[0]['total'] ?? 0;
    }

    /**
     * Lấy danh sách nhân viên trong phòng ban
     */
    public function getEmployees($id)
    {
        $sql = "SELECT nv.*, cd.ten_chuc_danh 
                FROM nhan_vien nv
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE nv.phong_ban_id = :id
                ORDER BY nv.ho_ten ASC";

        $stmt = $this->query($sql, [':id' => $id]);
        return $stmt->fetchAll();
    }
}
