# Setup Guide

Technical Requirements:

- Laravel 10.
- PHP 8.1.10.
- MySQL 8.0.30 or higher.
- Git.

### Steps:

1. Install git on your local machine.
2. Go to your Laravel projects directory and open your terminal in this directory.
3. Run this commands in your terminal: 
    - ```git clone https://github.com/emmanuelborjal/task-management.git```
    - ```cd task-management/```
    - ```composer install && npm install```
4. Duplicate the ```.env.example``` file and rename the duplicated file to ```.env```.
5. Edit the ```.env``` file based on your local database credentials:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
```
6. Make sure your MySQL service is running on your machine.
7. Run ```php artisan migrate --seed``` on your terminal.
8. Type ```yes``` and enter to create the 'task-management' schema automatically.
9. Run ```php artisan key:generate``` on your terminal.
10. Run ```npm run dev``` on a separate terminal tab.
10. Run ```php artisan serve``` on a separate terminal tab.