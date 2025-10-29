<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# 🧩 Management Blog Project

A **blog management system** built using **Laravel**, designed for both admins and users to efficiently manage and interact with blog posts.

Admins can **create, update, and delete** posts, while users can **view posts** and **download post data** as CSV files.

---

## 🚀 Features

### 👨‍💼 Admin Panel
- Add new blog posts with **title**, **description**, and **image**  
- **Update** existing posts directly from the dashboard  
- **Delete** posts with AJAX confirmation (includes image deletion)  
- View all posts with pagination  

### 👤 User Side
- View all published posts on the homepage  
- Open full post details  
- Download posts data in **CSV format**

---

## ⚙️ Technologies Used
- **Laravel 10** (PHP framework)
- **Blade Templates** (Frontend)
- **MySQL** (Database)
- **AJAX + jQuery** (Dynamic post deletion)
- **Bootstrap / Tailwind CSS** (UI design)
- **SweetAlert2** (Interactive delete confirmation popup)

---

## 📁 Project basic Structure
Managementproject/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminController.php
│   │       └── UserController.php
│   ├── Models/
│   │   └── Post.php
│
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── addpost.blade.php
│       │   └── allpost.blade.php
│       ├── home.blade.php
│       └── fullpost.blade.php
│
├── public/
│   └── img/ (Stores uploaded post images)
│
├── routes/
│   └── web.php
│
└── README.md

---

## 🧠 Key Functionalities
- **Add Post:** Admins can create new blog posts  
- **Edit Post:** Update title, description, or image  
- **Delete Post:** Removes post and image from the database and server  
- **Download Post Data:** Users can export data as CSV  

---

## 🧑‍💻 How to Run Locally

1. **Clone Repository**
   ```bash
   git clone https://github.com/Sohamkantijana/ManagementBlogProject.git
Navigate

cd ManagementBlogProject


Install Dependencies

composer install
npm install


Setup Environment

cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve


Open in Browser

http://127.0.0.1:8000

🏁 Future Enhancements

Add user comments section

Implement role-based authentication (Admin/User)

Search and filter posts by category

Add image preview before upload

🧑‍💼 Author

👨‍💻 Sohamkanti Jana
📧 Email: [sohamkantijana@example.com
]
💻 GitHub: Sohamkantijana

About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Simple, fast routing engine

Powerful dependency injection container

Multiple back-ends for session
 and cache
 storage

Expressive, intuitive database ORM

Database agnostic schema migrations

Robust background job processing

Real-time event broadcasting

License

The Laravel framework is open-sourced software licensed under the MIT license
.


---

✅ **Summary of what this does:**
- Keeps Laravel’s default logo, badges, and credits.  
- Adds your project section **above** Laravel’s "About Laravel" section.  
- Clean and professional structure for **GitHub presentation**.

Would you like me to make it a bit **shorter (1-page concise)** or keep this **detailed version** 


