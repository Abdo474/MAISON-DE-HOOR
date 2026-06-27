# 🚀 Maison de Hoor - Laravel E-Commerce Setup Guide

**Actual Laravel Framework with MVC Architecture**

## ✅ What's Installed

✔ **Laravel 13** - Full framework  
✔ **MySQL Database** - With Eloquent ORM  
✔ **Models** - Product, Category, Cart, Order, OrderItem  
✔ **Controllers** - RESTful resource controllers  
✔ **Migrations** - Complete database schema  
✔ **Views** - Bootstrap 5 responsive templates  
✔ **Routes** - RESTful routing  
✔ **Authentication** - Laravel Breeze ready  

## 🔧 Quick Setup - 5 Steps

### Step 1: Create Database
```bash
# Open MySQL Workbench or command line
mysql -u root -p
```

```sql
CREATE DATABASE reema_shop;
EXIT;
```

### Step 2: Install Dependencies
```bash
cd c:\ptojects\wep
composer install
```

### Step 3: Configure Database
Already set in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=reema_shop
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations
```bash
php artisan migrate
```

### Step 5: Start Server
```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 📁 Project Structure

```
wep/
├── app/
│   ├── Models/                 # Eloquent Models
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   └── User.php (default)
│   └── Http/Controllers/       # Controllers
│       ├── ProductController.php
│       ├── CartController.php
│       └── OrderController.php
├── database/
│   └── migrations/             # Database schemas
├── resources/views/            # Blade templates
│   ├── layouts/app.blade.php  # Master layout
│   ├── products/               # Product views
│   ├── cart/                   # Cart views
│   └── orders/                 # Order views
├── routes/
│   ├── web.php                # Web routes
│   └── auth.php               # Authentication routes
├── public/
│   ├── css/                   # Stylesheets
│   ├── js/                    # JavaScript
│   └── index.php              # Entry point
├── .env                       # Configuration
└── artisan                    # CLI tool
```

## 🗄️ Database Schema

### Users Table
- id, name, email, password, phone, address, timestamps

### Categories Table
- id, name, description, image, timestamps

### Products Table
- id, name, description, price, stock, category_id, image, timestamps

### Carts Table
- id, user_id, product_id, quantity, created_at

### Orders Table
- id, user_id, total_amount, status, payment_method, timestamps

### Order Items Table
- id, order_id, product_id, quantity, price, created_at

## 🎮 Controllers & Routes

### ProductController
```
GET    /products              - List products
POST   /products              - Create product
GET    /products/{id}         - Show product
PUT    /products/{id}         - Update product
DELETE /products/{id}         - Delete product
```

### CartController
```
GET    /cart                  - View cart
POST   /cart                  - Add to cart
PUT    /cart/{id}             - Update quantity
DELETE /cart/{id}             - Remove from cart
```

### OrderController
```
GET    /orders                - My orders
GET    /orders/{id}           - Order details
POST   /orders                - Create order (checkout)
```

## 🔐 Authentication

Default Laravel authentication is ready. To enable:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
```

This adds:
- Login & Registration
- Email verification
- Password reset
- Profile management

## 🎨 Frontend Stack

- **Bootstrap 5** - Responsive CSS framework
- **Blade Templating** - Laravel templating engine
- **Custom CSS** - Brown/leather color scheme
- **JavaScript** - Form validation and interactivity

## 🚀 Running the Application

### Development Mode
```bash
php artisan serve
```

Server starts at: **http://localhost:8000**

### Database Migrations
```bash
php artisan migrate          # Run all migrations
php artisan migrate:rollback # Undo migrations
php artisan migrate:refresh  # Reset and rerun
php artisan migrate:seed     # Seed sample data
```

### Generate Sample Data
Create a seeder:
```bash
php artisan make:seeder ProductSeeder
php artisan make:seeder CategorySeeder
```

Then run:
```bash
php artisan db:seed
```

## 📝 API Conventions

### Request/Response
- RESTful JSON API ready
- CSRF protection enabled
- Validation on all endpoints
- Authorization policies included

### Example Product Creation
```php
POST /products
{
    "name": "Product Name",
    "description": "Product description",
    "price": 99.99,
    "stock": 10,
    "category_id": 1
}
```

## 🛠️ Development Commands

```bash
# Create new model
php artisan make:model NewModel -m

# Create new controller
php artisan make:controller NameController --resource

# Create new migration
php artisan make:migration create_table_name

# Create seeder
php artisan make:seeder TableNameSeeder

# Generate policies for authorization
php artisan make:policy ProductPolicy --model=Product

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Tinker (interactive shell)
php artisan tinker
```

## 📦 Dependencies

Key packages installed:
- `laravel/framework` - Core framework
- `laravel/tinker` - Interactive shell
- `phpunit/phpunit` - Testing
- `laravel/pint` - Code formatting
- `mockery/mockery` - Mocking

## 🧪 Testing

Run tests:
```bash
php artisan test
```

## 📚 Key Files Explained

### `.env` - Environment Configuration
- `APP_DEBUG=true` - Show errors in development
- `APP_URL=http://localhost:8000` - Application URL
- Database credentials

### `routes/web.php` - URL Routes
Defines all web routes to controllers

### `app/Models/Product.php` - Eloquent Model
Represents products table with relationships

### `app/Http/Controllers/ProductController.php` - Logic
Handles product CRUD operations

### `resources/views/products/index.blade.php` - Template
HTML template for product listing

## 🔗 Relationships

- **Product** belongs to **Category**
- **Product** has many **Carts** and **OrderItems**
- **Category** has many **Products**
- **Cart** belongs to **User** and **Product**
- **Order** belongs to **User**
- **Order** has many **OrderItems**
- **OrderItem** belongs to **Order** and **Product**

## 🚦 Next Steps

1. **Create Categories**
   ```bash
   php artisan tinker
   > \App\Models\Category::create(['name' => 'Electronics', 'description' => 'Electronics products'])
   > exit
   ```

2. **Add Sample Products**
   Use admin interface or tinker

3. **Enable Authentication**
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install
   ```

4. **Setup Payment Gateway**
   - Stripe: `composer require stripe/stripe-php`
   - PayPal: Add PayPal SDK

5. **Deploy to Production**
   - Configure environment for production
   - Set `APP_DEBUG=false`
   - Use `.env.production`

## 🐛 Troubleshooting

**Error: "No application encryption key has been generated"**
```bash
php artisan key:generate
```

**Error: "Class not found"**
```bash
composer dump-autoload
```

**Error: "SQLSTATE[HY000]: General error: 1030"**
- Check database connection
- Verify MySQL is running

**Error: "Migrate not running"**
```bash
php artisan migrate --force
```

## 📖 Documentation

- Laravel Docs: https://laravel.com/docs
- Eloquent ORM: https://laravel.com/docs/eloquent
- Blade Templating: https://laravel.com/docs/blade
- Controllers: https://laravel.com/docs/controllers
- Migrations: https://laravel.com/docs/migrations

---

**Project Status**: ✅ Ready for Development

**Framework**: Laravel 13  
**Database**: MySQL  
**Pattern**: MVC  
**Authentication**: Breeze-ready  

Happy coding! 🎉
