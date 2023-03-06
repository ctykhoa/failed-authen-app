#composer install \
#composer run post-root-package-install \
#php artisan key:generate --ansi


// Db connection
DB_CONNECTION=mysql \
DB_HOST=db \
DB_PORT=3309 \
DB_DATABASE=testing_app \
DB_USERNAME=web_admin \
DB_PASSWORD=mauFJcuf5dhRMQrjj

#php artisan migrate
