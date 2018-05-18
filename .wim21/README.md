# Travaux pratiques de programmation WEB coté serveur
Ce dépôt contient des ressources utilisées
dans les tps du module *WIM2.1*.

#### TP1 : Bases du langage PHP
Le [tp1](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp1) 
permet de se familiariser avec le langage PHP. 
À chaque exercice correspond  un  sous répertoire avec
des fichiers à compléter.

#### TP2 : Intéractions avec le client, formulaires et PHP
Le [tp2](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp2)
aborde la récupération des données de formulaires avec PHP.
À chaque exercice correspond  un  sous répertoire avec
des fichiers à compléter.

#### TP2bis : Passage de paramètres à un script
Le [tp2bis](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp2b)
aborde la transmission de paramètres à un script, sans 
passer par un formulaire, mais en utlisant directement l'url.
À chaque exercice correspond  un  sous répertoire avec
des fichiers à compléter.

#### TP3 : PHP/Mysql
Le [tp3](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp4)
aborde l'interfaçage de php avec mysql, au moyen de l'extention 
[mysqli](http://php.net/manual/fr/book.mysqli.php) de php.
À chaque exercice correspond  un  sous répertoire avec
des fichiers à compléter.

#### TP4 : Cookies et sessions 
Le [tp4](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp7)
aborde la notion de cookies et de sessions,et 
les fonctions php dédiées.
À chaque exercice correspond  un  sous répertoire avec
des fichiers à compléter.

#### TP5 : PHP objet
Le [tp5](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp9)
aborde la couche objet de php.
À chaque exercice correspond  un  sous répertoire avec
des fichiers à compléter.

#### TP6 : MVC avec CodeIgniter
Le [tp6](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp10)
est une introduction au modèle MVC avec le framework 
[CodeIgniter](https://www.codeigniter.com)
L'application permet de gérer des contacs emails.

![gestion de contacts](http://www.iut-fbleau.fr/sitebp/web/wim21/mvc/ci314.png)

Pour qu'elle soit fonctionnelle, 
Vous devez d'abord réglé les paramètres de configuration dans le répertoire application/config.

* config.php : donnez l'adresse de base de votre site (base_url). (Vous pouvez également enlever index.php de vos urls (index_page), mais il faudra rajouter un fichier .htaccess pour la réécriture de vos urls)
* database.php : donnez les paramètres nécessaires à l'accès à la base de données.
* routes.php : vous pouvez modifiez le contrôleur par défaut (pour l'instant, contacts, c'est à dire que l'url de base de votre site conduit à la méthode index de contact).


#### TP7 : Sensibilisation à la sécurité d'un site WEB en PHP
Le [tp7](http://www.iut-fbleau.fr/sitebp/web/wim21/?p=tp12)
est constitué par une petite application (micro-blog) qui 
permet d'illustrer les attaques classiques vues en cours, et 
de les corriger.

Pour qu'elle soit fonctionnelle, modidifez les paramètres de 
connexion (PDO) au sgbd.

