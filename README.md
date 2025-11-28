# Reviewer — Private Journal for Media

A personal journal application built with **Laravel** and **SQLite** to track **Movies**, **Books**, and **Video Games**.

---

## Prerequisites

- Laravel (Herd recommended) or PHP installed locally  
- Composer  
- Node.js & npm  
- Git (recommended)

---

## Installation

### 1. Navigate to the project folder

Open a terminal and navigate to your project folder:

```bash
cd reviewer
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Setup environment file

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Configure Database (SQLite)

- Open the .env file in your code editor.
- Find the DB_CONNECTION section and change it to:

```bash
DB_CONNECTION=sqlite
# Remove DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD lines
```

- Create the database file (Run this in your terminal):
• **Mac/Linux:**

```bash
touch database/database.sqlite
```

• **Windows (PowerShell):**

```bash
New-Item database/database.sqlite
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Build Assets

```bash
npm install
npm run build
```

## How to Run

### Option A: Using Laravel Herd (Recommended)

- Open the Herd application.
- The site should automatically be available at:
          http://reviewer.test

### Option B: Using Terminal

Run the local server command:

```bash
php artisan serve
```

Open your browser to:
http://localhost:8000

## Getting Started

- **Register:** Go to /register to create your first account.
- **Create:** Log a new review.
- **Toggle:** Set reviews to "Private" (only visible on Dashboard) or "Public" (visible on Homepage).
- **Filter:** Use the search bar or dropdowns to filter by Movie, Book, or Game.
