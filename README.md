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

<img width="960" height="414" alt="image" src="https://github.com/user-attachments/assets/e73f2ef1-cfda-49fd-817c-dae1f427c054" />

<img width="946" height="412" alt="image" src="https://github.com/user-attachments/assets/99e1d35a-559c-4a2d-a70e-ceeda516cbc8" />

<img width="959" height="413" alt="image" src="https://github.com/user-attachments/assets/77955040-25ef-4640-b108-81f4623febe3" />

<img width="960" height="413" alt="image" src="https://github.com/user-attachments/assets/6eac88e0-f3c9-4bf4-8f84-c43b0de52621" />

<img width="949" height="413" alt="image" src="https://github.com/user-attachments/assets/3076fd64-5a2f-43e0-9c0a-572e3c427ba0" />

