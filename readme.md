## Laravel Quicksilver

This repo is a Laravel 5 host application for [matthew-james/quicksilver](https://github.com/matthew-james/quicksilver), a demo application to demonstrate hexagonal architecture.

### Setup

```
composer install
touch database/database.sqlite
php artisan migrate
php artisan customer:create
```

### Using The App

Run `php artisan serve` to start the built in webserver.

#### Create a Delivery

##### Console

```
php artisan delivery:create 'Tyler Durden' '555 Paper St' 'Chicago' 'IL' '30303' 'Joey Ramone' '222 Michigan Ave' 'Chicago' 'IL' '99922' 'STANDARD'
```

##### Rest API

Endpoint:

```
POST http://localhost:8000/delivery

{
    "pickup_name": "Tyler Durden",
    "pickup_street": "555 Paper St",
    "pickup_city": "chicago",
    "pickup_state": "IL",
    "pickup_post_code": "66043",
    "dropoff_name": "Joey Ramone",
    "dropoff_street": "222 Michigan Ave",
    "dropoff_city": "chicago",
    "dropoff_state": "IL",
    "dropoff_post_code": "99922",
    "priority": "STANDARD"
}
```

#### Pickup a Delivery

##### Console

```
php artisan delivery:pickup {id}
```

##### Rest API

```
PATCH http://localhost:8000/delivery/{id}

{
    "status": "PICKED_UP"
}
```

#### Dropoff a Delivery

##### Console

```
php artisan delivery:deliver {id} {signature}
```

##### Rest API

```
PATCH http://localhost:8000/delivery/{id}

{
    "status": "DELIVERED",
    "signature": "Joey Ramone"
}
```