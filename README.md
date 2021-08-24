<!-- PROJECT LOGO -->
<br />
<p align="center">
    <img src="https://www.promeo-formation.fr/themes/custom/promeo/img/logos/logo_promeo_white.svg" alt="Logo" height="50px"><br>
    <h3 align="center">Projet Symfony - TheBlog </h3>
    
# Installation

### Prérequis

Il faut d'abord installer

```
Xamp ou Laragon ainsi que PHPMyAdmin, Composer et PHP (en version 7.2 minimum).
```

### Mise en place du projet

Cloner le projet sur la machine

```
git clone https://github.com/KadenHD/TheBlog.git
```

Ensuite dans le projet

```
composer install
```

Editer le fichier .env puis

```
php bin/console doctrine:schema:create
```

Puis lancer les fixtures

```
php bin/console doctrine:fixtures:load
```
# Technologies

***Le projet a été créé en utilisant :***

***Les logiciels :***

> Visual Studio Code,
> Symfony,
> PHPMyAdmin,
> Composer

***Les langues :***

> PHP,
> HTML,
> CSS,
> MySQL


# To-do
- changer le style de login register et padding sur tous les boutons ?
- optimiser les fonctions crud
- let users delete their comments ?
- add delete button of comment and article on all page where we see them ?

# Sources : 
- Notre modèle : https://github.com/tvatry/adblangues <br>
- Une vidéo sur la création de formulaires : https://youtu.be/_cgZheTv-FQ
