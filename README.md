# Laravel Social Login (Google & Facebook OAuth)

<!--
Họ tên: Bùi Minh Đức
Mã sinh viên: 23810310110
Lớp: D18CNPM2
-->

## Thông tin sinh viên

| Thông tin | Chi tiết |
|-----------|----------|
| **Họ tên** | Bùi Minh Đức |
| **Mã sinh viên** | 23810310110 |
| **Lớp** | D18CNPM2 |

---

## Mô tả dự án

Ứng dụng web Laravel cho phép người dùng đăng nhập bằng tài khoản **Google** và **Facebook** thông qua OAuth 2.0, sử dụng thư viện **Laravel Socialite**. Hệ thống tự động lưu thông tin người dùng vào database và quản lý phiên đăng nhập.

### Tính năng chính
- Đăng nhập bằng Google (OAuth 2.0)
- Đăng nhập bằng Facebook (OAuth 2.0)
- Tự động tạo tài khoản nếu chưa tồn tại
- Hiển thị thông tin cá nhân sau đăng nhập
- Chức năng đăng xuất
- Xử lý lỗi đăng nhập

---

## Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- MySQL / MariaDB
- Tài khoản Google Developer Console
- Tài khoản Facebook Developers

---

## Cài đặt

### 1. Clone repository

```bash
git clone https://github.com/<your-username>/<repo-name>.git
cd <repo-name>
```

### 2. Cài đặt dependencies

```bash
composer install
```

### 3. Tạo file .env

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Cấu hình database trong `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_social_login
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Chạy migration

```bash
php artisan migrate
```

### 6. Khởi động server

```bash
php artisan serve
```

Truy cập: `http://localhost:8000`

---

## Cấu hình Google OAuth

### Bước 1: Tạo Google OAuth App

1. Truy cập [console.cloud.google.com](https://console.cloud.google.com/)
2. Tạo project mới → vào **APIs & Services → Credentials**
3. Bấm **Create Credentials → OAuth 2.0 Client IDs**
4. Chọn **Web Application**
5. Thêm **Authorized redirect URIs**:
   ```
   http://localhost:8000/login/google/callback
   ```
6. Copy **Client ID** và **Client Secret**

### Bước 2: Thêm vào `.env`

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/login/google/callback
```

---

## Cấu hình Facebook OAuth

### Bước 1: Tạo Facebook App

1. Truy cập [developers.facebook.com](https://developers.facebook.com/)
2. Vào **My Apps → Create App → Consumer**
3. Vào **Settings → Basic** → copy **App ID** và **App Secret**
4. Vào **Trường hợp sử dụng → Đăng nhập bằng Facebook → Cài đặt**
5. Thêm **Valid OAuth Redirect URI**:
   ```
   http://localhost:8000/login/facebook/callback
   ```

### Bước 2: Thêm vào `.env`

```env
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/login/facebook/callback
```

---

## Cấu trúc thư mục chính

```
app/
├── Http/
│   └── Controllers/
│       └── Auth/
│           ├── GoogleController.php      # Xử lý Google OAuth
│           └── FacebookController.php   # Xử lý Facebook OAuth
├── Models/
│   └── User.php
database/
└── migrations/
    └── xxxx_add_social_fields_to_users_table.php
resources/
└── views/
    ├── auth/
    │   └── login.blade.php              # Trang đăng nhập
    └── dashboard.blade.php              # Trang sau đăng nhập
routes/
└── web.php
```

---

## Cấu trúc database

Bảng `users` bổ sung các cột:

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| `provider` | varchar | Nhà cung cấp (google / facebook) |
| `provider_id` | varchar | ID từ nhà cung cấp |
| `avatar` | varchar | URL ảnh đại diện |
| `student_id` | varchar | Mã sinh viên |

---

## Luồng hoạt động

```
User click "Login with Google/Facebook"
        ↓
Redirect đến trang xác thực của provider
        ↓
User đồng ý cấp quyền
        ↓
Provider redirect về callback URL
        ↓
Kiểm tra provider_id trong database
    ├── Đã tồn tại → Đăng nhập
    └── Chưa tồn tại → Tạo tài khoản mới → Đăng nhập
        ↓
Redirect về trang Dashboard
```

---

## Xử lý lỗi

| Lỗi | Xử lý |
|-----|-------|
| User từ chối quyền | Redirect về trang login với thông báo lỗi |
| Token không hợp lệ | Bắt Exception, redirect về login |
| Email trùng lặp | Merge tài khoản theo email |
| Facebook không trả về email | Dùng `provider_id@facebook-user.local` |

---

## Demo

> Video demo (3–5 phút) bao gồm:
> - Quá trình đăng nhập bằng Google
> - Quá trình đăng nhập bằng Facebook
> - Hiển thị thông tin cá nhân (Họ tên, Mã sinh viên: **23810310110**)
> - Chức năng đăng xuất

---

## Công nghệ sử dụng

- **Framework**: Laravel 10/11
- **Package**: [Laravel Socialite](https://laravel.com/docs/socialite)
- **Database**: MySQL
- **Frontend**: Blade Template + Bootstrap 5
- **OAuth**: Google OAuth 2.0 + Facebook OAuth 2.0
