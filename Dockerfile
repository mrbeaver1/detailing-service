## Сборка php-fpm контейнера
FROM php:8.4-fpm-alpine AS php-fpm-front

ARG USER='www-data'
ARG GROUP='www-data'

ENV COMPOSER_MEMORY_LIMIT=-1

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN pear update-channels \
    && pecl update-channels \
    && install-php-extensions \
        gd \
        opcache \
        pdo_mysql  \
        intl \
        iconv \
        mysqli \
        xml \
        zip \
        bcmath \
        @composer-2 \
    && apk --no-cache add bash git openssl

WORKDIR /var/www/html

COPY --chown=${USER}:${GROUP} ./ ./

USER ${USER}

#RUN mkdir -p web/assets \
#    && composer install --no-interaction --no-scripts \
#    && php yii staticAssets/asset/publish web/assets

CMD ["php-fpm"]
EXPOSE 9000

FROM php:8.4-fpm-alpine AS php-fpm-lk

ARG USER='www-data'
ARG GROUP='www-data'

ENV COMPOSER_MEMORY_LIMIT=-1

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN pear update-channels \
    && pecl update-channels \
    && install-php-extensions \
        gd \
        opcache \
        pdo_mysql  \
        intl \
        iconv \
        mysqli \
        xml \
        zip \
        bcmath \
        @composer-2 \
    && apk --no-cache add bash git openssl

WORKDIR /var/www/html

COPY --chown=${USER}:${GROUP} ./ ./

USER ${USER}

#RUN mkdir -p web/assets \
#    && composer install --no-interaction --no-scripts \
#    && php yii staticAssets/asset/publish web/assets

CMD ["php-fpm"]
EXPOSE 9000


FROM php:8.4-fpm-alpine AS  php-fpm-admin

ARG USER='www-data'
ARG GROUP='www-data'

ENV COMPOSER_MEMORY_LIMIT=-1

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN pear update-channels \
    && pecl update-channels \
    && install-php-extensions \
        gd \
        opcache \
        pdo_mysql  \
        intl \
        iconv \
        mysqli \
        xml \
        zip \
        bcmath \
        @composer-2 \
    && apk --no-cache add bash git openssl

WORKDIR /var/www/html

COPY --chown=${USER}:${GROUP} ./ ./

USER ${USER}

#RUN mkdir -p web/assets \
#    && composer install --no-interaction --no-scripts \
#    && php yii staticAssets/asset/publish web/assets

CMD ["php-fpm"]
EXPOSE 9000

FROM nginx:1.25-alpine AS nginx

COPY ./.docker/nginx/templates/* /etc/nginx/templates/
COPY --from=php-fpm-front /var/www/html/frontend/web /var/www/html/frontend/web
COPY --from=php-fpm-lk /var/www/html/account/web /var/www/html/account/web
COPY --from=php-fpm-admin /var/www/html/backend/web /var/www/html/backend/web

CMD ["nginx", "-g", "daemon off;"]
EXPOSE 80
