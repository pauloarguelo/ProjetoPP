FROM php:8.1

RUN echo "UTC" > /etc/timezone

WORKDIR /app

RUN apt-get update && apt-get install -y git
RUN useradd -s /bin/bash dev
RUN apt-get install -y \
        libzip-dev \
        libpq-dev \
        zip \
  && docker-php-ext-install zip \
  && docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --ignore-platform-reqs
RUN composer dump-autoload

RUN chmod a=rwx -R ./storage/logs/

EXPOSE 8000

USER dev

#CMD php -S 0.0.0.0:80 -t public