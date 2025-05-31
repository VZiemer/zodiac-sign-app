FROM php:8.2-apache

# Ativa o mod_rewrite (caso queira usar futuramente)
RUN a2enmod rewrite

# Copia os arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Dá permissão
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80 do container (vai ser mapeada pra 8080)
EXPOSE 80
