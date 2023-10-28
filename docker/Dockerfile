FROM debian:bullseye
# granddaddy of linux systems old and stable
WORKDIR /var/www/html

#base
RUN apt-get update
RUN apt-get install -y htop curl supervisor apt-utils nano
#end base

#nodejs
RUN curl -sL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh && chmod +x nodesource_setup.sh && ./nodesource_setup.sh
RUN apt install -y nodejs
#end nodejs


# apache2
RUN apt-get install -y apache2 systemctl
RUN a2enmod rewrite
RUN update-rc.d apache2 defaults
RUN /etc/init.d/apache2 start
RUN systemctl enable apache2
RUN systemctl start apache2
COPY 000-default.conf /etc/apache2/sites-available/
# end apache2

#php
RUN apt-get install -y apt-transport-https lsb-release ca-certificates wget
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN apt-get update
RUN apt-get -y install php8.2 php-cli php-fpm php-json php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath libapache2-mod-php
COPY php.ini /etc/php/8.2/cli/conf.d/99-sail.ini
#end php


# configuration files
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY entrypoint /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#end configuration files

ENTRYPOINT [ "entrypoint" ]



