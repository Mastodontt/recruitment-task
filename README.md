to run:
composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate

Open your browser and go to http://localhost/pets to test the application.

in .env.example theres already api url set up - not a good practice but i did that for faster
check