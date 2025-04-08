# 🚀 Task Management Laravel Application

Welcome to the **Task Management Laravel Application**! This is a simple yet powerful task management system built with Laravel, designed to help users organize, track, and manage their tasks efficiently.


## 🌟 Features

- 🔒 **User Authentication**: Register, login, and manage your profile.
- 📝 **Task Management**: Create, update, delete, and mark tasks as completed.
- 🔍 **Search & Filter**: Easily search and filter tasks by title, category, or status.
- 📱 **Responsive Design**: Works seamlessly on both desktop and mobile devices.

---

## 🛠️ Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** (>= 8.0)
- **Composer** (for dependency management)
- **Node.js** (for frontend assets)
- **MySQL** (or any other supported database)
- **Git** (for version control)

---

## 🚀 Installation

### Step 1: Clone the Repository

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/Dimeji12/task-manager.git
   cd task-manager

Step 2: Set Up the .env File
Copy the .env.example file to .env:

cp .env.example .env
On Windows:

bash
copy .env.example .env

Generate the application key:
php artisan key:generate

Update the database configuration in .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=your_mysql_password_here
Replace your_mysql_password_here with your MySQL password. If your MySQL server does not use a password, leave DB_PASSWORD empty.


Step 3: Install Dependencies
Install Composer dependencies:

composer install
Install Node.js dependencies:


npm install
Step 4: Set Up the Database
Create the Database:

Open your MySQL server (e.g., using phpMyAdmin, MySQL Workbench, or the MySQL command line).

Create a new database named task_management (or the name you specified in .env).

Run Migrations:
Run the migrations to create the necessary tables:

php artisan migrate

Seed the Database:

Seed the database with dummy data (I already implemented database seeder with 10 users and 50 tasks):
php artisan db:seed

Alternatively, run migrations and seeders together:
php artisan migrate --seed

Step 5: Run the Application
Install Concurrently:
Install concurrently globally to run multiple commands simultaneously:(server and client)
npm install -g concurrently
Start the Application:
Use concurrently to start both the Laravel server and Vite:
concurrently "php artisan serve" "npm run dev"

This will:

Start the Laravel development server at http://127.0.0.1:8000.

Start Vite for frontend assets at http://localhost:5173.

Access the Application:
Open your browser and navigate to http://127.0.0.1:8000.

👤 Log In or Register
If You Seeded Users:
If your seeder includes a default user, you can log in with the seeded credentials. 

If You Need to Register:
Go to the registration page (usually /register).

Fill in the required details (name, email, password, etc.).

Submit the form to create a new user.

If You Need to Log In:
Go to the login page (usually /login).

Enter the email and password for the seeded or registered user.

Submit the form to log in.




🚨 Troubleshooting
Common Issues
Database Connection Issues:

Ensure your MySQL server is running.

Verify the database credentials in .env.

Frontend Assets Not Loading:

Ensure Vite is running (npm run dev).

Check the browser console for errors.

Missing .env File:

Copy .env.example to .env and generate the application key:

bash
Copy
cp .env.example .env
php artisan key:generate
Clear Cache:
If you encounter issues, clear the cache:

bash
Copy
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

🤝 Contributing
If you'd like to contribute to this project, please follow these steps:

Fork the repository.

Create a new branch (git checkout -b feature/YourFeatureName).

Commit your changes (git commit -m 'Add some feature').

Push to the branch (git push origin feature/YourFeatureName).

Open a Pull Request.

