# CraftCeylon – Sri Lankan Handmade Crafts E-Commerce Business Website

CraftCeylon is a modern **E-Commerce Business Website** developed to promote and sell Sri Lankan handmade crafts and traditional products online.

The website provides a professional online presence for a handmade crafts business, allowing customers to explore products, learn about the business, add products to their shopping cart, and place orders online.

It also includes an Admin Dashboard that helps the business manage products, categories, customer orders, and customer inquiries efficiently.

---

## Website Objectives

- Promote Sri Lankan handmade crafts and traditional products.
- Establish a professional online presence for the business.
- Showcase handmade products with images and detailed descriptions.
- Allow customers to browse and purchase products online.
- Improve business operations through an administration system.
- Provide a convenient and responsive shopping experience.

---

## Main Features

### Customer Features

- Customer Registration and Login
- Home Page
- About Us Page
- Product Listing
- Product Details
- Shopping Cart
- Checkout
- Order Placement
- Order Confirmation
- Customer Dashboard
- Order History
- Individual Order Details
- Contact Us Form
- Responsive Mobile-Friendly Design

### Admin Features

- Admin Login and Authentication
- Admin Dashboard
- Category Management (Create, Read, Update, Delete)
- Product Management (Create, Read, Update, Delete)
- Order Management
- Order Status Management
- Contact Message Management
- View Customer Inquiries
- Manage Contact Messages

---

## Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend Programming |
| Laravel | Backend Framework |
| MySQL | Database Management |
| HTML5 | Web Page Structure |
| CSS3 | Styling |
| Bootstrap 5 | Responsive UI Design |
| JavaScript | Frontend Interactions |
| Blade | Laravel Template Engine |
| Git & GitHub | Version Control |

---

## Project Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL
- XAMPP or another compatible local server

---

## Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/hashiniranasingha/CraftCeylon.git
```

### 2. Navigate to the Project Folder

```bash
cd CraftCeylon
```

### 3. Install PHP Dependencies

```bash
composer install
```

### 4. Install Frontend Dependencies

```bash
npm install
```

### 5. Configure Environment

Create a `.env` file by copying the example configuration:

```bash
copy .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

### 6. Create MySQL Database

Open phpMyAdmin and create a database named:

`craftceylon_db`

Update the database configuration in the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=craftceylon_db
DB_USERNAME=root
DB_PASSWORD=
```

Change the database username and password according to your local configuration.

### 7. Run Database Migrations

```bash
php artisan migrate
```

This command creates the required database tables.

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

```bash
npm run build
```

### 10. Run the Application

```bash
php artisan serve
```

Open the application in your browser:

http://127.0.0.1:8000

---

## Project Structure

```text
CraftCeylon/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
│
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
├── storage/
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## Database Information

CraftCeylon uses MySQL to store application data.

The project includes Laravel migrations for creating the required database tables, including:

- Users
- Categories
- Products
- Carts
- Cart Items
- Orders
- Order Items
- Contact Messages

Product and category images are stored using Laravel public storage.

---

## Security

- Authentication for customer and admin access.
- Protected admin routes.
- Authorization checks for customer orders.
- Environment variables used for database configuration.
- Sensitive environment files are excluded from the Git repository.

---

## GitHub Repository

**Repository:** https://github.com/hashiniranasingha/CraftCeylon

---

## Project Description

CraftCeylon is an E-Commerce Business Website designed to support Sri Lankan handmade crafts businesses by providing an online platform to showcase traditional products, reach customers, and manage online sales efficiently.