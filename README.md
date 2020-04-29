# PizzaWorld Backend

This repository represents the backend side of the application PizzaWorld. A project the shows pizza list for guests and allow them to make orders.

## Project Setup

1. Clone the repository into the desired location

```
git clone https://github.com/majebry/pizza-backend.git
```

2. `cd` into the created folder to install composer packages

```
cd pizza-backend && composer install
```

3. Create `.env` file from `.env.example`

4. Generate an application key

```
php artisan key:generate
```

5. Create a database for your project and update the following database connection configurations inside `.env`

```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

6. Migrate and seed the database, in order to get a list of pizzas and an admin user to login

```
php artisan migrate --seed
```

7. This project uses `laravel/passport` for admin authentication, so you need to install passport

```
php artisan passport:install
```
Once you get this command output copy the `Client ID` and the `Client secret` for the `Password grant client` and update them in your `.env` file

```
PASSPORT_CLIENT_ID=
PASSPORT_CLIENT_SECRET=
```

8. You need to also run the following command in order to create a public symbolic link to the application storage. This will allow guests to see pizza photos

```
php artisan storage:link
```

## Usage

You can login as an admin (in order to view the order history) with the following credentials
- Username: `admin@example.test`
- Password: `password`

## Tests

Before you run the tests, duplicate your `.env` file to `.env.testing`

Update the following values in `.env.testing`

```
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

Now you can run the tests:

```
./vendor/bin/phpunit
```
