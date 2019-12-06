#!/bin/bash

# cd laradock && docker-compose up -d nginx mariadb redis workspace && docker-compose exec --user=laradock workspace bash
cd laradock && docker-compose up -d nginx mariadb phpmyadmin workspace && docker-compose exec --user=laradock workspace bash