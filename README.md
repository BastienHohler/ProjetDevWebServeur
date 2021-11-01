# Projet Web Serveur - Geoffrey Porayko, Bastien Hohler

Pour lancer l’application, geoffrey a eu des soucis pour installer docker donc on a développé l’application avec XAMPP. Il faudra donc lancer un serveur php dans le dossier '/public' et lancer un serveur phpmyadmin et mysql dans la racine de l’app. On vous fournit avec le projet un fichier sql pour vous permettre de faire des tests avec la commande mysql -u root -p ProjetWebServeur < PATH/commands.sql

Ce fichier créé les tables (comme le ferait doctrine en utilisant les entités du projet avec la commande 'vendor/bin/doctrine orm:schema-tool:update --dump-sql'), puis il créé quelques utilisateurs afin de pouvoir utiliser les fonctionnalités de l'application (ces utilisateurs ont tous comme mot de passe '123').


Travail réalisé :
Connecter l’orm avec la base de données, intégrer l’orm dans slim.
Geoffrey :  schéma entité association, création des entités, création des fonctionnalités de la page index, création des fonctionnalités de la page friend et création des fonctionnalités de la page signUp.

Bastien : création des fonctionnalités de la page signIn, création des fonctionnalités de la page messagerie, création des fonctionnalités de la page groupe
