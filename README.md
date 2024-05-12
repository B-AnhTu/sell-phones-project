# 2023-2024-HK2-BE2-I-sell-phones
Nhóm I - Quản lí bán điện thoại

Cấu hình: 
- php phải là 8.2
- composer phải lấy đúng version của php

File HTML trang chủ: https://github.com/B-AnhTu/giaodienHTML/tree/trangchu

Lưu ý: 
- Khi vào Github nhớ clone sang nhánh master, TUYỆT ĐỐI không đụng vào nhánh main.
- Làm chức năng nào thì commit nhánh đó rồi push lên.
- Nếu được thì làm dùng tài khoản ssh để đảm bảo (không bắt buộc), deadline hiện tại còn cỡ 4 tuần.
- Để lấy code về chạy được làm theo các bước sau:
  + Clone code về -> mở thư mục chứa code trong File Explorder -> sử dụng VSCode mở ra
  + Lúc này code sẽ bị lỗi nên bình tĩnh mà mở terminal lên (Trên thanh công cụ góc trên cùng bấm vào "..." -> Terminal -> New terminal)
  + Gõ lệnh composer update rồi chờ nó tải về các gói tài nguyên cần thiết. Sau đó gõ lệnh composer dump-autoload.
  + Lưu ý nếu lỗi php thì phải cài php lại sang bản 8.2 mới dùng được
  + Sau đó dùng tiếp terminal hoặc cmder gõ lệnh tiếp tục (Nhớ gõ php artisan --version để kiểm tra phiên bản laravel)
  + Kiểm tra xem có file .env chưa, nếu chưa thì copy từ file .env.example vào sửa lại tên là project ở dòng thứ 14 (DB_DATABASE)
  + Để kiểm tra database thì cần phải có xampp, wamp. Bật localhost lên rồi vào phpMyAdmin tạo database mới tên project
  + Rồi gõ các lệnh sau mỗi khi thay đổi code:
  php artisan route:clear 
  php artisan route:cache

  Sau đó là gõ các lệnh:
  php artisan optimize (lưu các thay đổi)
  Chạy các table:
  + php artisan migrate (chạy bảng); php artisan migrate:rollback (thu hồi bảng) => php artisan migrate:fresh (tổng hợp 2 câu lệnh trên)
  + 
  php artisan config:clear
  php artisan view:clear

- Tiếp đến là các dòng lệnh như: (phải theo đúng thứ tự)
  +  php artisan optimize (Cập nhật các thay đổi cho dữ liệu trong laravel)
  +  php artisan key:generate (tạo key để chạy được code)
  +  php artisan migrate (tạo bảng)
  +  php artisan migrate:rollback (xóa bảng vừa tạo)
  +  php artisan migrate:fresh (Làm hai thao tác xóa rồi tạo lại bảng - nên dùng)
  +  php artisan db:seed (chạy các bảng dữ liệu có sẵn trong seeder, phải gọi trong DatabaseSeeder mới chạy được)
  +  php artisan serve (Chạy laravel) - Phải khai báo route, controller và trả về view mới có thể chạy demo được.
- Để tạo bảng thì gõ: php artisan make:migration create_name_table --create=name
   + make: migration (tạo một bảng mới trong thư mục migrate của laravel)
   + name: tên của bảng
   + Thêm dữ liệu cho các cột trong database:  php artisan make:seeder UsersTableSeeder (UserTableSeeder: tên của bảng User)

Hiện tại đã chạy được trang chủ hiển thị sản phẩm, danh mục và hãng; các trang quản lý. Mọi người nhớ làm những gì đã được phân công trong file báo cáo cuối kỳ
Đường dẫn file: https://docs.google.com/document/d/128j2dGG-tbYuiUm_kOx2GgAZZCpuDhZ2iG5XLg1NYjY/edit

- Hiện tại thời gian không còn nhiều nên cố gắng hoàn thành toàn bộ trước thứ tư để còn hoàn thiện báo cáo nữa nha.
 
  Trước mắt thì chỉ dẫn đến đây thôi, nếu có thắc mắc thì nhắn tin trên Zalo.
