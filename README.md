
# Epitrade backend installation

This repository is the backend part of a bigdata student project using : Next / Laravel / Kafka / Spark


## Steps to install

Clone the project (ssh)

```bash
  git clone git@github.com:sachamutschler/t-dat-bigdata-laravel.git
```

Go to the project directory

```bash
  cd t-dat-bigdata-laravel
```

Install dependencies

```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php83-composer:latest \
  composer install --ignore-platform-reqs
```

Setup .env

```bash
  cp .env.example .env
```

Generate encryption key

```bash
docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php83-composer:latest \
 php artisan key:generate
```

Install Sail (Docker env for Laravel)

```bash
docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php83-composer:latest \
 php artisan sail:install
```

Launch Sail containers

```bash
./vendor/bin/sail up
```

Lauch database migrations

```bash
./vendor/bin/sail artisan migrate
```

Url of the backend api:

```bash
http://localhost:8080/api/crypto
```


## API Reference

#### Get all bitcoins by symbol for a time period

```http
  GET /api/crypto/{symbol}/{time}/{timeValue}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `symbol` | `string` | **Required**. the crypto symbol |
| `time` | `string` | **Required**. time type : ['hours', 'days', 'weeks', 'months', 'years'] |
| `timeValue` | `int` | **Required**. Time duration ex: 3 for 3 days or hours |


