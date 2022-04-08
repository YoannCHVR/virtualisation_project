# Rapport - Projet Virtualisation

### Fait par : Yoann CHEVESSIER - Pierre-Yves OUPINDRIN

-----

**Table of Contents**

1. [Introduction](#introduction)
2. [Architecture de l'application](#architecture)
3. [Description du fonctionnement](#desc)
    1. [Docker Files](#docker)
    2. [Front-End (VueJS) Files](#front-end)
    3. [Back-End (PHP) Files](#back-end)
    4. [API Files](#api)
    5. [Node Files](#node)
    6. [Other Files](#other)

-----

## Introduction <a name="introduction"></a>

Ce projet vise à déployer un environnement docker complet avec front et back-end ainsi qu'une base de données.

En tant qu'utilisateur du site web, vous pouvez : ajouter, modifier et supprimer n'importe lequel des utilisateurs de la liste.

Lorsque que vous avez fait les pré-requis expliqués dans le fichier README, vous pouvez lancer tout l'environnement et accéder à l'interface sur : http://localhost:8080/.

## Architecture de l'application <a name="architecture"></a>

```
├───mysql
├───node_module
├───php
├───public
│   ├───action
│   └───api
└───src
    ├───assets
    └───components
```

## Description du fonctionnement <a name="desc"></a>

### Docker Files <a name="docker"></a>

#### ./docker-compose.yml

Fichier essentiel à la mise en place de l'application, il est utilisé pour définir et exécuter plusieurs conteneurs en simultanés. Il permet de configurer les services de l'application et de les créer.

| Service name  | Description                    |
| ------------- | ------------------------------ |
| `web`         | Contains the Node Image and the project folder. It define access app on **8080** port |
| `back`        | Contains the PHP Image (based on Apache Image). Access on the **8082** port for API with JSON data |
| `mysql`       | Contains the MySQL Image and setup the environment with database name, root and user password. It also initialize the database content by using the schema.sql |
| `phpmyadmin`  | Contains the Phpmyadmin Image to manage easily the data from MySQL. It is accessible on the **8081** port |

> Chaque service utilise comme base un "build", qui est défini par le contenu du Dockerfile vers lequel son chemin pointe

Liste des commandes à connaître pour utiliser le fichier :
- `docker-compose up` : Lance la configuration et la création des containers précédemment définis
- `docker-compose stop` : Met à l'arrêt les containers qui ont été exécutés
- `docker-compose down` : Met à l'arrêt et supprime les containers qui ont été exécutés
- `docker volume rm $(docker volume ls -qf dangling=true)` : Supprime les volumes créés lors de la création d'un container (cela peut vite prendre de la place)

#### ./Dockerfile

Le Dockerfile qui se trouve à la racine de l'application est utilisé pour configurer le service "web". Il utilise une image Node et va copier l'intégralité des fichiers du projet vers la racine du dossier de la machine virtuel créée avec l'image. Il va ensuite initialiser l'environnement Node avec la commande 'npm install' et définir l'utilisation de l'application sur le port 8080.

#### ./php/Dockerfile

Le Dockerfile qui se trouve dans le dossier PHP est utilisé pour configurer le service "back". Il utilise une image PHP, qui est elle même basée sur une image Apache. Il va mettre à jour la machine virtuel et activer les extensions PHP ainsi que la fonction PDO pour accéder à la base de données via PHP.

#### ./mysql/Dockerfile

Le Dockerfile qui se trouve dans le dossier MySQL est utilisé pour configurer le service "mysql". Il utilise une image MySQL standard.

### Front-End (VueJS) Files <a name="front-end"></a>

#### ./src/App.vue

Fichier permettant la configuration de l'application. Il permet de gérer l'affichage, les ressources à travers les pages, la configuration ou non d'un serveur en JavaScript, et bien d'autres.

#### ./src/main.js

Fichier de création de l'application.

#### ./src/components/HelloWorld.vue

Fichier appelé "composant". Il est intégré à la base contenu défini dans App.vue entre les balises `<templates>`, cette partie contient le tableau des utilisateurs ainsi que les inputs qu'il contient pour ajouter, modifier ou en supprimer un.

#### ./src/assets/

Dossier contenant les images affichées sur les templates de l'application (+ les images utilisées sur GitHub).

#### ./public/index.html

Fichier accessible par l'utilisateur lors de l'accès à l'application. Il contient le rendu graphique de celle-ci.

### Back-End (PHP) Files <a name="back-end"></a>

#### ./public/action/

Dossier contenant les fichiers PHP utilisés pour faire les requêtes vers la base de données. (doit être déplacé pour éviter tout accès par les utilisateurs)

### API Files <a name="api"></a>

#### ./public/api/

Dossier contenant le(s) fichier(s) permettant d'accéder aux données de la base de données. La seule page utilisé ici est celle permettant d'obtenir l'intégralité des utilisateurs de l'application.

#### ./mysql/schema.sql

Script SQL contenant la procédure de création des tables définies dans la base de données, ainsi que les données qui y sont créées par défaut.

### Node Files <a name="node"></a>

#### ./package.json

Fichier ressemblant à une sorte de manifeste. Il peut faire beaucoup de choses, notamment centraliser la configuration pour les outils mais aussi y stocker les noms et les versions de tous les paquets à installer.

### Other Files <a name="other"></a>

#### ./.env.example

Le fichier .env permet de personnaliser les variables de votre environnement de travail individuel. Ce fichier a pour but d'être ré-utilisé pour créer son propre .env avec les variables prédéfinies.

#### ./public/.htaccess

C'est un fichier basique pour contrôler la configuration de haut niveau de l'application. Sur les serveurs qui utilisent Apache, le fichier permet d'apporter des modifications à sa configuration sans avoir à modifier ceux du serveur.

#### ./deploy.sh

Fichier permettant de plus facilement déployer l'application sur un environnement sans avoir à connaître la technicité de sa mise en place, ou les commandes qu'il nécessite.
