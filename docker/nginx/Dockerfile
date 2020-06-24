FROM nginx:latest

ENV DEBIAN_FRONTEND="noninteractive" \
    SYMFONY_ALLOW_APPDEV=1 \
    COMPOSER_ALLOW_SUPERUSER=1

#RUN apt-get update && \
#    apt-get install -y openssl && \
#    openssl genrsa -des3 -passout pass:fijwijenfijwnefijwenfiwjenijfnwijenoiuyigb -out server.pass.key 2048 && \
#    openssl rsa -passin pass:fijwijenfijwnefijwenfiwjenijfnwijenoiuyigb -in server.pass.key -out /etc/ssl/server.key && \
#    rm server.pass.key && \
#    openssl req -new -key /etc/ssl/server.key -out /etc/ssl/server.csr \
#        -subj "/C=UK/ST=Warwickshire/L=Leamington/O=OrgName/OU=IT Department/CN=example.com" && \
#    openssl x509 -req -days 365 -in /etc/ssl/server.csr -signkey /etc/ssl/server.key -out /etc/ssl/server.crt

COPY conf/symfony.conf /etc/nginx/conf.d/default.conf
