FROM php:8.1-apache-bullseye@sha256:d610429d9db918ac2587945f1f5f7e4402adb245e3cf9e70e128ede072bdd9e0

RUN apt-get update -y \
    && apt-get install git -y \
    && apt-get install curl unzip -y \
    && curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && HASH=`curl -sS https://composer.github.io/installer.sig` \
    && php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo pdo_mysql \
#    && docker-php-ext-enable mysqli \
#    && docker-php-ext-install pdo \
#    && docker-php-ext-enable pdo \
#    && docker-php-ext-enable sodium \
    && a2enmod rewrite

# extension gd
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/  \
    && docker-php-ext-install gd

COPY web.conf /etc/apache2/sites-available/
RUN rm -rf /etc/apache2/sites-enabled/000-default.conf \
    && cp /etc/apache2/sites-available/web.conf /etc/apache2/sites-enabled/web.conf