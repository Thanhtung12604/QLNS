<?php

/**
 * Salary Model - Quản lý lương
 */
class Salary extends Model
{
    protected $table = 'bang_luong';

    private function calculateTNCN($thuNhapChiuThue)
    {
        $thue = 0;
        $thuNhap = $thuNhapChiuThue;

        if ($thuNhap <= 0) return 0;

        if ($thuNhap <= 5000000) {
            $thue = $thuNhap * 0.05;
        } elseif ($thuNhap <= 10000000) {
            $thue = 5000000 * 0.05 + ($thuNhap - 5000000) * 0.10;
        } elseif ($thuNhap <= 18000000) {
            $thue = 5000000 * 0.05 + 5000000 * 0.10 + ($thuNhap - 10000000) * 0.15;
        } elseif ($thuNhap <= 32000000) {
            $thue = 5000000 * 0.05 + 5000000 * 0.10 + 8000000 * 0.15 + ($thuNhap - 18000000) * 0.20;
        } elseif ($thuNhap <= 52000000) {
            $thue = 5000000 * 0.05 + 5000000 * 0.10 + 8000000 * 0.15 + 14000000 * 0.20 + ($thuNhap - 32000000) * 0.25;
        } elseif ($thuNhap <= 80000000) {
            $thue = 5000000 * 0.05 + 5000000 * 0.10 + 8000000 * 0.15 + 14000000 * 0.20 + 20000000 * 0.25 + ($thuNhap - 52000000) * 0.30;
        } else {
            $thue = 5000000 * 0.05 + 5000000 * 0.10 + 8000000 * 0.15 + 14000000 * 0.20 + 20000000 * 0.25 + 28000000 * 0.30 + ($thuNhap - 80000000) * 0.35;
        }

        return round($thue);
    }

    /**
     * Lấy bảng lương theo tháng/năm
     */
    public function getByMonth($thang, $nam)
    {
        $sql = "SELECT bl.*, nv.ma_nhan_vien, nv.ho_ten, nv.loai_nhan_vien,
                pb.ten_phong_ban, cd.ten_chuc_danh
                FROM {$this->table} bl
                INNER JOIN nhan_vien nv ON bl.nhan_vien_id = nv.id
                LEFT JOIN phong_ban pb ON nv.phong_ban_id = pb.id
                LEFT JOIN chuc_danh cd ON nv.chuc_danh_id = cd.id
                WHERE bl.thang = ? AND bl.nam = ?
                ORDER BY nv.ho_ten ASC";

        return $this->query($sql, [$thang, $nam]);
    }

    /**
     * Lấy lương của một nhân viên
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
     * Tính lương tháng cho tất cả nhân viên
     */
    public function calculateMonthSalary($thang, $nam)
    {
        // Lấy danh sách nhân viên đang làm
        $sqlNV = "SELECT nv.*, 
                  COALESCE(cc.so_ngay_cong, 0) as so_ngay_cong,
                  COALESCE(SUM(nvpc.muc_huong), 0) as tong_phu_cap
                  FROM nhan_vien nv
                  LEFT JOIN cham_cong cc ON nv.id = cc.nhan_vien_id 
                      AND cc.thang = ? AND cc.nam = ?
                  LEFT JOIN nhan_vien_phu_cap nvpc ON nv.id = nvpc.nhan_vien_id
                      AND (nvpc.ngay_ket_thuc IS NULL OR nvpc.ngay_ket_thuc >= CURDATE())
                  WHERE nv.trang_thai = 'dang_lam'
                  GROUP BY nv.id";

        $employees = $this->query($sqlNV, [$thang, $nam]);

        $success = 0;
        foreach ($employees as $emp) {
            // Kiểm tra đã tồn tại chưa
            $existing = $this->getByEmployee($emp['id'], $thang, $nam);
            if ($existing) continue;

            $luongCoBan = 0;
            $tongLuong = 0;
            $tongBaoHiem = 0;

            if ($emp['loai_nhan_vien'] == 'bien_che') {
                // Tính lương biên chế: Bậc lương × Hệ số
                $luongCoBan = 1800000 * ($emp['he_so_luong'] ?? 1.0); // 1,800,000 là lương cơ sở
                $tongLuong = $luongCoBan + $emp['tong_phu_cap'];

                // Tính bảo hiểm (10.5% BHXH + 1.5% BHYT + 1% BHTN)
                $tongBaoHiem = $luongCoBan * 0.105 + $luongCoBan * 0.015 + $luongCoBan * 0.01;
            } else {
                // Lương hợp đồng
                $luongCoBan = $emp['muc_luong_hop_dong'] ?? 0;
                $tongLuong = $luongCoBan;
            }

            // Tính theo ngày công
            $soNgayCong = $emp['so_ngay_cong'] ?? 0;
            $soNgayCongChuan = 26;
            if ($soNgayCong < $soNgayCongChuan && $soNgayCong > 0) {
                $tongLuong = ($tongLuong / $soNgayCongChuan) * $soNgayCong;
            }

            // Tính thuế TNCN theo luật 2026
            $giamTruBanThan = 15500000;
            $giamTruPhuThuoc = ($emp['so_con'] ?? 0) * 5500000;
            $thuNhapChiuThue = $tongLuong - $tongBaoHiem - $giamTruBanThan - $giamTruPhuThuoc;
            $thueTNCN = $this->calculateTNCN($thuNhapChiuThue);

            $thucLinh = $tongLuong - $tongBaoHiem - $thueTNCN;

            $data = [
                'nhan_vien_id' => $emp['id'],
                'thang' => $thang,
                'nam' => $nam,
                'bac_luong' => $emp['bac_luong'],
                'he_so_luong' => $emp['he_so_luong'],
                'luong_co_ban' => $luongCoBan,
                'tong_phu_cap' => $emp['tong_phu_cap'],
                'so_ngay_cong' => $soNgayCong,
                'so_ngay_cong_chuan' => $soNgayCongChuan,
                'bhxh' => $emp['loai_nhan_vien'] == 'bien_che' ? $luongCoBan * 0.105 : 0,
                'bhyt' => $emp['loai_nhan_vien'] == 'bien_che' ? $luongCoBan * 0.015 : 0,
                'bhtn' => $emp['loai_nhan_vien'] == 'bien_che' ? $luongCoBan * 0.01 : 0,
                'tong_bao_hiem' => $tongBaoHiem,
                'giam_tru_ban_than' => $giamTruBanThan,
                'giam_tru_phu_thuoc' => $giamTruPhuThuoc,
                'thu_nhap_chiu_thue' => max(0, $thuNhapChiuThue),
                'thue_tncn' => $thueTNCN,
                'tong_luong' => $tongLuong,
                'thuc_linh' => $thucLinh,
                'trang_thai' => 'chua_duyet'
            ];

            if ($this->insert($data)) {
                $success++;
            }
        }

        return $success;
    }

    /**
     * Thống kê tổng lương theo tháng
     */
    public function getTotalByMonth($thang, $nam)
    {
        $sql = "SELECT 
                SUM(tong_luong) as tong_luong,
                SUM(thuc_linh) as tong_thuc_linh,
                SUM(tong_bao_hiem) as tong_bao_hiem,
                COUNT(*) as so_nhan_vien
                FROM {$this->table}
                WHERE thang = ? AND nam = ?";

        $result = $this->query($sql, [$thang, $nam]);
        return $result[0] ?? [];
    }
}
