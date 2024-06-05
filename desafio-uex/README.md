Author: Tiago Reis Demeneck
Date

Laravel version: 10
Please check your php version, required: >= 8.1
You have to do the following to run the project:
-setup your SMTP config in the .env (i used mailtrap)
-put your google api key in the .env
-put your database config in the .env
-run composer install
-run php artisan key:generate
-run php artisan migrate
-run php artisan db:seed (check the seeder to check the user tester credentials)

Testing:
-run php artisan test

Credits to sb-admin-2 template(this does not include the Alerta.js and google maps api.)

I let my original .env in the .env.example, i know it is not a good pratice, but it will help in this test case.
To make the login, you will need to verify your email(you can set manually the email_verified_at)