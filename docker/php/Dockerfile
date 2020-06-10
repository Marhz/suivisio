FROM ubuntu:latest
MAINTAINER Dan Pupius <dan@pupi.us>

ARG USER_ID=user
ARG USER_NAME=1000

ENV USER_ID=$USER_ID
ENV USER_NAME=$USER_NAME

RUN useradd -m -u ${USER_ID} -s /bin/bash ${USER_NAME}

# Install apache, PHP, and supplimentary programs. openssh-server, curl, and lynx-cur are for debugging the container.
RUN apt-get update \
    &&  apt-get install -y software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get -y install apache2 php5.6 php5.6-mysql libapache2-mod-php5.6 php5.6-mbstring php5.6-xml php5.6-gd php5.6-zip unzip php5.6-redis curl lynx ffmpeg npm gulp

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable apache mods.
RUN a2enmod php5.6
RUN a2enmod rewrite

# Update the PHP.ini file, enable <? ?> tags and quieten logging.
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/5.6/apache2/php.ini
RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/5.6/apache2/php.ini
RUN echo "display_errors = On" >> /etc/php/5.6/apache2/php.ini
RUN echo "upload_max_filesize = 200M" >> /etc/php/5.6/apache2/php.ini
RUN echo "post_max_size = 200M" >> /etc/php/5.6/apache2/php.ini
RUN echo "memory_limit = 500M" >> /etc/php/5.6/apache2/php.ini
RUN echo "max_execution_time = 600" >> /etc/php/5.6/apache2/php.ini

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

EXPOSE 80

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN chown -R ${USER_NAME}:www-data /var/www/html

WORKDIR /var/www/html

CMD /usr/sbin/apache2ctl -D FOREGROUND
