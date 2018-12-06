FROM composer:1.7 as vendor

COPY database/ database/

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php:7.2-cli

COPY . /usr/src/app
COPY --from=vendor /app/vendor/ /usr/src/app/vendor
WORKDIR /usr/src/app
RUN touch database/database.sqlite
RUN php artisan migrate:fresh --seed

CMD php ./artisan serve --port=8000 --host=0.0.0.0
EXPOSE 8000