# Clone of codelytv pro platform applying Domain-Driven Design, Hexagonal Architecture and CQRS in a Monorepository

### Command for start mooc backend application server
```
php -S 127.0.0.1:8030 apps/mooc/backend/public/index.php

                            OR

symfony serve --dir=apps/mooc/backend/public --port=8030 --force-php-discovery
```

### Command for run mooc backend application acceptance tests
```
./vendor/bin/behat -p mooc_backend
```
