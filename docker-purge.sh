#!/bin/sh

# Stop all containers and remove all networks, containers, images, volumes

sudo docker stop $(sudo docker ps -aq)
sudo docker rm $(sudo docker ps -aq)
sudo docker rmi $(sudo docker images -aq)
sudo docker volume prune
sudo docker system prune
