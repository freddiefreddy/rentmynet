


/
    ```
1. Install dependencies
    ```bash
    composer install
    ```
1. Copy `.env.example` to `.env` to setup you environment.
    ```bash
    cp .env.example .env
    ```

1. Set your application key to a random string.
    ```bash
    php artisan key:generate
    ```

1. Edit `.env` to add your Twilio access keys.
    ```bash
    TWILIO_ACCOUNT_SID=ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    TWILIO_AUTH_TOKEN=7axxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    TWILIO_VERIFICATION_SID=VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    ```

1. Run migrations to create the database.
    ```bash
    touch database/rentmynet
    php artisan migrate
    ```

1. Run the application.
    ```bach
    php artisan serve
    ```

1. Check it out at [http://localhost:8000](http://localhost:8000)


That's it!

## Run the tests

1. Run phpunit
   ```bash
   ./vendor/bin/phpunit
   ```


