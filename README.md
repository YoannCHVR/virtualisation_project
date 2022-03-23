# virtualisation_project

## Project description

This project aims to deploy a full docker environment with front and back-end with a database. 

As website user, you are able to : add, edit and remove any user from the list.

You are able to launch all the environment if you done all prerequisites and access the interface on : http://localhost:8080/. You can also find this project in production on Google Cloud on this link.

## Prerequisites to run the project

### Install Docker Desktop for Windows 10

You can find the Docker Desktop at this [link](https://docs.docker.com/desktop/windows/install/)

### Install Git for Windows 10

You can find the Git Software just right [here](https://git-scm.com/downloads)

### Install NodeJS for Windows 10

You can find the Node installer at this [link](https://nodejs.org/en/download)

### Rename .env.example file to .env and complete it

At the root project "./virtualisation_project/", rename the .env.example to .env file to be able to use it in the project.

After this, you have to complete the file with your own database information :

```
DB_ROOT_PASSWORD=root_pwd_example
DB_HOST=host_example
DB_NAME=name_example
DB_USERNAME=username_example
DB_PASSWORD=pwd_example
```

## How to run project as user

When you have done every prerequisites, please run the following command to clone the project on your desktop with git :

```
git clone https://github.com/YoannCHVR/virtualisation_project.git
```

Please, run the following command to install the project :

```
npm install
```

After this, you have to deploy the project. For this step, you have different ways to done it :

### Windows 10

On the project folder, double-click on the shell script "deploy.sh". This script is used to setup docker containers and put data on the MySQL database.

### Linux

After open a terminal, go to the project folder to execute the "deploy.sh" script with the following command :

```
./deploy.sh
```

## Access to the interface, database and API

You can access to the front-end application with this link :

> http://localhost:8080/

![Application main page](https://github.com/YoannCHVR/virtualisation_project/blob/master/src/assets/background1.JPG?raw=true)

You can access to the phpmyadmin page with this link :

> http://localhost:8081/

![Phpmyadmin main page](https://github.com/YoannCHVR/virtualisation_project/blob/master/src/assets/background2.JPG?raw=true)

<em>To login phpmyadmin system, you have to use the IDs that you previously define in the .env file.</em>

You can access to the API with this link :

> http://localhost:8082/

![API get all users](https://github.com/YoannCHVR/virtualisation_project/blob/master/src/assets/background3.JPG?raw=true)
