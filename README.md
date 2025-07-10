# Student Management System — SOLID PHP + React + Docker
[![Run PHPUnit Tests](https://github.com/hsinatnias/student_system/actions/workflows/php-tests.yml/badge.svg)](https://github.com/hsinatnias/student_system/actions/workflows/php-tests.yml)

A modular and testable **Student Management System** built with:

* ✅ PHP (custom framework based on SOLID principles)
* ✅ React (frontend)
* ✅ Docker (isolated development environment)
* ✅ PHPUnit (unit testing)

---

## 🚀 Features

### ✅ Backend (PHP)

* Modular structure using PSR-4 autoloading
* Follows SOLID principles
* Custom dependency injection container
* API routes (e.g., `/api/student`, `/api/student/dashboard`)
* PDO for database interaction
* Environment config via `.env`

### ✅ Frontend (React)

* React + React Router
* Axios for HTTP requests to API
* Home page fetching student data from backend

### ✅ DevOps

* Docker Compose setup for PHP + MySQL + Nginx + phpMyAdmin
* Separate React development (`frontend/`) with build copied to `public/`
* CI-ready structure (e.g., GitHub Actions)

---

## 🗂️ Folder Structure Overview

```
student_system/
├── app/
│   ├── public/                # PHP entry point (index.php)
│   ├── src/                  # Application source
│   │   └── Student/          # Student module (Controllers, Models, etc.)
│   └── tests/                # PHPUnit test cases
├── docker/                   # Dockerfiles and nginx config
│   ├── nginx/
│   └── php/
├── frontend/                 # React frontend (React Router + Axios)
│   ├── src/
│   ├── public/
│   └── build/                # Production build
├── public/                   # Served by Nginx (React + API entry)
├── vendor/                   # Composer dependencies
├── .env                      # Environment config (PHP)
├── composer.json             # PSR-4 autoloading config
├── docker-compose.yml        # Docker environment
└── phpunit.xml               # PHPUnit config
```

---

## ⚙️ Local Development Setup

### 1. Clone and Start Docker

```bash
git clone <repo-url>
cd student_system
docker-compose up -d --build
```

### 2. Install PHP Dependencies

```bash
docker-compose exec app composer install
```

### 3. React Setup

```bash
cd frontend
npm install
npm run build
cp -R build/* ../public/  # Copies built React app into PHP public folder
```

### 4. Access App

* React frontend: [http://localhost:8080/](http://localhost:8080/)
* API endpoint: [http://localhost:8080/api/student](http://localhost:8080/api/student)
* phpMyAdmin: [http://localhost:8081/](http://localhost:8081/)

---

## 🔁 Architecture Diagram

```
       +---------------------+              +------------------+
       |     React Frontend |  <-------->  |     API (PHP)    |
       | (Served from Nginx)|              |   (index.php)    |
       +---------------------+              +------------------+
                 |                                  |
                 v                                  v
         /public/index.html                /public/index.php
                                               |
                                               v
                                     Routes -> Controllers
                                               |
                                               v
                                    Repositories -> Database
```

---

## ✅ Checklist Before Deployment

* [x] React build copied to `public`
* [x] `.env` file with production DB credentials
* [x] Docker containers run without error
* [x] PHPUnit tests pass
* [ ] Enable HTTPS in production Nginx config
* [x] CI pipeline (e.g., GitHub Actions) configured for tests
* [ ] CORS config if API and frontend are separated

---
## ✅ Work In Progress

* [ ] Admin dashboard
* [ ] Faculty dashboard
* [ ] Course and Faculty Management modules
* [ ] PHPUnit Tests for newly added API module
---

## 👥 Contributors

* Anish (Lead Developer)


---

## 📜 License

MIT
