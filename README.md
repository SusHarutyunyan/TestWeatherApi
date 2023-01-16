
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

* Command is scheduled to run hourly, but you can run it manually from project root
```bash
   php artisan update:weather-info
```

#### Get weather information

```http
  GET /api/history/{day}
```

| Parameter | Type     | Description  |
|:----------| :------- |:-------------|
| `day`     | `string` | Format Y-m-d |



