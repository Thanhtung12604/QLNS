# qlns-php-thuan



## Getting started

To make it easy for you to get started with GitLab, here's a list of recommended next steps.

Already a pro? Just edit this # Hệ thống Quản lý Nhân sự (QLNS)

Hệ thống quản lý nhân sự được xây dựng bằng **PHP thuần** với kiến trúc **MVC**.

## Tính năng chính

### 1. Quản lý hồ sơ nhân viên
- ✅ Quản lý thông tin cá nhân nhân viên (biên chế và hợp đồng)
- ✅ Lưu trữ hồ sơ từ khi vào làm đến khi nghỉ việc
- ✅ Tìm kiếm nhân viên theo nhiều tiêu chí

### 2. Quản lý quá trình công tác
- ✅ Lưu trữ lịch sử công tác
- ✅ Quản lý quyết định điều động, chuyển công tác
- ✅ Theo dõi nâng bậc lương, khen thưởng, kỷ luật

### 3. Quản lý phân công công việc
- ✅ Theo dõi phòng ban, chức danh
- ✅ Quản lý nhiệm vụ và công việc được phân công

### 4. Tra cứu và tìm kiếm
- ✅ Tìm kiếm theo họ tên, tuổi, địa chỉ
- ✅ Tìm kiếm theo trình độ, bậc lương, phòng ban
- ✅ Lọc theo tình trạng Đảng viên, diện chính sách

### 5. Quản lý chấm công
- ✅ Chấm công hàng ngày
- ✅ Tổng hợp số ngày công theo tháng

### 6. Quản lý lương và chế độ
- ✅ Tính lương tự động cho nhân viên biên chế: `Lương = Bậc lương × Hệ số + Phụ cấp – Bảo hiểm`
- ✅ Tính lương hợp đồng theo mức thỏa thuận
- ✅ Quản lý phụ cấp và bảo hiểm

### 7. Thống kê và báo cáo
- ✅ Báo cáo bảng lương hàng tháng
- ✅ Danh sách nhân viên đến kỳ nâng lương (3 năm)
- ✅ Danh sách nhân viên đến tuổi nghỉ hưu
- ✅ Danh sách sinh nhật tháng

## Cấu trúc thư mục

```
qlns-php-thuan/
├── app/
│   ├── controllers/      # Các controller
│   ├── models/          # Các model
│   └── views/           # Các view
├── config/              # Cấu hình
├── core/                # Core classes (MVC)
├── public/              # Public assets
│   ├── css/
│   ├── js/
│   └── index.php       # Entry point
├── database.sql         # Database schema
└── README.md
```

## Cài đặt

### 1. Import database
```sql
- Mở phpMyAdmin hoặc MySQL client
- Import file database.sql
- Database sẽ được tạo với tên: qlns_db
```

### 2. Cấu hình database
Mở file `config/database.php` và điều chỉnh thông tin kết nối:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'qlns_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Cấu hình URL
Mở file `config/config.php` và điều chỉnh BASE_URL:
```php
define('BASE_URL', 'http://localhost/qlns-php-thuan/');
```

### 4. Khởi động server
Nếu sử dụng Laragon hoặc XAMPP:
- Đảm bảo Apache và MySQL đang chạy
- Truy cập: `http://localhost/qlns-php-thuan/`

Hoặc sử dụng PHP built-in server:
```bash
cd public
php -S localhost:8000
```

## Đăng nhập

**Tài khoản mặc định:**
- Username: `admin`
- Password: `123123123`

## Yêu cầu hệ thống

- PHP >= 7.4
- MySQL >= 5.7
- Apache với mod_rewrite (hoặc nginx)
- Extension: PDO, PDO_MySQL

## Công nghệ sử dụng

- **Backend:** PHP thuần với kiến trúc MVC
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **CSS Framework:** Bootstrap 5
- **Icons:** Font Awesome 6

## Tính năng bảo mật

- ✅ Password hashing với bcrypt
- ✅ PDO Prepared Statements (chống SQL Injection)
- ✅ Session management
- ✅ CSRF protection (có thể mở rộng)

## Hướng dẫn sử dụng

### Quản lý nhân viên
1. Truy cập menu "Nhân viên"
2. Click "Thêm nhân viên" để thêm mới
3. Sử dụng form tìm kiếm để lọc nhân viên
4. Click icon "Xem" để xem chi tiết, "Sửa" để chỉnh sửa

### Chấm công
1. Truy cập menu "Chấm công"
2. Chọn tháng/năm cần chấm
3. Nhập số ngày công cho từng nhân viên

### Tính lương
1. Truy cập menu "Lương"
2. Chọn tháng/năm
3. Click "Tính lương" để tự động tính lương cho tất cả nhân viên

### Xem báo cáo
1. Truy cập menu "Báo cáo"
2. Chọn loại báo cáo cần xem
3. Click "In" để in báo cáo

## Mở rộng

Để mở rộng thêm tính năng:

1. **Thêm Model:** Tạo file trong `app/models/` kế thừa từ `Model`
2. **Thêm Controller:** Tạo file trong `app/controllers/` kế thừa từ `Controller`
3. **Thêm View:** Tạo file trong `app/views/[controller]/`