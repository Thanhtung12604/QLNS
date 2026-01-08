<?php

/**
 * Attendance Model - Quản lý chấm công
 */
class Attendance extends Model
{
    protected $table = 'cham_cong';

    /**
     * Lấy bảng chấm công theo tháng/năm
     */
    public function getByMonth($thang, $nam)
    {
        $sql = "SELECT cc.*, nv.ma_nhan_vien, nv.ho_ten, pb.ten_phong_ban, cd.ten_chuc_danh
                FROM {$this->table} cc
                INNER JOIN nhan_vien nv ON cc.nhan_vien_id = nv.id
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE cc.thang = ? AND cc.nam = ?
                ORDER BY nv.ho_ten ASC";

        return $this->query($sql, [$thang, $nam]);
    }

    /**
     * Lấy chấm công của một nhân viên
     */
    public function getByEmployee($nhanVienId, $thang, $nam)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE nhan_vien_id = ? 
                AND thang = ? AND nam = ?";

        $result = $this->query($sql, [$nhanVienId, $thang, $nam]);
        return $result[0] ?? null;
    }

    /**
     * Cập nhật hoặc tạo mới chấm công
     */
    public function updateOrCreate($data)
    {
        $existing = $this->getByEmployee($data['nhan_vien_id'], $data['thang'], $data['nam']);

        if ($existing) {
            return $this->update($existing['id'], $data);
        } else {
            return $this->insert($data);
        }
    }

    /**
     * Lấy chi tiết chấm công hàng ngày
     */
    public function getDailyAttendance($nhanVienId, $thang, $nam)
    {
        $sql = "SELECT * FROM chi_tiet_cham_cong 
                WHERE nhan_vien_id = :nhan_vien_id 
                AND MONTH(ngay) = ? AND YEAR(ngay) = ?
                ORDER BY ngay ASC";

        return $this->query($sql, [$nhanVienId, $thang, $nam]);
    }
}
