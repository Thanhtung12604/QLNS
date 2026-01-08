<?php

/**
 * WorkHistory Model - Quản lý quá trình công tác
 */
class WorkHistory extends Model
{
    protected $table = 'qua_trinh_cong_tac';

    /**
     * Lấy quá trình công tác của nhân viên
     */
    public function getByEmployee($nhanVienId)
    {
        $sql = "SELECT qtct.*, 
                pb_cu.ten_phong_ban as phong_ban_cu,
                pb_moi.ten_phong_ban as phong_ban_moi,
                cd_cu.ten_chuc_danh as chuc_danh_cu,
                cd_moi.ten_chuc_danh as chuc_danh_moi
                FROM {$this->table} qtct
                LEFT JOIN phong_ban pb_cu ON qtct.phong_ban_cu_id = pb_cu.id
                LEFT JOIN phong_ban pb_moi ON qtct.phong_ban_moi_id = pb_moi.id
                LEFT JOIN chuc_danh cd_cu ON qtct.chuc_danh_cu_id = cd_cu.id
                LEFT JOIN chuc_danh cd_moi ON qtct.chuc_danh_moi_id = cd_moi.id
                WHERE qtct.nhan_vien_id = ?
                ORDER BY qtct.ngay_quyet_dinh DESC";

        return $this->query($sql, [$nhanVienId]);
    }
}
