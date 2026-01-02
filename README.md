# PHP_Laravel12_Implement_AdminLTE3

---

## Project Description

This project demonstrates how to integrate **AdminLTE 3** with **Laravel 12**  
and create a simple **Admin Dashboard** with user statistics.

### The main purpose of this project is to understand how to:

Integrate AdminLTE 3 template into a Laravel application

Use AdminLTE layouts, components, and design structure

Create a dashboard page using Laravel Blade templates

### Display basic user statistics such as:

Total registered users

Users registered today

### The project uses Laravel’s MVC architecture, where:

Controller handles the logic (counting users)

Model interacts with the database

View displays data using AdminLTE UI

### This project is very useful for beginners and freshers to learn:

Admin panel development

Laravel routing and controllers

Blade templating

Database interaction using Eloquent ORM


---


# Project SetUp

---

## STEP 1: Create New Laravel 12 Project

### Run Command :

```
composer create-project laravel/laravel:^12.0 PHP_Laravel12_Implement_AdminLTE3

```

### Go inside project:

```
cd PHP_Laravel12_Implement_AdminLTE3

```

Make sure Laravel 12 is installed successfully.



## STEP 2: Database Configuration

### Open .env file and update database credentials:

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adminlte
DB_USERNAME=root
DB_PASSWORD=

```

### Create database:

```
adminlte

```

### Then run migrations:

```
php artisan migrate

```




## STEP 3: Install the AdminLTE Package

We’ll use the official Laravel-AdminLTE package (jeroennoten/laravel-adminlte) which makes it super easy to integrate AdminLTE into Laravel.

### Run:

```

composer require jeroennoten/laravel-adminlte

```

This installs the package and prepares your Laravel app to use AdminLTE.




## STEP 4: Publish & Install AdminLTE Assets

### Now we install AdminLTE resources (CSS, JS, views, config):

```
php artisan adminlte:install

```

What this does:

 Publishes configuration file: config/adminlte.php
 Publishes blade views and assets (vendor CSS/JS)
 Sets up base AdminLTE template structure



## STEP 5: Add Authentication (Optional but Recommended)

### If you want login, register, logout pages styled with AdminLTE, install Laravel UI and bootstrap scaffolding:

```

composer require laravel/ui
php artisan ui bootstrap --auth

```

### Now replace Laravel’s default auth views with AdminLTE’s styled ones:

```
php artisan adminlte:install --only=auth_views

```

This will apply AdminLTE design to:
 Login page
 Register page
 Reset password pages
 Email verification pages




## STEP 6: Create Dashboard Controller (VERY IMPORTANT)

### Run this command:

```
php artisan make:controller DashboardController

```

### Open : app/Http/Controllers/DashboardController.php

```

<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $todayUsers = User::whereDate('created_at', today())->count();

        return view('home', compact('totalUsers', 'todayUsers'));
    }
}



```




## STEP 7: Create a Dashboard View

### Open home view: resources/views/home.blade.php

```
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-lg-3">
        <div class="info-box bg-info">
            <span class="info-box-icon">
                <i class="fas fa-users"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="info-box bg-success">
            <span class="info-box-icon">
                <i class="fas fa-user-plus"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Today Users</span>
                <span class="info-box-number">{{ $todayUsers }}</span>
            </div>
        </div>
    </div>

</div>
@stop

```


## STEP 8: Setup Routes

### Add your web routes in routes/web.php:

```
<?php

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);



```




## STEP 9: Installation

### Open new terminal in this project and Run:

```

npm install

npm run dev

```

## STEP 10:Running the App

### Finally run the development server:

```
php artisan serve

```

### Visit in browser:

```
http://localhost:8000

```


So You can see this type Output:


<img width="1907" height="973" alt="Screenshot 2026-01-02 102219" src="https://github.com/user-attachments/assets/54ec57c5-a7fc-41f1-a1a2-5a7d792315c0" />



---


## Project Folder Structure


```

PHP_Laravel12_Implement_AdminLTE3/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── DashboardController.php   # Dashboard logic
│   │   │
│   │   └── Middleware/
│   │
│   ├── Models/
│   │   └── User.php                      # User model
│   │
│   └── Providers/
│
├── bootstrap/
│   └── app.php
│
├── config/
│   ├── adminlte.php                     # AdminLTE configuration
│   ├── app.php
│   └── database.php
│
├── database/
│   ├── migrations/                      # Database migrations
│   │   └── xxxx_create_users_table.php
│   │
│   └── seeders/
│
├── public/
│   ├── css/
│   ├── js/
│   ├── vendor/                          # AdminLTE assets
│   └── index.php
│
├── resources/
│   ├── views/
│   │   ├── home.blade.php               # Dashboard view
│   │   ├── auth/                        # Login / Register views (AdminLTE)
│   │   └── vendor/
│   │       └── adminlte/                # AdminLTE blade templates
│   │
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php                          # Web routes
│   └── api.php
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── tests/
│
├── vendor/                              # Composer packages
│
├── .env                                 # Environment configuration
├── .env.example
├── artisan                              # Artisan CLI
├── composer.json
├── package.json
├── phpunit.xml
├── README.md                            # Project documentation
└── vite.config.js

```
