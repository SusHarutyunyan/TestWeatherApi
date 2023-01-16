
# Weather api laravel


## Deployment

To deploy this project follow steps below

_* Copy project to your local machine, Copy .env.example file to your local .env file

* Configure local domain and set as root public folder of project

*_ Create new database with name 'weather-api-laravel' or another (if name is diferent please update 'DB_DATABASE' property in .env file)

* Run  from project root
```bash
  php artisan migrate
```

* Configure cronjob in your local environment with period (* * * * *) for command, or run manually from project root
```bash
  php artisan dispatch:weather-jobs
```

* Configure supervisor in your local machine for command, or run manually from project root
```bash
   php artisan queue:listen --queue=WeatherInfoUpdate
```

## API Reference

#### Create city

```http
  POST /api/create-city
```

| Parameter  | Type     | Description                |
| :--------  | :------- | :------------------------- |
| `name`     | `string` | **Required**. City name    |
| `latitude` | `float`  | **Required**. Latitude     | 
| `longitude`| `float`  | **Required**. Longitude    | 

#### Get weather information

```http
  GET /api/weather-info
```

| Parameter | Type     | Description                                     |
| :-------- | :------- | :---------------------------------------------- |
| `cityName`| `string` | **Optional**. City name to filter weahter info  |



