# Simple Notes API

- Create a new database with the name of your choice
- Create .env file and copy the value of ".env.example" file to env. 
- Change DB_DATABASE value with your newly created database name and change other variables based on your config (if needed).


```bash
#install the dependencies
composer install

# migration
php artisan migrate

# seed
php artisan db:seed

php artisan serve
php artisan optimize
```