<?php

/**
 * Employee Model - Quản lý nhân viên
 */
class Employee extends Model
{
    protected $table = 'nhan_vien';

    /**
     * Tìm kiếm nhân viên theo nhiều tiêu chí
     */
    public function search($params)
    {
        $sql = "SELECT nv.*, pb.ten_phong_ban, cd.ten_chuc_danh 
                FROM {$this->table} nv
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE 1=1";

        $bindParams = [];

        if (!empty($params['ho_ten'])) {
            $sql .= " AND nv.ho_ten LIKE :ho_ten";
            $bindParams[':ho_ten'] = "%{$params['ho_ten']}%";
        }

        if (!empty($params['ma_nhan_vien'])) {
            $sql .= " AND nv.ma_nhan_vien LIKE :ma_nhan_vien";
            $bindParams[':ma_nhan_vien'] = "%{$params['ma_nhan_vien']}%";
        }

        if (!empty($params['phong_ban_id'])) {
            $sql .= " AND nv.phong_ban_id = :phong_ban_id";
            $bindParams[':phong_ban_id'] = $params['phong_ban_id'];
        }

        if (!empty($params['chuc_danh_id'])) {
            $sql .= " AND nv.chuc_danh_id = :chuc_danh_id";
            $bindParams[':chuc_danh_id'] = $params['chuc_danh_id'];
        }

        if (!empty($params['loai_nhan_vien'])) {
            $sql .= " AND nv.loai_nhan_vien = :loai_nhan_vien";
            $bindParams[':loai_nhan_vien'] = $params['loai_nhan_vien'];
        }

        if (!empty($params['trang_thai'])) {
            $sql .= " AND nv.trang_thai = :trang_thai";
            $bindParams[':trang_thai'] = $params['trang_thai'];
        }

        if (isset($params['la_dang_vien']) && $params['la_dang_vien'] !== '') {
            $sql .= " AND nv.la_dang_vien = :la_dang_vien";
            $bindParams[':la_dang_vien'] = $params['la_dang_vien'];
        }

        $sql .= " ORDER BY nv.id DESC";

        $stmt = $this->query($sql, $bindParams);
        return $stmt->fetchAll();
    }

    /**
     * Lấy nhân viên với thông tin phòng ban và chức danh
     */
    public function getAllWithDetails()
    {
        $sql = "SELECT nv.*, pb.ten_phong_ban, cd.ten_chuc_danh
                FROM {$this->table} nv
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                ORDER BY nv.id DESC";

        return $this->query($sql);
    }

    /**
     * Lấy nhân viên đến kỳ nâng lương (3 năm)
     */
    public function getNangLuongDinhKy()
    {
        $sql = "SELECT nv.*, pb.ten_phong_ban, cd.ten_chuc_danh,
                DATEDIFF(CURDATE(), nv.ngay_nang_luong_gan_nhat) as so_ngay
                FROM {$this->table} nv
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE nv.loai_nhan_vien = 'bien_che'
                AND nv.trang_thai = 'dang_lam'
                AND DATEDIFF(CURDATE(), nv.ngay_nang_luong_gan_nhat) >= 1095
                ORDER BY nv.ngay_nang_luong_gan_nhat ASC";

        return $this->query($sql);
    }

    /**
     * Lấy nhân viên đến tuổi nghỉ hưu (Nam: 60, Nữ: 55)
     */
    public function getNghiHuu()
    {
        $sql = "SELECT nv.*, pb.ten_phong_ban, cd.ten_chuc_danh,
                YEAR(CURDATE()) - YEAR(nv.ngay_sinh) as tuoi
                FROM {$this->table} nv
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE nv.trang_thai = 'dang_lam'
                AND (
                    (nv.gioi_tinh = 'Nam' AND YEAR(CURDATE()) - YEAR(nv.ngay_sinh) >= 60)
                    OR (nv.gioi_tinh = 'Nữ' AND YEAR(CURDATE()) - YEAR(nv.ngay_sinh) >= 55)
                )
                ORDER BY nv.ngay_sinh ASC";

        return $this->query($sql);
    }

    /**
     * Lấy nhân viên có sinh nhật trong tháng
     */
    public function getSinhNhatThang($thang, $nam)
    {
        $sql = "SELECT nv.*, pb.ten_phong_ban, cd.ten_chuc_danh,
                DAY(nv.ngay_sinh) as ngay_sinh_nhat
                FROM {$this->table} nv
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE nv.trang_thai = 'dang_lam'
                AND MONTH(nv.ngay_sinh) = ?
                ORDER BY DAY(nv.ngay_sinh) ASC";

        return $this->query($sql, [$thang]);
    }

    /**
     * Lấy thống kê nhân viên
     */
    public function getStatistics()
    {
        $sql = "SELECT 
                COUNT(*) as tong_nhan_vien,
                SUM(CASE WHEN loai_nhan_vien = 'bien_che' THEN 1 ELSE 0 END) as bien_che,
                SUM(CASE WHEN loai_nhan_vien = 'hop_dong' THEN 1 ELSE 0 END) as hop_dong,
                SUM(CASE WHEN trang_thai = 'dang_lam' THEN 1 ELSE 0 END) as dang_lam,
                SUM(CASE WHEN trang_thai = 'nghi_viec' THEN 1 ELSE 0 END) as nghi_viec,
                SUM(CASE WHEN trang_thai = 'nghi_huu' THEN 1 ELSE 0 END) as nghi_huu,
                SUM(CASE WHEN gioi_tinh = 'Nam' THEN 1 ELSE 0 END) as nam,
                SUM(CASE WHEN gioi_tinh = 'Nữ' THEN 1 ELSE 0 END) as nu,
                SUM(CASE WHEN la_dang_vien = 1 THEN 1 ELSE 0 END) as dang_vien
                FROM {$this->table}";

        $result = $this->query($sql);
        return $result[0] ?? [];
    }
}
