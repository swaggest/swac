FROM php:cli

COPY ./swac /bin/swac

WORKDIR /code