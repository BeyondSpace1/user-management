# 🧠 Secure JSON-Based User Management System
> A Core PHP OOP project using JSON as a simulated database with modern UI animations.

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue?logo=php)
![License](https://img.shields.io/badge/license-MIT-green)
![Status](https://img.shields.io/badge/status-Active-success)

---

## 📌 Overview
This project demonstrates a **secure, object-oriented** approach to building a **User Management System** in Core PHP without any frameworks.  
The backend uses **JSON** as a simulated database, while the frontend includes **Particles.js**, **SweetAlert2**, and **Anime.js** for an interactive UI.

---

## 🛠 Features
- ➕ **Add User** (with hashed passwords)
- 📋 **List Users** (excluding password field)
- 🔍 **View Single User** (AJAX + SweetAlert2 modal)
- ✏️ **Update User** (can be extended)
- ❌ **Delete User** (SweetAlert2 confirmation)
- 🛡 **Validations**:
  - Email format check
  - Password length check
  - Email uniqueness
- 🎨 **Modern UI**:
  - Particles.js animated background
  - SweetAlert2 popups
  - Anime.js animations
  - Glassmorphism styling
- 🖥 **Single-page feel** via AJAX

---

## 🏗 Architecture
```plaintext
┌─────────────────────┐
│  index.php          │  <-- Entry point, routes requests
└───────┬─────────────┘
        │
        ▼
┌─────────────────────┐
│  UserController     │  <-- Handles actions (add, list, view, delete)
└───────┬─────────────┘
        │
        ▼
┌─────────────────────┐
│  UserRepository     │  <-- Reads/Writes JSON file
└───────┬─────────────┘
        │
        ▼
┌─────────────────────┐
│  users.json         │  <-- Simulated database
└─────────────────────┘
```
🖼 Tech Stack
| Technology                                                                       | Purpose                |
| -------------------------------------------------------------------------------- | ---------------------- |
| ![PHP](https://img.icons8.com/color/30/php.png) **PHP (OOP)**                    | Backend logic          |
| ![JSON](https://img.icons8.com/ios/30/json.png) **JSON**                         | Simulated database     |
| ![JavaScript](https://img.icons8.com/color/30/javascript.png) **JavaScript**     | Frontend interactivity |
| ![SweetAlert2](https://img.icons8.com/fluency/30/ok.png) **SweetAlert2**         | Stylish popups         |
| ![Anime.js](https://img.icons8.com/fluency/30/animation.png) **Anime.js**        | Smooth animations      |
| ![Particles.js](https://img.shields.io/badge/Particles.js-purple?logo=javascript&logoColor=white) **Particles.js** | Background particles   |

📂 Folder Structure
```plaintext

/user-management/
├── index.php
├── classes/
│   ├── User.php
│   ├── UserRepository.php
│   └── UserController.php
├── data/
│   └── users.json
└── views/
    ├── add_user_form.php
    └── user_list.php

```
🚀 How to Run Locally
Clone the repo

```bash
git clone https://github.com/yourusername/user-management.git
cd user-management
```
Start a local PHP server
```bash
php -S localhost:8000
```
Open in browser
```bash
http://localhost:8000
```