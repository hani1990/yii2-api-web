FROM nginx:1.11

ENV TZ Asia/Shanghai

COPY config/nginx.conf /etc/nginx/nginx.conf

COPY config/conf.d/* /etc/nginx/conf.d/

COPY config/sites-enabled/* /etc/nginx/sites-enabled/

RUN mkdir -p /opt/webroot/web && mkdir -p /opt/webroot/default

COPY config/index.html /opt/webroot/default

COPY config/index.php /opt/webroot/web

WORKDIR /opt/webroot

VOLUME ["/opt/webroot", "/opt/log", "/opt/log/nginx", "/etc/nginx/conf.d", "/etc/nginx/sites-enabled"]

EXPOSE 80 443

