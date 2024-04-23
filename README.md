# laravel_epi
#create new project
curl -s "https://laravel.build/laravel_epi" | bash
cd laravel_epi
./vendor/bin/sail up
# need install sail 
composer require laravel/sail --dev
php artisan sail:install
laravel project epi 
