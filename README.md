<p align="center">
<img src="public/logo.png" width="200" alt="Rapid Ink Logo">
</p>

<p align="center">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/Laravel-FF2D20%3Fstyle%3Dfor-the-badge%26logo%3Dlaravel%26logoColor%3Dwhite" alt="Laravel">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/PHP-777BB4%3Fstyle%3Dfor-the-badge%26logo%3Dphp%26logoColor%3Dwhite" alt="PHP">
<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

About Rapid Ink

Rapid Ink is a high-fidelity, full-stack e-commerce storefront specializing in streetwear and graphic tees. Built for speed and visual impact, this platform provides an immersive shopping experience for customers and a powerful, secure backend management system for store owners.

Tech Stack

Backend Framework: Laravel (PHP)

Frontend: HTML5, CSS3, Bootstrap

Database: MySQL

Authentication: Laravel Breeze

Key Features

Dynamic Storefront: High-impact hero sections, masonry product grids, and trending category highlights.

Admin CMS Dashboard: Secure, role-based login portal allowing administrators to add, edit, and manage store inventory.

Theme Support: Integrated light and dark mode toggling for an optimal user experience.

Responsive Design: Fully fluid UI that scales perfectly from desktop down to mobile devices.

Getting Started

To get a local development copy up and running, follow these steps:

Clone the repository:

git clone [https://github.com/yourusername/rapid-ink.git](https://github.com/yourusername/rapid-ink.git)
cd rapid-ink



Install Dependencies:
Install the necessary PHP and Node packages:

composer install
npm install
npm run build



Environment Setup:
Create your environment file and generate an application key:

cp .env.example .env
php artisan key:generate



Make sure to update your .env file with your local MySQL database credentials (e.g., DB_DATABASE=rapid_ink_db).

Database & Storage:
Run the database migrations to set up the schema and link the storage directory for product images:

php artisan migrate
php artisan storage:link



Launch the Application:

php artisan serve



Visit http://localhost:8000 in your browser to view the storefront.

Powered by Laravel

This project leverages the expressive, elegant syntax of the Laravel framework. Laravel takes the pain out of development by easing common tasks, providing:

A simple, fast routing engine.

An expressive, intuitive database ORM (Eloquent).

Database-agnostic schema migrations.

Robust, secure authentication right out of the box.

License

Rapid Ink is open-sourced software licensed under the MIT license.
