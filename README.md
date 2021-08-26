<br />
<p align="center">
    <img src="https://www.promeo-formation.fr/themes/custom/promeo/img/logos/logo_promeo_white.svg" alt="Logo" height="50px"><br>
    <h3 align="center">Projet Symfony - TheBlog </h3>
    
<details open="open">
  <summary>Sommaire</summary>
  <ol>
    <li>
      <a href="#Installation">Installation</a>
    </li>
    <ul>
        <li>
            <a href="#prérequis">Prérequis</a>
        </li>
        <li>
            <a href="#mise-en-place-du-projet">Mise en place du projet</a>
        </li>
    </ul>
    <li>
      <a href="#Technologies">Technologies</a>
    </li>
    <li>
      <a href="#To-do">To-do</a>
    </li>
    <li>
      <a href="#Sources">Sources</a>
    </li>
</details>
    
# Installation

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/74053c23c5734e3286f85feadf02ecf3)](https://app.codacy.com/gh/KadenHD/TheBlog?utm_source=github.com&utm_medium=referral&utm_content=KadenHD/TheBlog&utm_campaign=Badge_Grade_Settings)

### Prérequis

Il faut d'abord installer

```
Xamp ou Laragon ainsi qu'une DB MySQL, Composer et PHP (en version 7.2 minimum).
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
> CSS

# To-do
- Mettre la création de user uniquement pour le rôle super et admin par le system de routes et controller
- Mettre dans la création de user un select des roles
- faire une page de crud sur les users et articles par admin et super
- Modifier les fonctions de crud sur le user actuel avec une condition if role_admin etc...
- Modifier les fixtures et les séparer en créations discinctes, (admin, super admin et formateur) ainsi qu'un profile de chaque avec mot de passes utilisables
- Récupération de mot de passe par token, mail ou tel
- Mise en place du formulaire étudiant
- changer le style de login register et padding sur tous les boutons ?
- optimiser les fonctions crud
- let users delete their comments ?
- add delete button of comment and article on all page where we see them ?

# Sources
- Notre modèle : https://github.com/tvatry/adblangues <br>
- Une vidéo sur la création de formulaires : https://youtu.be/_cgZheTv-FQ
