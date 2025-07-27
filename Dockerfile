FROM php:8.1-cli
WORKDIR /app
COPY . .
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-install gd
EXPOSE 10000
CMD ["php", "-S", "0.0.0.0:10000"]
