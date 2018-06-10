# Projet Template

[https://www.template.antonbourtnik.fr](https://www.template.antonbourtnik.fr)

## Installation

### Clone project and install dependencies

```shell
git clone https://github.com/abourtnik/template.git
cd template
composer install
```

### Configure your environnment variables

Copy `.env.example` file and name the copy `.env` and set your environnment variables in the `.env` file.

For send and receive mail in local environnment you can use :  **[http://danfarrelly.nyc/MailDev/](http://danfarrelly.nyc/MailDev/)**

If you use **Mac OS** and **MAMP** set `DB_SOCKET` variable like this `/Applications/MAMP/tmp/mysql/mysql.sock`.


### Run migrations and seeders

```shell
php artisan migrate
php artisan db:seed
```

### Generate key and link storage folder

```shell
php artisan key:generate
php artisan storage:link
```

### Configure Paypal

Create merchant and buyer accounts at [https://developer.paypal.com/developer/accounts/create](https://developer.paypal.com/developer/accounts/create)

And set `PAYPAL_ID` and `PAYPAL_SECRET` environnment variables in `.env` file

**You must have a real Paypal account for create sandbox accounts**


### Configure your web server

+ Apache or Nginx :
    [https://laravel.com/docs/5.4/installation#web-server-configuration](https://laravel.com/docs/5.4/installation#web-server-configuration)
    
You can run the intern server by use : `php artisan serve --port=8080`

Don't forget to replace `APP_URL` env variable according to your method

### Run the project

If your configure your project correctly you can see the home page on your `APP_URL` 

Click to `register` for create your first user and enjoy !!!


## Contributing

We encourage you to contribute to Template! Please check out the [Contributing to Tempate guide]
(https://github.com/abourtnik/Template/blob/master/contributing.md) for guidelines about how to proceed. Join us!

Trying to report a possible security vulnerability in Template? Send an email to 
**contact@antonbourtnik.fr** with clear description of security vulnerability.

