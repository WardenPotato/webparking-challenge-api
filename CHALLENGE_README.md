
# Running locally
1. Make sure you meet the minimum requirement and have a correct Laravel installation https://laravel.com/docs/12.x/installation
2. Clone this project into a folder
3. Inside the project directory run `composer install` `npm install && npm run build` `php artisan migrate` and then `composer run dev`

# Architecture
This project uses architecture that is listed as best practice in the Laravel documentation.
This architecture makes use of Controllers that tie into Models of the Eloquent ORM that in turn interface with the database.
Exact Online was simulated as a simple response from a Service class that includes logging.