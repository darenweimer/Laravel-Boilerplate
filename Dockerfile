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

    # Install PHP 8.1 and Extensions

    && apt install -y software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt update \
    && apt upgrade -y \

    && apt install -y \
       php8.1 \
       libapache2-mod-php8.1 \
       php8.1-bcmath \
       php8.1-cli \
       php8.1-ctype \
       php8.1-curl \
       php8.1-fileinfo \
       php8.1-gd \
       php8.1-igbinary \
       php8.1-imap \
       php8.1-intl \
       php8.1-ldap \
       php8.1-mbstring \
       php8.1-memcached \
       php8.1-msgpack \
       php8.1-mysql \
       php8.1-pcov \
       php8.1-pdo \
       php8.1-pgsql \
       php8.1-readline \
       php8.1-redis \
       php8.1-soap \
       php8.1-swoole \
       php8.1-tokenizer \
       php8.1-xdebug \
       php8.1-xml \
       php8.1-zip \

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
