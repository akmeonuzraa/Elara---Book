# 📚 Elara — Book

A modern book management web application built with **Laravel**. Elara provides a clean, intuitive interface for cataloging, browsing, and managing books — whether for personal use or as a small library system.

---

## ✨ Features

- **Book Management** — Add, edit, and delete books with ease
- **Browse & Search** — Quickly find books in your collection
- **Responsive UI** — Fully responsive design built with Laravel Blade templates
- **Database Migrations** — Clean, version-controlled database schema via Laravel migrations
- **Authentication** — Secure user login and registration out of the box
- **Testing Suite** — PHPUnit integration for reliable application testing

---

## 🛠 Tech Stack

| Technology | Role |
|---|---|
| **PHP / Laravel** | Backend framework & application logic |
| **Blade** | Templating engine for views |
| **MySQL** | Relational database |
| **Composer** | PHP dependency manager |
| **Webpack Mix** | Frontend asset compilation |
| **PHPUnit** | Unit & feature testing |
| **StyleCI** | Automated code style enforcement |

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL (or compatible database)
- Node.js & npm (for asset compilation)

### Installation

**1. Clone the repository**

```bash
git clone https://github.com/akmeonuzraa/Elara---Book.git
cd Elara---Book
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Install Node dependencies & compile assets**

```bash
npm install
npm run dev
```

**4. Configure your environment**

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and update your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elara_book
DB_USERNAME=root
DB_PASSWORD=
```

**5. Run database migrations**

```bash
php artisan migrate
```

**6. Start the development server**

```bash
php artisan serve
```

Your application will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000/dashboard).

---

## 📂 Project Structure

```
Elara---Book/
├── app/                 # Core application logic (Controllers, Models, etc.)
├── bootstrap/           # Framework bootstrapping & cache
├── config/              # Application configuration files
├── database/            # Migrations, seeders & factories
├── public/              # Public entry point & static assets
├── resources/           # Views (Blade templates), CSS & JS
├── routes/              # Route definitions (web, api)
├── storage/             # Logs, cache & uploaded files
├── tests/               # PHPUnit test suites
├── .env.example         # Environment variable template
├── composer.json        # PHP dependencies
├── package.json         # Node.js dependencies
└── webpack.mix.js       # Asset compilation config
```

---

## 🧪 Running Tests

```bash
php artisan test
```

---

## 📝 Contributing

Contributions are welcome! Here's how to get involved:

1. **Fork** the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add your feature"`
4. Push to your fork: `git push origin feature/your-feature`
5. Open a **Pull Request** against `main`

Please keep code style consistent and include tests where appropriate.

---

## 📄 License

This project is open-sourced under the [MIT License](https://opensource.org/licenses/MIT).
