FROM nginx:1.10

MAINTAINER "saifoelloh@gmail.com"

ADD ./vhost.conf /etc/nginx/conf.d/default.conf
