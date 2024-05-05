# Adatbalapok - Repülőhely

Welcome to the **Adatbalapok - Repülőhely** project repository!

## Overview

This repository contains data and analysis related to airports and air travel.



## Laravel Project Setup

To serve the Laravel project on your server, follow these steps:

### Prerequisites

- PHP (>=7.4) installed on your server
- Composer installed on your server
- MySQL or another compatible database server

### Installation
0. Insert the included sql to your oracle server.

1. Clone the repository to your server:

   ```bash
   git clone https://github.com/acelbeton/adatbalapok.git
   ```

2. Navigate to the `repulohely` directory:

   ```bash
   cd adatbalapok/repulohely
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Create a copy of the `.env.example` file and rename it to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Configure the `.env` file with your database connection details and any other necessary environment variables.
   Same like this!
   
    - DB_CONNECTION=oracle
    - #DB_HOST=localhost
    - #DB_PORT=1521
    - #DB_DATABASE=xe
    - #DB_USERNAME=SYSTEM
    - #DB_PASSWORD= (Your password to oracle)

8. Run the database migrations to create the necessary tables:

   ```bash
   php artisan migrate
   ```


### Serving the Application

Once the setup is complete, you can serve the Laravel application using a web server like Apache or Nginx. Alternatively, you can use Laravel's built-in development server for testing purposes:

```bash
php artisan serve
```

## Contact

If you have any questions, suggestions, or feedback, feel free to contact the project maintainer:

- Name: Bencsik András Pál
- Name: Fekete Marcell
- Name: Szentesi Dominik
