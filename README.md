<h1 align="center">Laravel 8 Articles</h1>
<p>Virtual Internship Experience (Investree) - Fullstack - Faqih Pratama Muhti</p>

## Author
Laravel 8 Articles created by :

- Github : <a href="https://github.com/programmerShinobi"> Faqih Pratama Muhti | programmerShinobi </a>

## Feature 
- JWT Authentication
- CRUD RESTfull-API (Categories & Posts)
- Verify Email Users
- Login Authentication
- CRUD Categories
- CRUD Posts

## User
**Admin**
- Email     : "matches the database in the users table" 
- Password  : password


## Run This Apps
- Download the master branch in terminal
	``` 
    git clone git@github.com:programmerShinobi/task-5-fullstack.git
    ```
- Install the composer dependencies in terminal
	```
    composer install
    ```
- Make a file .env from .env.example and setting your config & create database name :  articles_db
    ```
    //...
    APP_URL=http://127.0.0.1:8000
    //...
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=articles_db
    DB_USERNAME=root
    DB_PASSWORD=
    //...
    ```
- Dont forget generate key from Laravel artisan in terminal
	```
    php artisan key:generate
    ```
- Run composer update in terminal
	```
    composer update
    ```
- Run Seed and faker in terminal
	```
    php artisan migrate:fresh --seed
    ```
- Run passport in terminal
	```
    php artisan passport:install
    ```
- Dont forget copy-paste the latest "Client ID" & "Client secret" to app/Http/Controllers/Api/Auth/LoginController.php
    ```
    //...
    class LoginController extends Controller
    {
        public function store(Request $request)
        {
            //...
            'client_id' => '...',
            'client_secret' => '...',
            //...
         }
    //...
    }
    ```
- Dont forget setting your URL in config/app.php
    ```
    //...
    'url' => env('APP_URL', 'http://127.0.0.1:8000'),
    //...
    ```
- Run JWT authentication
    ```
    php artisan jwt:secret
    ```
- Run serve in terminal
    ```
    php artisan serve
    ```
- Run apps in web browser
	```
    http://127.0.0.1:8000
    ```
- Run RESTfull API in API testing tool
    ```
    http://127.0.0.1:8000/api/...
    ```
- If you run RESTfull API in testing tool using Postman, just download the file from <a href="https://drive.google.com/drive/folders/1K9QZvuj60_n9RNjl2FkRTUYCrieAvdOm?usp=sharing">**this google drive link**</a>. And then import the file into your API testing tool using Postman

## If you have some suggestion ||~
Just Contact Me At :
- Email     : <a href="mailto:faqihpratamamuhti@gmail.com">faqihpratamamuhti@gmail.com</a>
- LinkedIn  : <a href="https://www.linkedin.com/in/faqih-pratama-muhti-9a75a2130/">Faqih Pratama Muhti</a>
