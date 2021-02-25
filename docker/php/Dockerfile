FROM php:7.4-fpm

RUN apt-get -y update && \
    apt-get -y upgrade && \
    apt-get -y install libzip-dev zip

# Add required php extensions
RUN docker-php-ext-install zip pdo pdo_mysql

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer --version 2.0.11 && \
    php -r "unlink('composer-setup.php');"

# Install PHP CS Fixer
RUN curl -L "https://cs.symfony.com/download/php-cs-fixer-v2.phar" -o php-cs-fixer && \
    chmod a+x php-cs-fixer && \
    mv php-cs-fixer /usr/local/bin/php-cs-fixer
