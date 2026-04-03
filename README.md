# url-shortner
Create short URL from original URL for security purpose

To install this
1) pull this branch in your local folder.
2) execute command "composer install"
3) then run "npm install"
4) create database "url_shortner" in mysql
5) update .env file with following details
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=url_shortner
    DB_USERNAME=root
    DB_PASSWORD=
6) You can change DB_* details as per your database setup.
7) then execute command 'php artisan migrate' to create require tables in database.
8) for development run 'npm run dev' and for production run 'npm run build'
9) if got any error while build, confirm that vite build is install properly or not. 
10) if not then install it firstly by command "npm install vite".
11) then execute this command "php artisan serve"
12) Open "http://locahost:8000/login" in browser. You will see the login page.
