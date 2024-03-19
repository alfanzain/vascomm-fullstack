# Use case
Buatlah API dengan menggunakan Javasccript (Next/Express) / PHP (Lumen) yang dapat memenuhi fitur : 
- CRUD data user
- CRUD data produk 

SOAL :  
- [v] Fitur get list terdapat param query take, skip search. (point : 10)
- [v] Menggunakan method yang sesuai. (point : 10) 
- [v] Format respon terdiri dari : code, message, data. (point : 10) 
- [v] Implementasi oauth2 pada API. (point : 20)
- [v] Untuk fitur delete implementasi soft delete. (point : 10) 
- [v] Mengimplementasikan 2 role user (role admin dan role user). (point : 10) 
- [v] Implementasi seeder dan migration. (point : 20)
- [v] Implementasi validasi parameter. (point : 10)

# Development

composer create-project laravel/laravel:^11.0 .
php artisan install:api --passport
<!-- php artisan passport:keys -->
php artisan passport:client --personal
php artisan storage:link

# Installation

composer install
php artisan migrate --seed
php artisan passport:client --personal
php artisan storage:link
