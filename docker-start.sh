#!/bin/sh

# build & start containers
sudo docker-compose build
sudo docker network create diarynet --gateway=172.16.0.1 --subnet 172.16.0.1/24
sudo docker-compose up -d
