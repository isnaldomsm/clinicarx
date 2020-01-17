# PHPUnit Docker Container.
FROM alpine:3.8
LABEL mantainer="Nicolas Frey <nicolas@nfrey.com>"

ENV PEAR_PACKAGES foo

WORKDIR /tmp

RUN apk --no-cache add \
        bash \
        ca-certificates \
        curl \
        git \
        php7 \
        php7-bcmath \
        php7-cli \
        php7-ctype \
        php7-curl \
        php7-dom \
        php7-exif \
        php7-fileinfo \
        php7-intl \
        php7-json \
        php7-mbstring \
        php7-mcrypt \
        php7-mysqli \
        php7-opcache \
        php7-openssl \
        php7-pcntl \
        php7-pdo \
        php7-pdo_mysql \
        php7-pdo_pgsql \
        php7-pdo_sqlite \
        php7-phar \
        php7-session \
        php7-simplexml \
        php7-soap \
        php7-sqlite3 \
        php7-tokenizer \
        php7-xdebug \
        php7-xml \
        php7-xmlreader \
        php7-xmlwriter \
        php7-zip \
        php7-zlib \
        unzip \
    && php -r "copy('https://pear.php.net/go-pear.phar', 'go-pear.phar');" \
    && php go-pear.phar \
    && php -r "unlink('go-pear.phar');" \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    # Enable X-Debug
    && sed -i 's/\;z/z/g' /etc/php7/conf.d/xdebug.ini \
    && php -m | grep -i xdebug

ONBUILD RUN \
    { \
        [ "${PEAR_PACKAGES}" != "foo" ]; \
    } || exit 0 && pear install ${PEAR_PACKAGES}

VOLUME ["/app"]
WORKDIR /app
COPY ./composer.json ./vendor /app/

RUN composer install --prefer-source --no-interaction

ENTRYPOINT ["/app/vendor/bin/phpunit"]
CMD ["--help"]
