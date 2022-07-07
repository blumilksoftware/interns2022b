## interns2022b [name TBD]

Application of and for interns at **[@blumilksoftware](https://github.com/blumilksoftware)**.

### Running the application

In cloned or forked repository, run:

```shell
cp .env.example .env
composer install
```

Then run the application:

```shell
php cmd/run.php
# or composer go
```

### Contributors


- [@Aleksandra](https://github.com/AleksandraKozubal)
- [@Dagmara](https://github.com/dagmaraskulimowska)
- [@Oskar](https://github.com/Oskar-Dabrowski)


### Contributing

There are scripts available for package codestyle checking and testing:

| Command         | Description                                                  |
| --------------- | ------------------------------------------------------------ |
| `composer cs`   | Runs codestyle against the package itself                    |
| `composer csf`  | Runs codestyle with fixer enabled against the package itself |
| `composer test` | Runs all test cases                                          |

#### Running with Docker

There is the Docker Compose configuration available:

```shell
docker-compose up -d
docker-compose exec php php -v
docker-compose exec php composer -V
```

We encourage you to register an alias in your `~./bash_aliases`:

```
alias dcr='docker-compose run --rm -u "$(id -u):$(id -g)"'
```

Then following command could be handy:

```shell
dcr php php -v
dcr php php cmd/run.php
dcr php composer -V
dcr php composer test
```
---
## Debugging

Debugging php scripts from PHPStorm is not working due to some bug during input for radio menu.

```shell
docker-compose exec php ash -c "PHP_IDE_CONFIG="serverName=SomeName" php cmd/run.php"
```

Enter into the container
```
docker-comppose exec php ash
```

Write into terminal:
```shell
PHP_IDE_CONFIG="serverName=SomeName" php cmd/run.php
```

**SomeName** is the name of the server in PHPStorm (Settings->PHP->Servers), can be whatever you want, hostname may be localhost.\
Add paths mappings (point whole project folder to `/application` (absolute path on server).\
Enable listening for xdebug connections