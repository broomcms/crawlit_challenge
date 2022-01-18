FROM phpdockerio/php80-fpm:latest
WORKDIR "/application"

# System update
RUN apt-get update
# Docker & git install
RUN apt-get -y --no-install-recommends install docker
RUN apt-get -y --no-install-recommends install git 
# PHP Setup
RUN apt-get -y --no-install-recommends install php8.0-bcmath 
RUN apt-get -y --no-install-recommends install php8.0-bz2 
RUN apt-get -y --no-install-recommends install php8.0-gd 
RUN apt-get -y --no-install-recommends install php8.0-gmagick 
RUN apt-get -y --no-install-recommends install php8.0-http 
RUN apt-get -y --no-install-recommends install php8.0-imagick 
RUN apt-get -y --no-install-recommends install php8.0-intl 
RUN apt-get -y --no-install-recommends install php8.0-lz4 
RUN apt-get -y --no-install-recommends install php8.0-mcrypt 
RUN apt-get -y --no-install-recommends install php8.0-memcache 
RUN apt-get -y --no-install-recommends install php8.0-memcached 
RUN apt-get -y --no-install-recommends install php8.0-mysql 
RUN apt-get -y --no-install-recommends install php8.0-odbc 
RUN apt-get -y --no-install-recommends install php8.0-psr 
RUN apt-get -y --no-install-recommends install php8.0-xdebug 
RUN apt-get -y --no-install-recommends install php8.0-yaml
RUN apt-get -y --no-install-recommends install php-raphf
# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
# Install deployer
RUN apt-get -y --no-install-recommends install ssh-client
RUN curl -LO https://deployer.org/deployer.phar
RUN mv deployer.phar /usr/local/bin/dep
RUN chmod +x /usr/local/bin/dep
# Finish setup
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
RUN sh -c "echo 'precedence ::ffff:0:0/96 100' >> /etc/gai.conf"