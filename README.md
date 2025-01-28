# ETMS - Employee Task Management System

## Overview

ETMS is a Laravel-based application designed to manage employees and tasks efficiently. The system supports multi-authentication (Admin and Employees) and provides features such as task assignment, status tracking, and data visualization.

---

## Instructions to Set Up and Run the Project

### Prerequisites

Before setting up the project, ensure you have the following installed on your system:

-   **PHP**: 8.0 or higher
-   **Composer**: Installed globally
-   **MySQL**: 8.0 or higher
-   **Node.js and npm**: Installed globally
-   **Laravel**: 11.x framework
-   **Git**: Installed globally

---

### Setup Steps

1. **Clone the Repository:**
   Clone the project repository to your local machine:

    ```bash
    git clone <repository_url>
    ```

2. **Navigate to the Project Folder:**
   Move into the project directory:

    ```bash
    cd etms
    ```

3. **Install Laravel Dependencies:**
   Use Composer to install the required Laravel dependencies:

    ```bash
    composer install
    ```

4. **Install Frontend Dependencies:**
   Use npm to install and compile frontend dependencies:

    ```bash
    npm install
    npm run dev
    ```

5. **Set Up the `.env` File:**

    - Copy the example environment file to create the `.env` file:
        ```bash
        cp .env.example .env
        ```
    - Update the `.env` file with your database credentials and other configurations:
        ```
        DB_DATABASE=etms_database
        DB_USERNAME=root
        DB_PASSWORD=your_password
        ```

6. **Run Database Migrations and Seeders:**
   Migrate the database tables and populate them with seed data:

    ```bash
    php artisan migrate --seed
    ```

7. **Serve the Application:**
   Start the Laravel development server:

    ```bash
    php artisan serve
    ```

    Open the application in your browser at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

8. **Import the Database:**
   If provided with a database export file (`etms_database.sql`):
    - Import it into your MySQL database:
        ```bash
        mysql -u [username] -p [database_name] < etms_database.sql
        ```

---

## Features

### Admin Dashboard:

-   **Manage Employees**: Add, update, delete, and view employees.
-   **Manage Tasks**: Create, assign, update, and delete tasks.
-   **Task Status Bar Chart**: Visualize the task status (e.g., Pending, Completed).
-   **Top Employees**: View a table of top 5 employees with the most completed tasks.

### Employee Dashboard:

-   **View Assigned Tasks**: Check tasks assigned by the admin.
-   **Update Task Status**: Mark tasks as Pending or Completed.
-   **Task Summary**: View task completion rates.

### Authentication:

-   Laravel Sanctum-based secure authentication for both admins and employees.

### Responsive Frontend:

-   User-friendly interface for both admins and employees.

---

## Explanation of Logical/Mathematical Implementations

### Employee-Task Association:

-   Each employee can have multiple tasks.
-   Eloquent `one-to-many` relationship implemented as:
    ```php
    public function tasks() {
        return $this->hasMany(Task::class);
    }
    ```

### Task Completion Rate:

-   Completion percentage is calculated as:
    ```php
    $completionRate = ($completedTasks / $totalTasks) * 100;
    ```

### Chart Data for Task Status:

-   Data for the bar chart is grouped and counted using SQL:
    ```php
    $tasks = Task::select('status', DB::raw('count(*) as count'))
                 ->groupBy('status')
                 ->get();
    ```

---

## URL to Public Repository

The project is hosted on GitHub. You can find the source code at:
[Project Repository](repository_url)

---

## Contact

For any questions, feedback, or support, please contact:

-   **Name**: S.J.M.N. Harshana
-   **Email**: namiduharshana02@gmail.com
