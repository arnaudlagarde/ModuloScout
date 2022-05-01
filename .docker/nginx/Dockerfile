FROM nginx:stable

# Log folder (shared)
RUN mkdir -p /logs

# CONF
COPY .docker/nginx/conf/nginx.conf /etc/nginx/nginx.conf
COPY .docker/nginx/conf/parameters.conf /etc/nginx/parameters.conf

# SSL CERTIFICATES
COPY certs/modulo.local.crt /etc/nginx/ssl/modulo.local.crt
COPY certs/modulo.local.key /etc/nginx/ssl/modulo.local.key