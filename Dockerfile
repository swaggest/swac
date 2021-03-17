FROM php:cli-alpine

COPY ./swac /bin/swac

WORKDIR /code