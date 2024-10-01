# PM Tool - Case Study

## Overview

Project management tool that allows users to create, update, delete, and manage projects and tasks, along with auth functionality using
laravel sanctum api authentication
## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Installation

### 1. Clone the Repository

### Prerequisites

- PHP (version >= 8.1.0)
- Composer 2.6.2
- Laravel 10
- MY SQL
### Steps

1. **Clone the repository**:
   ```bash
     https://github.com/farazsheikh818/PM-Tool-case-study-.git
    1. composer install
    2. cp .env.example .env
    3. php artisan key:generate
   
2. **Set Up Database Configuration**: 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
   
4. **Run Migrations**
    php artisan migrate
   
6. **Run Migrations**
   php artisan db:seed --class=RoleAndPermissionSeeder
   php artisan db:seed --class=UserSeeder
   
7.  **Start the Development Server**
    php artisan serve

