
# Employees Application

The Employees Application is a web-based application built with Laravel, utilizing PHP 8.2 and AdminLTE components. It provides functionality to manage and track employee information within an organization.
## Features

- User authentication: Users can register, login, and manage their accounts.
- Employee management: Create, update, and delete employee records.
- Employee listing: View a list of all employees with basic information.
- Employee details: Display detailed information about individual employees.
- Search and filtering: Find employees based on specific criteria.
- Management assignment for an up to 5th grade management level
- User-friendly interface: Utilizes the AdminLTE components for a responsive and visually appealing design.


## Requirements

- PHP 8.2

- Laravel 10.9.2

- Vite 4.3.4

- MySQL

- Composer



## Installation

- Clone the repository:

```bash
  git clone https://github.com/kaliush/employees.git
```
- Navigate to the project directory:
 ```bash
  cd employees
```   
- Install the dependancies via Composer:
 ```bash
  composer install
```  
- Create a .env file:
 ```bash
  cp .env.example .env
```  
- Generate a new application key:
 ```bash
  php artisan key:generate
```   

- Configure your database in the .env file

- Run database migrations:
```bash
  php artisan migrate
```   
- Seed the database with sample data (optional):
```bash
  php artisan db:seed
```    
- Start the application:
```bash
  php artisan serve
```   

- Visit http://localhost:8000 in your browser
## Acknowledgements
The Employees Application utilizes the following open-source components:
- [Laravel PHP Framework](https://laravel.com)
- [AdminLTE](https://adminlte.io)
- [Vite](https://vitejs.dev)
- [Bootstrap](https://getbootstrap.com)
- [Font Awesome](https://fontawesome.com)
