# Use case
Buatlah API dengan menggunakan Javasccript (Next/Express) / PHP (Lumen) yang dapat memenuhi fitur : 
- CRUD data user
- CRUD data produk 

SOAL :  
- [x] Fitur get list terdapat param query take, skip search. (point : 10)
- [x] Menggunakan method yang sesuai. (point : 10) 
- [x] Format respon terdiri dari : code, message, data. (point : 10) 
- [x] Implementasi oauth2 pada API. (point : 20)
- [x] Untuk fitur delete implementasi soft delete. (point : 10) 
- [x] Mengimplementasikan 2 role user (role admin dan role user). (point : 10) 
- [x] Implementasi seeder dan migration. (point : 20)
- [x] Implementasi validasi parameter. (point : 10)

# Development

## Techs
- Laravel 11
- PHP 8.3
- Javascript
- MySQL

## Commands

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
