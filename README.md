<h1>CityCard</h1>
### Backend

1. Clone/copy project **repository**.

2. Copy `.env.example` to `.env` and set options:
   Linux cp .env.example .env
   Windows copy .env.example .env
    - app
    - database
    - mail
    - etc...

3. Install:
    ```bash
    composer install
    php artisan key:generate
    ```

4. Run migrations:
    ```bash
    php artisan migrate
    ```
5. Run DB seeders:
    ```bash
    php artisan db:seed 
