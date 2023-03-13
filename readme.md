## Installation
$ git clone https://github.com/ctykhoa/failed-authen-app.git \
$ cd failed-authen-app \
$ docker-compose up -d
$ docker exec -it web-app-8123 bash \
#composer install \
#composer run post-root-package-install \
#php artisan key:generate --ansi \
#php artisan migrate

--------
Branch `failed-authentication` implemented with CSRF failure and SQL injection in authentication \
Branch `dev` fix them to mitigate attacks

--------
// Db connection
DB_CONNECTION=mysql \
DB_HOST=db \
DB_PORT=3309 \
DB_DATABASE=testing_app \
DB_USERNAME=web_admin \
DB_PASSWORD=mauFJcuf5dhRMQrjj

