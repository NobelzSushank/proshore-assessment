# Quiz System built with Laravel



# Installation
1. Clone this repo
```
git clone https://github.com/NobelzSushank/proshore-assessment.git
```

2. Install composer packages
```
cd proshore-assessment
```
```
composer install
```

3. Create and setup .env file
```
cp .env.example .env
```
```
php artisan key:generate
```

4. put database credentials in .env file

5. Migrate and insert records
```
php artisan migrate --seed
```

### Additional packages used
[Yajra Datatable](https://yajrabox.com/docs/laravel-datatables/10.0/)

### Login Route
```
http://127.0.0.1:8000/login
```