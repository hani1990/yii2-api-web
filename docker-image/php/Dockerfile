FROM php:7.1-fpm

# COPY sources.list /etc/apt/sources.list

ENV TZ Asia/Shanghai

RUN apt-get update && apt-get install -qqy \
        libmcrypt-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        libmemcached-dev \
        libicu-dev
        
RUN docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install intl mysqli pdo_mysql opcache bcmath


#RUN apt-get install -qqy  apt-transport-https

#RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
#RUN curl https://packages.microsoft.com/config/ubuntu/15.10/prod.list > /etc/apt/sources.list.d/mssql-release.list
#RUN apt-get update
#RUN apt-get install  msodbcsql
#RUN apt-get install   mssql-tools
#RUN apt-get install   unixodbc-dev
#RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bash_profile
#RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
#RUN source ~/.bashrc

#RUN pecl install sqlsrv
#RUN pecl install pdo_sqlsrv && echo "extension=pdo_sqlsrv.so" > /usr/local/etc/php/conf.d/pdo_sqlsrv.ini


RUN pecl install redis && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini
RUN pecl -q install memcached && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini

# dev only
RUN pecl install xdebug
COPY config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# php config
COPY config/php.ini /usr/local/etc/php/php.ini
COPY config/php-fpm.conf /usr/local/etc/php-fpm.conf

WORKDIR /opt

VOLUME ["/opt/webroot"]

EXPOSE 9000
