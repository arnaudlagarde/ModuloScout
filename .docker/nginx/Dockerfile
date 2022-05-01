FROM nginx:stable

# Log folder (shared)
RUN mkdir -p /logs

# CONF
COPY nginx/nginx.conf /etc/nginx/nginx.conf
COPY nginx/symfony.conf /etc/nginx/symfony.conf

# SSL CERTIFICATES
COPY nginx/modulo.local.crt /etc/nginx/ssl/modulo.local.crt
COPY nginx/modulo.local.key /etc/nginx/ssl/modulo.local.key