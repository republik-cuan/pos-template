FROM nginx:1.10-alpine

MAINTAINER "saifoelloh@gmail.com"

ADD vhost.conf /etc/nginx/conf.d/default.conf
