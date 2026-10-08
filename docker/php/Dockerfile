FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN apt-get update && apt-get install -y curl unzip \
    && curl -fsSL https://github.com/sass/dart-sass/releases/download/1.77.8/dart-sass-1.77.8-linux-x64.tar.gz \
       -o /tmp/sass.tar.gz \
    && tar -xzf /tmp/sass.tar.gz -C /opt \
    && ln -s /opt/dart-sass/sass /usr/local/bin/sass \
    && rm /tmp/sass.tar.gz \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]