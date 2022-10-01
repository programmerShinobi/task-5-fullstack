<h1 align="center">Laravel 8 Articles</h1>
<p>Virtual Internship Experience (Investree) - Fullstack - Faqih Pratama Muhti</p>

## Author

Laravel 8 blog dibaut oleh :

- Github : <a href="https://github.com/programmerShinobi"> Faqih Pratama Muhti | programmerShinobi </a>

## Fitur 

- Autentikasi JWT
- CRUD REST-API (Categories & Posts)
- Autentikasi Login
- CRUD Categories
- CRUD Posts

## User

**Admin**

- email: "matches the database in the users table" 
- Password: password


## Run This Apps
- Download the master branch in terminal
	> git clone https://github.com/programmerShinobi/task-5-fullstack.git
- Install the composer dependencies in terminal
	> composer install
- Make a file .env from .env.example and setting your config & create database name :  articles_db
    > APP_URL=http://127.0.0.1:8000
    > ...
    > DB_CONNECTION=mysql
    > DB_HOST=127.0.0.1
    > DB_PORT=3306
    > DB_DATABASE=articles_db
    > DB_USERNAME=root
    > DB_PASSWORD=
- Dont forget generate key from Laravel artisan in terminal
	> php artisan key:generate
- Run composer update in terminal
	> composer update
- Run Seed and faker in terminal
	> php artisan migrate:fresh --seed
- Run passport in terminal
	> php artisan passport:install
- Dont forget copy-paste the latest "Client ID" & "Client secret" to App/Http/Controllers/Api/Auth/LoginController.php
    > ...
    > 'client_id' => '...',
    > 'client_secret' => '...',
    > ... 
- Run serve in terminal
    > php artisan serve
- Run apps in terminal
	> http://127.0.0.1:8000


## If you have some suggestion ||~
Just Contact Me At:
- Email: [faqihpratamamuhti@gmail.com](mailto:faqihpratamamuhti@gmail.com)
