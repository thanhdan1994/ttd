Bước 1: clone source
Bước 2: run docker-compose up
Bước 3: truy cập vào container php run "composer install"
Bước 4: vẫn ở container php run "php artisan key:generate"
Bước 5: vẫn ở container php run "npm install"
Bước 6: Tạo database "ttd"
Bước 7: run "php artisan migrate:fresh --seed"
Bước 8: run "php artisan passport:install && php artisan passport:keys"
