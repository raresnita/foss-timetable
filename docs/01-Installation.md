# 01. Installation and setup

This guide will help you set up the project and get a local development environment running.
The project uses Laravel 12, Vite, and TailwindCSS

## Prerequisites

Ensure that on your machine you've got the following installed:
- PHP 8.2 or newer (requirement for Laravel 12)
- Composer
- Node.js & NPM (for TailwindCSS and Vite)

## Setup

### 1. Clone and dependencies installation

Copy the following commands into your terminal.

```bash
git clone https://github.com/raresnita/foss-timetable.git  
cd foss-timetable  
composer install  
npm install
```

### 2. Configure the environment

Copy the example environment file. We are using SQLite in this project.

```
cp .env.example .env
php artisan key:generate
```

Note: the according `database.sqlite` file will be generated after we run the migration command.

### 3. Database migration & seeding

Run the migrations to create the table structure and seed the database with placeholder data

```bash
php artisan migrate --seed
```

### 4. Compile assets

Because this project uses Vite to process the styling made using TailwindCSS, we need to run the development server.

```bash
npm run dev
```

### 5. Start the application

In a new terminal app, type the following.

```bash
php artisan serve
`````

Then, access `http://localhost:8000` in your browser of choice.


## Front-end stack

We use TailwindCSS for styling
- configuration file and entry point: `resources/css/app.css`
- Vite config: `vite.config.js`

To build the assets for production:

``` bash
npm run build
```
