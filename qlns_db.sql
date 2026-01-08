-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th1 06, 2026 lúc 07:26 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlns_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bang_luong`
--

CREATE TABLE `bang_luong` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `thang` int NOT NULL,
  `nam` int NOT NULL,
  `bac_luong` int DEFAULT NULL,
  `he_so_luong` decimal(4,2) DEFAULT NULL,
  `luong_co_ban` decimal(15,2) DEFAULT NULL,
  `tong_phu_cap` decimal(15,2) DEFAULT '0.00',
  `so_ngay_cong` decimal(5,2) DEFAULT NULL,
  `so_ngay_cong_chuan` decimal(5,2) DEFAULT '26.00',
  `bhxh` decimal(15,2) DEFAULT '0.00',
  `bhyt` decimal(15,2) DEFAULT '0.00',
  `bhtn` decimal(15,2) DEFAULT '0.00',
  `tong_bao_hiem` decimal(15,2) DEFAULT '0.00',
  `thuong` decimal(15,2) DEFAULT '0.00',
  `phat` decimal(15,2) DEFAULT '0.00',
  `khac` decimal(15,2) DEFAULT '0.00',
  `tong_luong` decimal(15,2) NOT NULL,
  `thuc_linh` decimal(15,2) NOT NULL,
  `trang_thai` enum('chua_duyet','da_duyet','da_thanh_toan') DEFAULT 'chua_duyet',
  `ngay_thanh_toan` date DEFAULT NULL,
  `nguoi_duyet_id` int DEFAULT NULL,
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bao_hiem`
--

CREATE TABLE `bao_hiem` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `loai_bao_hiem` enum('xa_hoi','y_te','that_nghiep') NOT NULL,
  `so_so` varchar(50) DEFAULT NULL,
  `ngay_cap` date DEFAULT NULL,
  `noi_cap` varchar(100) DEFAULT NULL,
  `ti_le_dong` decimal(5,2) DEFAULT '0.00',
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cham_cong`
--

CREATE TABLE `cham_cong` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `thang` int NOT NULL,
  `nam` int NOT NULL,
  `so_ngay_cong` decimal(5,2) DEFAULT '0.00',
  `so_ngay_nghi_phep` decimal(5,2) DEFAULT '0.00',
  `so_ngay_nghi_khong_phep` decimal(5,2) DEFAULT '0.00',
  `di_tre_ve_som` int DEFAULT '0',
  `ghi_chu` text,
  `nguoi_cham_id` int DEFAULT NULL,
  `ngay_cham` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_cham_cong`
--

CREATE TABLE `chi_tiet_cham_cong` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `ngay` date NOT NULL,
  `gio_vao` time DEFAULT NULL,
  `gio_ra` time DEFAULT NULL,
  `trang_thai` enum('di_lam','nghi_phep','nghi_khong_phep','di_tre','ve_som','nghi_le') DEFAULT 'di_lam',
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_danh`
--

CREATE TABLE `chuc_danh` (
  `id` int NOT NULL,
  `ma_chuc_danh` varchar(20) NOT NULL,
  `ten_chuc_danh` varchar(100) NOT NULL,
  `mo_ta` text,
  `muc_luong_co_ban` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `chuc_danh`
--

INSERT INTO `chuc_danh` (`id`, `ma_chuc_danh`, `ten_chuc_danh`, `mo_ta`, `muc_luong_co_ban`, `created_at`, `updated_at`) VALUES
(1, 'CD001', 'Giám đốc', 'Giám đốc công ty', 20000000.00, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(2, 'CD002', 'Phó giám đốc', 'Phó giám đốc công ty', 15000000.00, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(3, 'CD003', 'Trưởng phòng', 'Trưởng phòng ban', 12000000.00, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(4, 'CD004', 'Phó phòng', 'Phó phòng ban', 10000000.00, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(5, 'CD005', 'Nhân viên', 'Nhân viên thường', 7000000.00, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(6, 'CD006', 'Chuyên viên', 'Chuyên viên', 8000000.00, '2026-01-06 03:45:37', '2026-01-06 03:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `id` int NOT NULL,
  `ma_nhan_vien` varchar(20) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` enum('Nam','Nữ','Khác') NOT NULL,
  `so_cmnd` varchar(20) NOT NULL,
  `ngay_cap_cmnd` date DEFAULT NULL,
  `noi_cap_cmnd` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `dia_chi_hien_tai` text,
  `dia_chi_thuong_tru` text,
  `ho_khau_thuong_tru` text,
  `dan_toc` varchar(50) DEFAULT 'Kinh',
  `ton_giao` varchar(50) DEFAULT NULL,
  `tinh_trang_hon_nhan` enum('doc_than','da_ket_hon','ly_hon','goa') DEFAULT 'doc_than',
  `so_con` int DEFAULT '0',
  `loai_nhan_vien` enum('bien_che','hop_dong') NOT NULL,
  `phong_ban_id` int DEFAULT NULL,
  `chuc_danh_id` int DEFAULT NULL,
  `ngay_vao_lam` date NOT NULL,
  `ngay_nghi_viec` date DEFAULT NULL,
  `trang_thai` enum('dang_lam','nghi_viec','nghi_huu') DEFAULT 'dang_lam',
  `ngay_vao_doan` date DEFAULT NULL,
  `la_dang_vien` tinyint(1) DEFAULT '0',
  `ngay_vao_dang` date DEFAULT NULL,
  `dien_chinh_sach` varchar(200) DEFAULT NULL,
  `trinh_do_hoc_van` varchar(50) DEFAULT NULL,
  `trinh_do_chuyen_mon` varchar(100) DEFAULT NULL,
  `chuyen_nganh` varchar(100) DEFAULT NULL,
  `bang_cap` text,
  `trinh_do_ngoai_ngu` varchar(200) DEFAULT NULL,
  `chung_chi_ngoai_ngu` text,
  `tin_hoc` varchar(100) DEFAULT NULL,
  `bac_luong` int DEFAULT NULL,
  `he_so_luong` decimal(4,2) DEFAULT NULL,
  `ngay_nang_luong_gan_nhat` date DEFAULT NULL,
  `muc_luong_hop_dong` decimal(15,2) DEFAULT NULL,
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien_phu_cap`
--

CREATE TABLE `nhan_vien_phu_cap` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `phu_cap_id` int NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `muc_huong` decimal(15,2) DEFAULT NULL,
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `module`, `description`, `created_at`, `updated_at`) VALUES
(1, 'employee.view', 'Xem nhân viên', 'employee', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(2, 'employee.create', 'Thêm nhân viên', 'employee', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(3, 'employee.edit', 'Sửa nhân viên', 'employee', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(4, 'employee.delete', 'Xóa nhân viên', 'employee', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(5, 'department.view', 'Xem phòng ban', 'department', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(6, 'department.create', 'Thêm phòng ban', 'department', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(7, 'department.edit', 'Sửa phòng ban', 'department', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(8, 'department.delete', 'Xóa phòng ban', 'department', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(9, 'position.view', 'Xem chức danh', 'position', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(10, 'position.create', 'Thêm chức danh', 'position', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(11, 'position.edit', 'Sửa chức danh', 'position', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(12, 'position.delete', 'Xóa chức danh', 'position', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(13, 'attendance.view', 'Xem chấm công', 'attendance', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(14, 'attendance.create', 'Thêm chấm công', 'attendance', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(15, 'attendance.edit', 'Sửa chấm công', 'attendance', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(16, 'attendance.delete', 'Xóa chấm công', 'attendance', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(17, 'salary.view', 'Xem lương', 'salary', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(18, 'salary.create', 'Tạo bảng lương', 'salary', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(19, 'salary.edit', 'Sửa bảng lương', 'salary', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(20, 'salary.delete', 'Xóa bảng lương', 'salary', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(21, 'salary.approve', 'Duyệt lương', 'salary', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(22, 'report.view', 'Xem báo cáo', 'report', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(23, 'report.export', 'Xuất báo cáo', 'report', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(24, 'user.view', 'Xem người dùng', 'user', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(25, 'user.create', 'Thêm người dùng', 'user', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(26, 'user.edit', 'Sửa người dùng', 'user', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(27, 'user.delete', 'Xóa người dùng', 'user', NULL, '2026-01-06 03:45:37', '2026-01-06 03:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_cong_cong_viec`
--

CREATE TABLE `phan_cong_cong_viec` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `ten_cong_viec` varchar(200) NOT NULL,
  `mo_ta` text,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `trang_thai` enum('chua_bat_dau','dang_thuc_hien','hoan_thanh','tam_dung') DEFAULT 'chua_bat_dau',
  `muc_do_uu_tien` enum('thap','trung_binh','cao','khan_cap') DEFAULT 'trung_binh',
  `nguoi_giao_viec_id` int DEFAULT NULL,
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong_ban`
--

CREATE TABLE `phong_ban` (
  `id` int NOT NULL,
  `ma_phong_ban` varchar(20) NOT NULL,
  `ten_phong_ban` varchar(100) NOT NULL,
  `mo_ta` text,
  `ngay_thanh_lap` date DEFAULT NULL,
  `trang_thai` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `phong_ban`
--

INSERT INTO `phong_ban` (`id`, `ma_phong_ban`, `ten_phong_ban`, `mo_ta`, `ngay_thanh_lap`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'PB001', 'Phòng Hành chính - Nhân sự', 'Quản lý nhân sự và công việc hành chính', '2020-01-01', 'active', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(2, 'PB002', 'Phòng Kế toán - Tài chính', 'Quản lý tài chính và kế toán', '2020-01-01', 'active', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(3, 'PB003', 'Phòng Kỹ thuật', 'Phòng kỹ thuật công nghệ thông tin', '2020-01-01', 'active', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(4, 'PB004', 'Phòng Kinh doanh', 'Phát triển kinh doanh và marketing', '2020-01-01', 'active', '2026-01-06 03:45:37', '2026-01-06 03:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phu_cap`
--

CREATE TABLE `phu_cap` (
  `id` int NOT NULL,
  `ma_phu_cap` varchar(20) NOT NULL,
  `ten_phu_cap` varchar(100) NOT NULL,
  `muc_phu_cap` decimal(15,2) NOT NULL,
  `loai_phu_cap` enum('chuc_vu','trach_nhiem','khu_vuc','doc_hai','khac') NOT NULL,
  `mo_ta` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `phu_cap`
--

INSERT INTO `phu_cap` (`id`, `ma_phu_cap`, `ten_phu_cap`, `muc_phu_cap`, `loai_phu_cap`, `mo_ta`, `created_at`, `updated_at`) VALUES
(1, 'PC001', 'Phụ cấp chức vụ - Giám đốc', 3000000.00, 'chuc_vu', 'Phụ cấp giám đốc', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(2, 'PC002', 'Phụ cấp chức vụ - Trưởng phòng', 2000000.00, 'chuc_vu', 'Phụ cấp trưởng phòng', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(3, 'PC003', 'Phụ cấp trách nhiệm', 1000000.00, 'trach_nhiem', 'Phụ cấp trách nhiệm công việc', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(4, 'PC004', 'Phụ cấp khu vực', 500000.00, 'khu_vuc', 'Phụ cấp khu vực xa', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(5, 'PC005', 'Phụ cấp độc hại', 1500000.00, 'doc_hai', 'Phụ cấp môi trường độc hại', '2026-01-06 03:45:37', '2026-01-06 03:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qua_trinh_cong_tac`
--

CREATE TABLE `qua_trinh_cong_tac` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `loai_quyet_dinh` enum('dieu_dong','chuyen_cong_tac','nang_bac_luong','khen_thuong','ky_luat','khac') NOT NULL,
  `so_quyet_dinh` varchar(50) DEFAULT NULL,
  `ngay_quyet_dinh` date NOT NULL,
  `ngay_hieu_luc` date DEFAULT NULL,
  `noi_dung` text NOT NULL,
  `phong_ban_cu_id` int DEFAULT NULL,
  `phong_ban_moi_id` int DEFAULT NULL,
  `chuc_danh_cu_id` int DEFAULT NULL,
  `chuc_danh_moi_id` int DEFAULT NULL,
  `bac_luong_cu` int DEFAULT NULL,
  `bac_luong_moi` int DEFAULT NULL,
  `he_so_luong_cu` decimal(4,2) DEFAULT NULL,
  `he_so_luong_moi` decimal(4,2) DEFAULT NULL,
  `file_dinh_kem` varchar(255) DEFAULT NULL,
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Quản trị viên', 'Toàn quyền quản trị hệ thống', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(2, 'manager', 'Quản lý', 'Quản lý nhân viên và phòng ban', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(3, 'hr', 'Nhân sự', 'Quản lý thông tin nhân viên', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(4, 'accountant', 'Kế toán', 'Quản lý lương và chấm công', '2026-01-06 03:45:37', '2026-01-06 03:45:37'),
(5, 'staff', 'Nhân viên', 'Xem thông tin cá nhân', '2026-01-06 03:45:37', '2026-01-06 03:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`) VALUES
(1, 1, 14, '2026-01-06 03:45:37'),
(2, 1, 16, '2026-01-06 03:45:37'),
(3, 1, 15, '2026-01-06 03:45:37'),
(4, 1, 13, '2026-01-06 03:45:37'),
(5, 1, 6, '2026-01-06 03:45:37'),
(6, 1, 8, '2026-01-06 03:45:37'),
(7, 1, 7, '2026-01-06 03:45:37'),
(8, 1, 5, '2026-01-06 03:45:37'),
(9, 1, 2, '2026-01-06 03:45:37'),
(10, 1, 4, '2026-01-06 03:45:37'),
(11, 1, 3, '2026-01-06 03:45:37'),
(12, 1, 1, '2026-01-06 03:45:37'),
(13, 1, 10, '2026-01-06 03:45:37'),
(14, 1, 12, '2026-01-06 03:45:37'),
(15, 1, 11, '2026-01-06 03:45:37'),
(16, 1, 9, '2026-01-06 03:45:37'),
(17, 1, 23, '2026-01-06 03:45:37'),
(18, 1, 22, '2026-01-06 03:45:37'),
(19, 1, 21, '2026-01-06 03:45:37'),
(20, 1, 18, '2026-01-06 03:45:37'),
(21, 1, 20, '2026-01-06 03:45:37'),
(22, 1, 19, '2026-01-06 03:45:37'),
(23, 1, 17, '2026-01-06 03:45:37'),
(24, 1, 25, '2026-01-06 03:45:37'),
(25, 1, 27, '2026-01-06 03:45:37'),
(26, 1, 26, '2026-01-06 03:45:37'),
(27, 1, 24, '2026-01-06 03:45:37'),
(32, 2, 1, '2026-01-06 03:45:37'),
(33, 2, 2, '2026-01-06 03:45:37'),
(34, 2, 3, '2026-01-06 03:45:37'),
(35, 2, 4, '2026-01-06 03:45:37'),
(36, 2, 5, '2026-01-06 03:45:37'),
(37, 2, 6, '2026-01-06 03:45:37'),
(38, 2, 7, '2026-01-06 03:45:37'),
(39, 2, 8, '2026-01-06 03:45:37'),
(40, 2, 9, '2026-01-06 03:45:37'),
(41, 2, 10, '2026-01-06 03:45:37'),
(42, 2, 11, '2026-01-06 03:45:37'),
(43, 2, 12, '2026-01-06 03:45:37'),
(44, 2, 13, '2026-01-06 03:45:37'),
(45, 2, 14, '2026-01-06 03:45:37'),
(46, 2, 15, '2026-01-06 03:45:37'),
(47, 2, 16, '2026-01-06 03:45:37'),
(48, 2, 17, '2026-01-06 03:45:37'),
(49, 2, 18, '2026-01-06 03:45:37'),
(50, 2, 19, '2026-01-06 03:45:37'),
(51, 2, 20, '2026-01-06 03:45:37'),
(52, 2, 21, '2026-01-06 03:45:37'),
(53, 2, 22, '2026-01-06 03:45:37'),
(54, 2, 23, '2026-01-06 03:45:37'),
(63, 3, 1, '2026-01-06 03:45:37'),
(64, 3, 2, '2026-01-06 03:45:37'),
(65, 3, 3, '2026-01-06 03:45:37'),
(66, 3, 4, '2026-01-06 03:45:37'),
(67, 3, 5, '2026-01-06 03:45:37'),
(68, 3, 6, '2026-01-06 03:45:37'),
(69, 3, 7, '2026-01-06 03:45:37'),
(70, 3, 8, '2026-01-06 03:45:37'),
(71, 3, 9, '2026-01-06 03:45:37'),
(72, 3, 10, '2026-01-06 03:45:37'),
(73, 3, 11, '2026-01-06 03:45:37'),
(74, 3, 12, '2026-01-06 03:45:37'),
(78, 4, 13, '2026-01-06 03:45:37'),
(79, 4, 14, '2026-01-06 03:45:37'),
(80, 4, 15, '2026-01-06 03:45:37'),
(81, 4, 16, '2026-01-06 03:45:37'),
(82, 4, 17, '2026-01-06 03:45:37'),
(83, 4, 18, '2026-01-06 03:45:37'),
(84, 4, 19, '2026-01-06 03:45:37'),
(85, 4, 20, '2026-01-06 03:45:37'),
(86, 4, 21, '2026-01-06 03:45:37'),
(87, 4, 22, '2026-01-06 03:45:37'),
(88, 4, 23, '2026-01-06 03:45:37'),
(93, 5, 1, '2026-01-06 03:45:37'),
(94, 5, 13, '2026-01-06 03:45:37'),
(95, 5, 17, '2026-01-06 03:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_gia_dinh`
--

CREATE TABLE `thong_tin_gia_dinh` (
  `id` int NOT NULL,
  `nhan_vien_id` int NOT NULL,
  `quan_he` enum('cha','me','vo','chong','con','anh_trai','chi_gai','em_trai','em_gai','khac') NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `nam_sinh` int DEFAULT NULL,
  `nghe_nghiep` varchar(100) DEFAULT NULL,
  `noi_o_hien_nay` text,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `ghi_chu` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nhan_vien_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nhan_vien_id`, `role_id`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$DZYUrFbet6HOfvU8Sr6HaOnNIEoZD1EVKuRe9/YfdqFax2qzBIPpK', NULL, 1, 1, '2026-01-06 07:01:20', '2026-01-06 03:45:37', '2026-01-06 07:01:20');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bang_luong`
--
ALTER TABLE `bang_luong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_bang_luong` (`nhan_vien_id`,`thang`,`nam`),
  ADD KEY `nguoi_duyet_id` (`nguoi_duyet_id`);

--
-- Chỉ mục cho bảng `bao_hiem`
--
ALTER TABLE `bao_hiem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhan_vien_id` (`nhan_vien_id`);

--
-- Chỉ mục cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cham_cong` (`nhan_vien_id`,`thang`,`nam`),
  ADD KEY `nguoi_cham_id` (`nguoi_cham_id`);

--
-- Chỉ mục cho bảng `chi_tiet_cham_cong`
--
ALTER TABLE `chi_tiet_cham_cong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ngay_cham` (`nhan_vien_id`,`ngay`);

--
-- Chỉ mục cho bảng `chuc_danh`
--
ALTER TABLE `chuc_danh`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_chuc_danh` (`ma_chuc_danh`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_nhan_vien` (`ma_nhan_vien`),
  ADD UNIQUE KEY `so_cmnd` (`so_cmnd`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `phong_ban_id` (`phong_ban_id`),
  ADD KEY `chuc_danh_id` (`chuc_danh_id`);

--
-- Chỉ mục cho bảng `nhan_vien_phu_cap`
--
ALTER TABLE `nhan_vien_phu_cap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhan_vien_id` (`nhan_vien_id`),
  ADD KEY `phu_cap_id` (`phu_cap_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `phan_cong_cong_viec`
--
ALTER TABLE `phan_cong_cong_viec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhan_vien_id` (`nhan_vien_id`),
  ADD KEY `nguoi_giao_viec_id` (`nguoi_giao_viec_id`);

--
-- Chỉ mục cho bảng `phong_ban`
--
ALTER TABLE `phong_ban`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_phong_ban` (`ma_phong_ban`);

--
-- Chỉ mục cho bảng `phu_cap`
--
ALTER TABLE `phu_cap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_phu_cap` (`ma_phu_cap`);

--
-- Chỉ mục cho bảng `qua_trinh_cong_tac`
--
ALTER TABLE `qua_trinh_cong_tac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhan_vien_id` (`nhan_vien_id`),
  ADD KEY `phong_ban_cu_id` (`phong_ban_cu_id`),
  ADD KEY `phong_ban_moi_id` (`phong_ban_moi_id`),
  ADD KEY `chuc_danh_cu_id` (`chuc_danh_cu_id`),
  ADD KEY `chuc_danh_moi_id` (`chuc_danh_moi_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_role_permission` (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Chỉ mục cho bảng `thong_tin_gia_dinh`
--
ALTER TABLE `thong_tin_gia_dinh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhan_vien_id` (`nhan_vien_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `nhan_vien_id` (`nhan_vien_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bang_luong`
--
ALTER TABLE `bang_luong`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bao_hiem`
--
ALTER TABLE `bao_hiem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_cham_cong`
--
ALTER TABLE `chi_tiet_cham_cong`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chuc_danh`
--
ALTER TABLE `chuc_danh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhan_vien_phu_cap`
--
ALTER TABLE `nhan_vien_phu_cap`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `phan_cong_cong_viec`
--
ALTER TABLE `phan_cong_cong_viec`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phong_ban`
--
ALTER TABLE `phong_ban`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phu_cap`
--
ALTER TABLE `phu_cap`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `qua_trinh_cong_tac`
--
ALTER TABLE `qua_trinh_cong_tac`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `thong_tin_gia_dinh`
--
ALTER TABLE `thong_tin_gia_dinh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `bang_luong`
--
ALTER TABLE `bang_luong`
  ADD CONSTRAINT `bang_luong_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bang_luong_ibfk_2` FOREIGN KEY (`nguoi_duyet_id`) REFERENCES `nhan_vien` (`id`);

--
-- Ràng buộc cho bảng `bao_hiem`
--
ALTER TABLE `bao_hiem`
  ADD CONSTRAINT `bao_hiem_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD CONSTRAINT `cham_cong_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cham_cong_ibfk_2` FOREIGN KEY (`nguoi_cham_id`) REFERENCES `nhan_vien` (`id`);

--
-- Ràng buộc cho bảng `chi_tiet_cham_cong`
--
ALTER TABLE `chi_tiet_cham_cong`
  ADD CONSTRAINT `chi_tiet_cham_cong_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `nhan_vien_ibfk_1` FOREIGN KEY (`phong_ban_id`) REFERENCES `phong_ban` (`id`),
  ADD CONSTRAINT `nhan_vien_ibfk_2` FOREIGN KEY (`chuc_danh_id`) REFERENCES `chuc_danh` (`id`);

--
-- Ràng buộc cho bảng `nhan_vien_phu_cap`
--
ALTER TABLE `nhan_vien_phu_cap`
  ADD CONSTRAINT `nhan_vien_phu_cap_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nhan_vien_phu_cap_ibfk_2` FOREIGN KEY (`phu_cap_id`) REFERENCES `phu_cap` (`id`);

--
-- Ràng buộc cho bảng `phan_cong_cong_viec`
--
ALTER TABLE `phan_cong_cong_viec`
  ADD CONSTRAINT `phan_cong_cong_viec_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phan_cong_cong_viec_ibfk_2` FOREIGN KEY (`nguoi_giao_viec_id`) REFERENCES `nhan_vien` (`id`);

--
-- Ràng buộc cho bảng `qua_trinh_cong_tac`
--
ALTER TABLE `qua_trinh_cong_tac`
  ADD CONSTRAINT `qua_trinh_cong_tac_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qua_trinh_cong_tac_ibfk_2` FOREIGN KEY (`phong_ban_cu_id`) REFERENCES `phong_ban` (`id`),
  ADD CONSTRAINT `qua_trinh_cong_tac_ibfk_3` FOREIGN KEY (`phong_ban_moi_id`) REFERENCES `phong_ban` (`id`),
  ADD CONSTRAINT `qua_trinh_cong_tac_ibfk_4` FOREIGN KEY (`chuc_danh_cu_id`) REFERENCES `chuc_danh` (`id`),
  ADD CONSTRAINT `qua_trinh_cong_tac_ibfk_5` FOREIGN KEY (`chuc_danh_moi_id`) REFERENCES `chuc_danh` (`id`);

--
-- Ràng buộc cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `thong_tin_gia_dinh`
--
ALTER TABLE `thong_tin_gia_dinh`
  ADD CONSTRAINT `thong_tin_gia_dinh_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`nhan_vien_id`) REFERENCES `nhan_vien` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
