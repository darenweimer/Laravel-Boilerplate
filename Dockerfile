FROM ubuntu:20.04

EXPOSE 80/tcp

SHELL ["/bin/bash", "--login", "-i", "-c"]

RUN apt update
RUN apt upgrade -y

RUN apt install -y systemd
RUN apt install -y net-tools
RUN apt install -y curl
RUN apt install -y unzip
RUN apt install -y nano

RUN apt install -y apache2 apache2-utils
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/public/' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

RUN apt install -y php libapache2-mod-php
RUN apt install -y php-bcmath
RUN apt install -y php-cli
RUN apt install -y php-ctype
RUN apt install -y php-curl
RUN apt install -y php-fileinfo
RUN apt install -y php-json
RUN apt install -y php-mbstring
RUN apt install -y php-mysql
RUN apt install -y php-pdo
RUN apt install -y php-pgsql
RUN apt install -y php-tokenizer
RUN apt install -y php-xml
RUN apt install -y php-zip

RUN apt install -y cron
RUN apt install -y supervisor

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

ENV NVM_DIR /root/.nvm
ENV NODE_VERSION 16.13.1
RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
RUN . $NVM_DIR/nvm.sh
RUN nvm install $NODE_VERSION
ENV NODE_PATH $NVM_DIR/versions/node/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

ADD docker-startup.sh /docker-startup.sh
RUN chmod +x /docker-startup.sh

CMD ["/docker-startup.sh"]
