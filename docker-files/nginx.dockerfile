FROM nginx:stable-alpine

COPY docker-files/nginx/ssl-certs/server.crt /etc/ssl/certs/
COPY docker-files/nginx/ssl-certs/server.key /etc/ssl/private/

COPY docker-files/nginx/default.conf /etc/nginx/conf.d/default.conf