FROM php:8.3.12-fpm

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем composer.lock и composer.json
#COPY composer.json composer.lock /var/www/


# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    libxml2-dev

# Очищаем кэш
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Загружаем актуальную версию Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd soap

# Создаём пользователя и группу www для приложения Laravel
RUN groupadd --force -g 1000 www-data


# Копируем содержимое текущего каталога в рабочую директорию
COPY . /var/www
COPY --chown=www:www . /var/www

# Меняем пользователя на www


# В контейнере открываем 8000 порт и запускаем сервер php-fpm
EXPOSE 9000
CMD ["php-fpm"]
