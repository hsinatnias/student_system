# Student Management System (Modular PHP Project)

A modular PHP application built from scratch with **SOLID principles**, **Dependency Injection**, **custom service container**, and **modular structure**. This project showcases a clean architecture approach for building scalable and testable PHP applications.

---

## 🌟 Features

- Custom-built PHP framework (no Laravel/CodeIgniter)
- Follows **SOLID** design principles
- Custom **PSR-4 autoloading** via Composer
- Basic **Dependency Injection Container**
- Modular folder structure
- Environment configuration using **Dotenv**
- MySQL support with PDO
- Dockerized development environment
- PHPUnit testing support

---

## 🗂️ Project Structure

```
project-root/
│
├── app/
│   ├── src/
│   │   ├── Container/               # Custom service container
│   │   ├── Core/                    # Shared framework logic (e.g. routing)
│   │   └── Modules/
│   │       ├── Student/
│   │       │   ├── Controllers/
│   │       │   ├── Models/
│   │       │   ├── Repositories/
│   │       │   ├── Services/
│   │       │   └── Contracts/
│   │       └── ... (future modules: Academics, Administration etc.)
│
├── public/
│   └── index.php                    # Front controller
│
├── tests/                           # PHPUnit tests
│
├── docker/                          # Docker configuration
│   ├── php/
│   └── nginx/
│
├── .env
├── composer.json
├── docker-compose.yml
└── README.md
```

---

## ⚙️ Getting Started

### 🐳 Run with Docker

```bash
docker compose up -d --build
```

The application will be available at:  
http://localhost:8080

PHPMyAdmin:  
http://localhost:8081  
(MySQL username: `user`, password: `password`)

---

## ✅ Requirements

- Docker & Docker Compose
- PHP 8.2+ (if running locally)
- Composer

---

## 🧪 Running Tests

```bash
docker compose exec app ./vendor/bin/phpunit
```

---

## 💡 Principles Followed

- **Single Responsibility** – each class has one responsibility
- **Open/Closed** – system can be extended without modifying existing code
- **Liskov Substitution** – modules use abstractions
- **Interface Segregation** – smaller, client-specific interfaces
- **Dependency Inversion** – code depends on abstractions

---

## 📌 Environment Variables

Create a `.env` file in the root:

```ini
DB_DRIVER = MySQLi
DB_HOST = db
DB_PORT = 3306
DB_NAME = app_db
DB_USER = user
DB_PASS = password
```

---

## 🧱 Upcoming Features

- Module for Academics
- Module for Administration
- Authentication system
- Middleware support
- Full router layer
- API support (REST/JSON)

---

## 📚 License

This project is open-source and free to use under the [MIT License](LICENSE).





---

## 👨‍💻 Author

Developed by [Anish V M]
