# PM Tool - Case Study

## Overview

Project management tool that allows users to create, update, delete, and manage projects and tasks, along with auth functionality using
laravel sanctum api authentication
## Table of Contents

- [Installation](#installation)
- [API Endpoints](#api-endpoints)

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

## API Endpoints
   #### Create Task

- **Endpoint**: `/api/create/task`
- **Method**: `POST`
- **Description**: Create a new task within a project.
- **Request Body**:
  ```json
  {
      "project_id": 2,
      "name": "Implement Repository Pattern Architecture Structure",
      "description": "Create structure for design pattern",
      "status": "todo" // options: todo, in-progress, done
  }


#### Update Task

- **Endpoint**: `/api/projects/tasks/{id}`
- **Method**: `PUT`
- **Description**: Update an existing task for a specific project.
- **Request Body**:
  ```json
  {
      "project_id": 2,
      "name": "Implement Repository Pattern Architecture Structure",
      "description": "Create structure for design pattern",
      "status": "todo" // options: todo, in-progress, done
  }


#### Get Tasks for a Specific Project

- **Endpoint**: `/api/projects/{id}/tasks`
- **Method**: `GET`
- **Description**: Retrieve a list of tasks for a specific project, with pagination support.
- **Query Parameters**:
  - `per_page`: Number of tasks to return per page (e.g., `10`).
  - 
#### Delete Task

- **Endpoint**: `/api/projects/tasks/{id}`
- **Method**: `DELETE`
- **Description**: Delete a specific task by its ID.
- **Example Request**:

### Projects

#### Get All Projects

- **Endpoint**: `/api/projects`
- **Method**: `GET`
- **Description**: Retrieve a list of all projects.
### Projects

#### Create Project

- **Endpoint**: `/api/create/project`
- **Method**: `POST`
- **Description**: Create a new project.
- **Request Body**:
  ```json
  {
      "name": "Muhammad Bin Rashid School of Government",
      "description": "Complete school work along with dynamic services creation using workflow"
  }

### Projects

#### Get Specific Project

- **Endpoint**: `/api/project/{id}`
- **Method**: `GET`
- **Description**: Retrieve details of a specific project by its ID.
- **Example Request**:
### Projects

#### Update Project

- **Endpoint**: `/api/project/{id}`
- **Method**: `PUT`
- **Description**: Update an existing project by its ID.
- **Example Request**:
### Authentication

#### User Registration

- **Endpoint**: `/api/auth/register`
- **Method**: `POST`
- **Description**: Register a new user account.
- **Request Body**:
  ```json
  {
      "name": "John",
      "email": "John@gmail.com",
      "password": "12345678",
      "password_confirmation": "12345678",
      "roles": ["Project Manager"]
  }
### Authentication

#### User Login

- **Endpoint**: `/api/auth/login`
- **Method**: `POST`
- **Description**: Authenticate a user and return an access token.
- **Request Body**:
  ```json
  {
      "email": "Farhan@gmail.com",
      "password": "12345678",
      "token_name": "Personal Access Token"
  }


