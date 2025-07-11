# Student Management System — SOLID PHP + React + Docker
[![Run PHPUnit Tests](https://github.com/hsinatnias/student_system/actions/workflows/php-tests.yml/badge.svg)](https://github.com/hsinatnias/student_system/actions/workflows/php-tests.yml)

A modular and testable **Student Management System** built with:

* ✅ PHP (custom framework based on SOLID principles)
* ✅ React (frontend, Vite, UnoCSS)
* ✅ Docker (isolated, reproducible environment)
* ✅ PHPUnit (unit testing)

---

## 🚀 Features

### ✅ Backend (PHP)
* Modular structure using PSR-4 autoloading
* Follows SOLID principles
* Custom dependency injection container with service providers
* API routes (e.g., `/api/student`, `/api/auth/login`)
* Repository and Service layers for business logic
* JWT-based authentication & role-based access
* PDO for database interaction
* Environment config via `.env`
* PHPUnit test coverage

### ✅ Frontend (React + UnoCSS)
* Vite-powered modern React build
* UnoCSS (Wind3 preset) — utility-first, atomic CSS
* React Router for SPA navigation
* Axios for API requests
* JWT handled with React Context
* Fully responsive & clean design

### ✅ DevOps
* Docker Compose setup for PHP + MySQL + Nginx + phpMyAdmin + Node
* Nginx serves React from frontend/build and proxies API to PHP
* CI-ready: GitHub Actions for PHPUnit
* Scripts for easy local build & deployment

---

## 🗂️ Folder Structure Overview

```
student_system/
├── app/
│   ├── bootstrap.php              # DI setup, env loader
│   ├── routes.php                 # Route map
│   ├── public/                    # PHP entry point (index.php)
│   └── src/                       # All code, organized by module (Auth, Student, etc)
│       ├── Auth/
│       ├── Student/
│       ├── Core/
│       ├── Database/
│       └── Providers/
├── docker/                        # Dockerfiles & configs
│   ├── nginx/
│   └── php/
├── frontend/                      # React frontend (Vite + UnoCSS)
│   ├── src/
│   ├── uno.config.ts
│   ├── vite.config.js
│   └── build/
├── tests/                         # PHPUnit tests
├── docker-compose.yml
├── composer.json
├── package.json
├── phpunit.xml
└── README.md
```

---

## ⚙️ Local Development Setup

### 1. Clone and Start Docker

```bash
git clone <repo-url>
cd student_system
docker compose up -d --build
```

### 2. Install PHP Dependencies

```bash
docker compose exec app composer install
```

### 3. React Setup

```bash
cd frontend
npm install
npm run build
```
*The build will be mounted to Nginx and served automatically.*

### 4. Access the App

* React frontend: [http://localhost:8080/](http://localhost:8080/)
* API endpoint: [http://localhost:8080/api/student](http://localhost:8080/api/student)
* phpMyAdmin: [http://localhost:8081/](http://localhost:8081/)

---

## 🔁 Architecture Diagram

```
       +---------------------+              +------------------+
       |     React Frontend  |  <-------->  |     API (PHP)    |
       | (Served from Nginx) |              |   (index.php)    |
       +---------------------+              +------------------+
                 |                                  |
                 v                                  v
         /frontend/build/index.html         /app/public/index.php
                                               |
                                               v
                                    routes.php → Controllers
                                               |
                                               v
                                 Repositories/Services → Database
```

---

## ✅ Checklist Before Deployment

* [x] React build available in `frontend/build`
* [x] `.env` file with DB credentials present
* [x] Docker containers run without error
* [x] PHPUnit tests pass
* [x] CI pipeline (GitHub Actions) configured
* [ ] Enable HTTPS in production Nginx config
* [ ] Configure CORS if API/frontend separated

---

## 🚧 Work In Progress

* [ ] Admin dashboard
* [ ] Faculty dashboard
* [ ] Course and Faculty Management modules
* [ ] Additional test coverage
* [ ] Production HTTPS setup

---

## 👥 Contributors

* Anish (Lead Developer)

---

## 📜 License

MIT

---

> _This project is on a short break — development will resume soon.  
> Special thanks to ChatGPT for architectural and code review assistance._