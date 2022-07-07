FROM ghcr.io/blumilksoftware/php:8.1

ARG XDEBUG_VERSION=3.1.5
ARG INSTALL_XDEBUG

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    apk --no-cache add $PHPIZE_DEPS \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
;fi
