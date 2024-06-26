# Use the PHP 8.1 with Apache image as the base
FROM node:latest AS node
FROM php:8.2-apache

RUN docker-php-ext-install pdo_mysql

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Install system dependencies and MariaDB
RUN apt-get update && \
    apt-get install -y mariadb-server && \
    apt-get install -y libzip-dev unzip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY composer.* ./
COPY package*.json ./
# Install PHP dependencies
RUN composer install --no-interaction --no-ansi --no-scripts

# Install TypeScript globally
RUN npm install -g typescript
RUN npm install
# Install Composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Update the Apache configuration to point to /var/www/html/www (where your index.php is)
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    ServerName localhost\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

ENV MYSQL_ROOT_PASSWORD='frCcBRw8Ub4eUUu'
ENV MYSQL_PHP_HOST='127.0.0.1'
ENV MYSQL_DATABASE='db'
ENV MYSQL_USER='root'
ENV MYSQL_CHARSET='utf8mb4'
ENV MYSQL_ROOT_HOST=0.0.0.0
ENV OPEN_API_KEY='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'

# Copy the application code to the container
COPY my.cnf /etc/mysql/conf.d/
COPY . .
# Compile TypeScript to JavaScript
RUN if ls *.ts 1> /dev/null 2>&1; then tsc; else echo "No TypeScript files found. Skipping tsc command."; fi

# Expose port 80
EXPOSE 80


# Copy start.sh and make it executable
COPY start.sh /start.sh
RUN chmod +x /start.sh
RUN chmod +x /var/www/html/scripts/doctrine.php
# Start Apache and other services
CMD ["/start.sh"]
