# DOCKER
# Shutdown and remove running container(s)
docker-compose down;
# Remove all volume which take a lot of space
docker volume rm $(docker volume ls -qf dangling=true);
# Start the docker server
docker-compose up -d;

# CREATE DATABASE
cat db.sql | docker exec -i mysql /usr/bin/mysql -u root --password=root db;
