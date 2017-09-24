FROM phpdockerio/php71-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y install vim \
    && apt-get -y --no-install-recommends install  php7.1-mysql php7.1-mbstring php-xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && usermod -u 1000 www-data

EXPOSE 9000
WORKDIR "/application"
RUN mkdir -p var/cache var/logs var/sessions \
	&& chown -R www-data var