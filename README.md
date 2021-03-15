# Users CRUD - With TALL Stack (Tailwind, Alpine, Laravel and Livewire)
This is a sample application to demonstrate how we can use the TALL stack to make a simple users CRUD.

## Demo
You can check the [Application DEMO here](http://pedroroccon.com.br/tall)

## How to install

### Dependencies
To install and run the application, first you need to clone this repository:  
```
git clone https://github.com/pedroroccon/users-crud-tall
```

Now, we should install the PHP dependencies as well the Javascript dependencies:  
```
php composer.phar install
npm install
```

Run the following command to compile the Javascript assets:
```
npm run prod
```
If you wish, you can use the **npm run dev** instead.

### Configuring the application
Now that we installed all the dependencies, we need to configure the application.  
Let's start creating a **.env** file, and generate a unique key to application:
```
cp -R .env.example .env
php artisan key:generate
```

Open the .env file and change the **APP_URL** to your application URL. By default, we are using the built-in PHP server, which creates a localhost connection on port 8000. If you want to deploy this application in your server, you should modify this to your server's URL.
```
APP_URL=http://localhost
```

We should now configure the database. For this example, we are using the **SQLite** database, but you can use MySQL, SQLServer or PostgreSQL. Let's open the .env file and change the DB configuration lines to use the SQLite.  

Change this:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

To this:  
```
DB_CONNECTION=sqlite
```

Now we should create a empty database/database.sqlite file. We will need this file before to run our migrations. If you are on Windows, you can simply create this file. In UNIX based systems, you can create the file using the touch command.
```
touch database/database.sqlite
````

Let's define the files and folders permissions
```
chmod 0777 -R storage/ bootstrap/ database/
```

Run the migrations with the --seed option to create the database tables with some dummy users.

```
php artisan migrate --seed
```

## Starting the app
To start and use your app, run the following command:
```
php artisan serve
```

Your application should starts running at http://localhost:8000  
Alternatively, you can specify the application port

```
php artisan serve --port 2563
```

## Running tests
Use the command below to run the unit and feature tests

```
php artisan test
```