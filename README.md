<p align="center">
  <a href="http://codely.tv">
    <img src="http://codely.tv/wp-content/uploads/2016/05/cropped-logo-codelyTV.png" width="192px" height="192px"/>
  </a>
</p>

<h1 align="center">
  🐘🎯 Clone of codelytv pro platform applying Domain-Driven Design, Hexagonal Architecture and CQRS in a Monorepository
</h1>

## 🚀 Environment Setup

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/jorgechavezrnd/codelytv-clone.git`
3. Move to the project folder: `cd codelytv-clone`

### 🛠️ Environment configuration

1. Create a local environment file (`cp .env .env.local`) if you want to modify any parameter

### 🔥 Application execution

1. Install all the dependencies and bring up the project with Docker executing: `make build`
2. Then you'll have 3 apps available (2 APIs and 1 Frontend):
   1. [Mooc Backend](apps/mooc/backend): http://localhost:8030/health-check
   2. [Backoffice Backend](apps/backoffice/backend): http://localhost:8040/health-check
   3. [Backoffice Frontend](apps/backoffice/frontend): http://localhost:8041/health-check

### ✅ Tests execution

1. Install the dependencies if you haven't done it previously: `make deps`
2. Execute PHPUnit and Behat tests: `make test`


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
