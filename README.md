
## About Prex Backend Test
This project was create with Laravel Framework v10 and it only for interview proposal.

## User Case

*See Challenger PDF on root folder*

## Project setup

### First time setup
Install dependencies with:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

After you are in sync with `origin/main` Then you can run
```shell
vendor/bin/sail up -d
vendor/bin/sail shell
php artisan migrate --seed
php artisan db:seed UserSeeder
```
Open your `.env` file and set your `GIPHY` token
```shell
    GIPHY_API_TOKEN = "APITOKEN"
```

### Daily usage
After you are in sync with `origin/master` Then you can run
Inside the shell you can run typical artisan commands like:
```sh
php artisan migrate --seed
```

### First time set up
### Run test suite
And then
```shell
vendor/bin/sail shell
php artisan test
```

if you want to see a coverage report, run:
```shell
vendor/bin/sail shell

export XDEBUG_MODE=coverage
php artisan test --coverage
```

## Postman Collection
You can find a Postman collection called `Prex_Backend.postman_collection` to import in your Postman Workspace on root directory.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
