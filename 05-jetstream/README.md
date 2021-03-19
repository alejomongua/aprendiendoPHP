# Jetstream playground

Este proyecto tiene como objetivo entender que es jetstream y que lo diferencia de sus alternativas: laravel/ui y laravel/breeze

Para crear este proyecto se usaron los siguientes comandos:

    laravel new 05-jetstream
    cd 05-jetstream/
    composer require laravel/jetstream
    php artisan jetstream:install livewire
    npm install
    npm run dev
    mysql -u root -p -e "create database 05-jetstream;" # Crear la base de datos
    php artisan migrate
    php artisan vendor:publish --help
    php artisan serve

Queda la aplicación sirviendo en http://localhost:8000
