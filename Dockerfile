FROM ubuntu:20.04

EXPOSE 80/tcp

RUN apt update \
    && apt upgrade -y \

    # Install System Commands

    && apt install -y \
       systemd \
       htop \
       net-tools \
       curl \
       unzip \
       nano \

    # Install and Configure Apache2

    && apt install -y \
       apache2 \
       apache2-utils \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
    && sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/public/' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite \

    # Install PHP 7.4 and Extensions

    && apt install -y \
       php7.4 \
       libapache2-mod-php7.4 \
       php7.4-bcmath \
       php7.4-cli \
       php7.4-ctype \
       php7.4-curl \
       php7.4-fileinfo \
       php7.4-gd \
       php7.4-igbinary \
       php7.4-imap \
       php7.4-intl \
       php7.4-json \
       php7.4-ldap \
       php7.4-mbstring \
       php7.4-memcached \
       php7.4-msgpack \
       php7.4-mysql \
       php7.4-pcov \
       php7.4-pdo \
       php7.4-pgsql \
       php7.4-readline \
       php7.4-redis \
       php7.4-soap \
       php7.4-tokenizer \
       php7.4-xdebug \
       php7.4-xml \
       php7.4-zip \

    # Install Application Schedulers

    && apt install -y \
       cron \
       supervisor \

    # Install Composer 2.x

    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \

    # Install Node 16.x

    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt install -y nodejs \
    && npm install -g npm \

    # Cleanup

    && apt autoremove -y \
    && apt clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD Dockerfile-startup.sh /Dockerfile-startup.sh
RUN chmod +x /Dockerfile-startup.sh

CMD ["/Dockerfile-startup.sh"]
