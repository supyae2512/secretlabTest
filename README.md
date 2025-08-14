##  Documentation

### Prerequisite
- PHP 8.*
- Mysql
- Composer
- Create Database
    - change your credentials in .env file
    - Run > php artisan migrate and php artisan db:seed (for dummy data)       

### How to run?
- composer install (autoloader for env, and desired directory)
- go to project folder > php artisan server 
- (or) you can create virtual host on apache


### Overview
- Store Value -> http://127.0.0.1:8000/api/object
- Get Value -> http://127.0.0.1:8000/api/object/user_36
- Get Value by Timestamp -> http://127.0.0.1:8000/api/object/user_1?timestamp=1755146538
- Get All Records -> http://127.0.0.1:8000/api/object/get_all_records

### API Reference 
- https://documenter.getpostman.com/view/644913/2sB3BGHpZe