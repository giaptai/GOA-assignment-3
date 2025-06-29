
# Thông tin
- Laravel phiên bản 12.19.3.
- Sử dụng Blade Template kết hợp TailwindCSS, JavaScript cho giao diện
- CSDL: PostgreSQL.

## Xem trước
- Chạy trên máy tính cá nhân với docker-compose, seed 10.000 bản ghi<br>
  🎥 Xem demo triển khai trên Render tại: [YouTube](https://youtu.be/cq417BnOfpI)
- Chạy trên Render<br>
  🎥 Xem demo triển khai trên Render tại: [YouTube](https://youtu.be/CE0hund49ok)
## Chức năng
- Dùng migrate để tạo bảng exam_scores với sbd và 9 môn học, seeder để đọc file [diem_thi_thpt_2024.csv](public/diem_thi_thpt_2024.csv) và lưu vào bảng exam_scores.
  - Có sử dụng cache file để lưu lại dữ liệu sau truy vấn, giúp truy vấn nhanh hơn
  - Với seeder thì tắt query log, insert theo batch (lô) và dùng transaction để đọc file [diem_thi_thpt_2024.csv](public/diem_thi_thpt_2024.csv)
- Tra cứu điểm thí sinh theo mã.
- Hiển thị top 10 thí sinh khối A (toán, vật lí, hóa) bao gồm các thí sinh bằng điểm nhau.
- Biểu đồ Đường và Cột: đếm số lượng thí sinh ở từng môn, thuộc 4 khoảng <4, 4<=_<6, 6<=_8, >8.
- Thống kê tổng số thí sinh tham gia, điểm trung bình, tổng bài thi, điểm liệt.

## Chạy chương trình
> Sau đây là 2 cách chạy ứng dụng: máy cá nhân, hoặc trên web site.<br>
```
php artisan key: generate
php artisan key generate:show # lấy khóa
gán vào biến APP_KEY của .env
```
### Chạy ở máy cá nhân
> Sử dụng [docker-compose](/docker-compose.yaml): gồm image của postgreSQL, với [Dockerfile](/Dockerfile) và [docker-entrypoint.sh](/docker-entrypoint.sh)
  ```
  git clone https://github.com/giaptai/GOA-assignment-3.git
  docker-compose build --no-cache # đảm bảo không bị lỗi cache cũ.
  docker-compose
  docker-compose down # dừng container
```
- Ghi chú
- [Dockerfile](/Dockerfile) cho chạy máy cá nhân bỏ comment từ FOR LOCAL
- [docker-entrypoint.sh](/docker-entrypoint.sh): chạy hàm php như clear cache. migrate hay seed.

```
####
#### FOR LOCAL 
####
FROM php:8.2-zts-alpine3.21

RUN apk update --no-cache && \
    apk add --no-cache \
    openssl \
    zip \
    unzip \
    git \
    oniguruma-dev \
    postgresql-dev \
    netcat-openbsd && \
    rm -rf /var/lib/apk/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_pgsql mbstring
WORKDIR /app
COPY . /app
COPY .env.docker .env
RUN composer install --no-dev --optimize-autoloader
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENV APP_DEBUG=false
ENTRYPOINT ["docker-entrypoint.sh"]
EXPOSE 8181
```
- [docker-entrypoint.sh](/docker-entrypoint.sh)
```
#!/bin/sh

if [ -f ".env" ]; then
  echo "Loading environment from .env..."
  export $(grep -v '^#' .env | xargs)
fi

# Fallback nếu vẫn chưa có
DB_HOST="${DB_HOST:-localhost}"
DB_PORT="${DB_PORT:-5432}"

echo "Waiting for PostgreSQL to start..."
while ! nc -z "$DB_HOST" "$DB_PORT"; do # cho deploy RENDER
  sleep 1 # Đợi 1 giây trước khi thử lại
done
echo "PostgreSQL started"

# `--force` để bỏ qua xác nhận trong môi trường production.
echo "Running migrations..."
# php artisan migrate --force

# `--force` để bỏ qua xác nhận trong môi trường production.
echo "Running specific seeder (Thpt2024ScoreSeeder)..."
# php artisan db:seed --class=Thpt2024ScoreSeeder --force

echo "Starting application... with php-fpm"
php artisan serve --host=0.0.0.0 --port=81
```
- [docker-compose](/docker-compose.yaml)
```
services:
  app:
    build:
      context: . # Đường dẫn tới Dockerfile (nằm trong thư mục hiện tại)
      dockerfile: Dockerfile
    ports:
      - "8181:8181"
    volumes:
      - .:/var/www/html
    environment:
      DB_HOST: db
      DB_PORT: 5432
      DB_DATABASE: blogy
      DB_USERNAME: postgres
      DB_PASSWORD: postgres
    depends_on:
      - db # Đảm bảo dịch vụ `db` khởi động trước `app`
  db:
    image: postgres:13
    restart: always
    environment:
      POSTGRES_DB: blogy
      POSTGRES_USER: postgres
      POSTGRES_PASSWORD: postgres
    volumes:
      - db_data:/var/lib/postgresql/data
    ports:
      - "5433:5432"

volumes:
  db_data:
```
### Website
- Link: https://g-scores-app-0-01.onrender.com/
> Triển khai trên Render kết nối với PostgreSQL của Render luôn, đôi khi vào phải đợi Render khởi động lại vì đang xài bản miễn phí. `Your free instance will spin down with inactivity, which can delay requests by 50 seconds or more.` <br>
  Tham khảo: https://www.youtube.com/watch?v=XFqwk0z3Tqw&t=314s (có kèm bài viết của medium)
- Các file liên quan: 
  - [Dockerfile](/Dockerfile): cho việc build image và đẩy lên docker registry
  - [.dockerignore](/.dockerignore): không tải các thư viện trong vender của laravel và node_modules/ của laravel vite
  - [00-laravel-deploy.sh](/scripts/00-laravel-deploy.sh): em chưa tìm hiểu sâu phần này nhưng khi cài nginx của richarvey/nginx-php-fpm thì sẽ khởi chạy file này chứ không phải start.sh
  - [nginx-site.conf](/conf/nginx/nginx-site.conf): cấu hình server nginx.
- Ghi chú:
  - Kết nối với postgreSQL của Render cần lấy thông tin `Internal Database URL/Extenral Database URL` và bỏ vào trong biến `DATABASE_URL`
  - Trong [AppServiceProvider](/app/Providers/AppServiceProvider.php)
  - ```
    public function boot(): void
    {
        //
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
    render nhận https -> chuyển thành http -> laravel nhận http -> phản hồi http là sai nên cần forceScheme('https') để chuyển phản hồi thành https ? 
    ```
  - Dockerfile
    ```
    FROM richarvey/nginx-php-fpm:latest
    COPY . .

    # Image config
    ENV SKIP_COMPOSER=1
    ENV WEBROOT=/var/www/html/public
    ENV PHP_ERRORS_STDERR=1
    ENV RUN_SCRIPTS=1
    ENV REAL_IP_HEADER=1

    # Laravel config
    ENV APP_ENV=production
    ENV APP_DEBUG=false
    ENV LOG_CHANNEL=stderr

    # Allow composer to run as root
    ENV COMPOSER_ALLOW_SUPERUSER=1
    CMD ["/start.sh"] 
    ```
  - Environment trên render:
  ![](/public/render-media/render-env.png)


> Em không chuyên về PHP hoặc Laravel, và chỉ mới tiếp cận trong khoảng 3 ngày gần đây. Toàn bộ nội dung trong dự án này là những gì em tự tìm hiểu và thực hiện, bao gồm việc chạy ứng dụng bằng docker-compose trên máy cá nhân và triển khai thành công trên nền tảng Render. > Mong anh/chị thông cảm nếu còn thiếu sót trong phần cấu hình hoặc hướng dẫn.