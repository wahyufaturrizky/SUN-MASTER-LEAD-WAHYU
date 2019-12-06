#!/bin/bash

cd .. && cd laradock && docker-compose up -d caddy php-fpm redis workspace && docker-compose exec --user="laradock" workspace bash -c  'cd /var/www/sun-master-leads/; exec "${SHELL:-sh}"'
