# see https://github.com/cmaessen/docker-php-sendmail for more information

FROM php:5-fpm

#RUN apt-get update && apt-get install -q -y ssmtp mailutils && rm -rf /var/lib/apt/lists/*
#RUN apt-get update && apt-get install -q -y mailutils && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysql mysqli sysvsem pdo pdo_mysql

#RUN pecl install xdebug-2.5.5 \
#    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "[XDebug]" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini


RUN echo "localhost localhost.localdomain" >> /etc/hosts
