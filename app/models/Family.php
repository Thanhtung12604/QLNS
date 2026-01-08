<?php

/**
 * Family Model - Quản lý thông tin gia đình
 */
class Family extends Model
{
    protected $table = 'thong_tin_gia_dinh';

    /**
     * Lấy thông tin gia đình của nhân viên
     */
    public function getByEmployee($nhanVienId)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE nhan_vien_id = :nhan_vien_id
                ORDER BY 
                    CASE quan_he
                        WHEN 'cha' THEN 1
                        WHEN 'me' THEN 2
                        WHEN 'vo' THEN 3
                        WHEN 'chong' THEN 3
                        WHEN 'con' THEN 4
                        WHEN 'anh_trai' THEN 5
                        WHEN 'chi_gai' THEN 6
                        WHEN 'em_trai' THEN 7
                        WHEN 'em_gai' THEN 8
                        ELSE 9
                    END,
                    nam_sinh ASC";

        return $this->query($sql, [$nhanVienId]);
    }

    /**
     * Thêm thành viên gia đình
     */
    public function addMember($data)
    {
        return $this->insert($data);
    }

    /**
     * Xóa thành viên gia đình
     */
    public function deleteMember($id)
    {
        return $this->delete($id);
    }

    /**
     * Xóa tất cả thành viên gia đình của nhân viên
     */
    public function deleteByEmployee($nhanVienId)
    {
        $sql = "DELETE FROM {$this->table} WHERE nhan_vien_id = :nhan_vien_id";
        $stmt = $this->query($sql, [':nhan_vien_id' => $nhanVienId]);
        return $stmt->execute();
    }

    /**
     * Đếm số thành viên gia đình
     */
    public function countByEmployee($nhanVienId)
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE nhan_vien_id = ?";
        $result = $this->query($sql, [$nhanVienId]);
        return $result[0]['total'] ?? 0;
    }

    /**
     * Lấy tên quan hệ
     */
    public static function getRelationName($relation)
    {
        $names = [
            'cha' => 'Cha',
            'me' => 'Mẹ',
            'vo' => 'Vợ',
            'chong' => 'Chồng',
            'con' => 'Con',
            'anh_trai' => 'Anh trai',
            'chi_gai' => 'Chị gái',
            'em_trai' => 'Em trai',
            'em_gai' => 'Em gái',
            'khac' => 'Khác'
        ];
        return $names[$relation] ?? $relation;
    }
}
