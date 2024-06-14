# atrocity-be

This repository contains the back-end system of the Atrocity project using Laravel 10.

The front-end system is available in this repository.
https://github.com/22DP1ACiru/atrocity-fe

## Instructions

### Dependencies:

-   Node.js
-   XAMPP or any other MySQL server hosting alternative
-   Composer

### Setup

1. Clone the repositories.
2. Open XAMPP and start the Apache and MySQL services.
3. Run `npm install` in the front-end repository.
4. Run `composer install` in the back-end repository.
5. Open a terminal in the front-end repository using an IDE of your preference and run `npm run dev`
6. Once the front-end system is launched, open a terminal in the back-end repository and run `php artisan migrate --seed`
7. Start up the back-end system by running `php artisan serve`
8. Once it's launched, indicated by a message in the terminal, you can refresh the front-end site and use the system.

### Notes

-   By default, front-end system is hosted at `http://localhost:5173/` and the back-end system - `http://localhost:8000/`.
-   If the connection between the front-end and back-end systems is not working, check DB_PORT in the .env file in the back-end repository and that DB_DATABASE exists in your preferred hosting application.
    DB_PORT should be set to 3306 by default.
