## Installation

Clone git repository and run 
```
cd rostelecom
composer install
```
Then create **DB** and edit **.env**  file , after it run 
```
php artisan key:generate
php artisan migrate
```
After it's worked fine then you can enter your project and use it.<br>
- **First** you need to Register and login into service page. 
- **Then** you can create services and choose connected services.
- **After** you can go to home page and check services.