

# Web Coding Challenge

One Paragraph of project description goes here

## Technologies used

- PHP
  - Backend : Laravel
  - Frontend : VueJS
  - Database : MySQL

## Features
- As a User, I can sign up using my email & password
- As a User, I can sign in using my email & password
- As a User, I can display the list of shops sorted by distance (ip geolocalisation)
- As a User, I can like a shop, so it can be added to my preferred shops
  - Acceptance criteria: liked shops shouldn’t be displayed on the main page
- As a User, I can dislike a shop, so it won’t be displayed within “Nearby Shops” list during the next 2 hours
- As a User, I can display the list of preferred shops
- As a User, I can remove a shop from my preferred shops list

## Prerequisites

What things you need to install the software and how to install them

```
Give examples
```

## Installing

The git file contains all laravel files integrated , however you need to perform following steps to get vendors etc.

- Get Composer packages
```
composer install
```
- If you are on linux/ mac you can run below command to change permissions.
permissions
```
chmod -R 775 storage
```
```
chmod 775 bootstrap/cache
```
- database credentials
```
cp .env.example .env
```
- open .env and modify database details with yours

- Generate Key
```
php artisan key:generate
```

- run local Server
```
php artisan serv
```


## informations

- geolocalisation for nearby shops filter
  - i user ip geolocalisation for get user localisations (latitude and longetude) from API (http://ip-api.com/)
  - if u test server localy please put ur ip manually () cause if not system will get 127.0.0.1 as ip adress if test will be on server all ok then
    - function for change ip (app/Http/Controllers/ShopController.php)
    ```
    public function index()
    {
      // if localy client ip will get 127.0.0.1
      //$clientIP = request()->ip();
      $clientIP = '41.140.197.188';

      //get ip  loatitude and langetude
      $lat=getlocation($clientIP)->lat;
      $lng=getlocation($clientIP)->lon;



      //function to get all shops filtred by nearby one and with out desiliked shop addn liked one
      $shops=orderbydist($lat,$lng,Auth::user()->id);

       return response()->json($shops);
    }
    ```
  - you can get all function used on "app/Http/Controllers/ShopController.php" and "app/helpers.php"

## Application Data

  i have convert all mongodb data to sql one :

  → → Dump File : <a href="https://packagist.org/packages/laravel/framework">SQL</a>
