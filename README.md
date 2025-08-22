# 🛠️ Expense Tracking App
A comprehensive expense tracking web application built with Laravel 12 and custom authentication. Track your daily expenses, **visualize spending patterns with interactive charts**, and manage your finances with ease
---

## 🚀 Features

### ✅ Core Features
- Custom Authentication System (No packages - built from scratch)
- Expense CRUD Operations (Create, Read, Update, Delete)
- Fixed Categories (Food, Transport, Shopping, Others)
- Monthly Expense Reports grouped by category
- Interactive Charts using Chart.js for data visualization
- Latest First Ordering for expense listings
- Responsive Design with Bootstrap 5

## ⚙️ Requirements

- PHP >= 8.2
- Composer
- Laravel >= 10
- MySQL
- Git

---

## 🧪 Installation & Running Locally

### 1. Clone the Repository
```bash
git clone https://github.com/mamoonbgc036/expense-tracker-app.git
cd expense-tracker-app
````

### 1. Install Dependency
```bash
composer install
```
### 2. Create Application key
```bash
php artisan key:generate
```
### 3. Configure Database
```bash
create database in mysql and rename .env.example to .env and put dbname and credentials in .env
```
### 4. Migration and Seed
```bash
php artisan migrate --seed
```
### 5. Run and Browse
```bash
php artisan serve
```
