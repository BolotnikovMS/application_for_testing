# Application for testing.

<p>This application is intended for testing.</p>

## Getting Started

Clone the project repository by running the command

```
git clone git@github.com:BolotnikovMS/application_for_testing.git
```

If you use https, use this instead

```
git clone https://github.com/BolotnikovMS/application_for_testing.git
```

Run the command below to install dependencies

```
npm install
```

## Setting Up

Duplicate `.env.example` and rename it `.env`

### Key generate

```
php artisan key:generate
```

insert into APP_KEY =

### Database And Migrations

Setup your database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Perform table migrations:

```
php artisan migrate
```

### Starting

```
php artisan serve
```

and visit [http://127.0.0.1:8000/](http://127.0.0.1:8000/) to see the application in action.
