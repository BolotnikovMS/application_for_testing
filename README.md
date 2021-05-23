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


<p>To use it is necessary:</p>
<ul>
    <li>Install all dependencies</li>
    <li>Generate the key(Php artisan key:generate) and substitute it into the ENV file</li>
    <li>Create a database and specify the parameter for connection in the ENV file</li>
    <li>Perform table migrations.</li>
</ul>
