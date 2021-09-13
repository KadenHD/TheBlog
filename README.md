<br />
<p align="center">
    <img src="https://www.promeo-formation.fr/themes/custom/promeo/img/logos/logo_promeo_white.svg" alt="Logo" height="50px"><br>
    <h3 align="center">Projet Symfony - TheBlog </h3>
        
<details open="open">
  <summary>Sommaire</summary>
  <ol>
    <li>
      <a href="#Introduction">Introduction</a>
    </li>
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
    
# Introduction
    
Dans le cadre de sa politique Qualité, Sécurité et Environnement (QSE), PROMEO s'oriente vers la dématérialisation des documents liés à son workflow métier. En effet, après une campagne de dématérialisation de la satisfaction client sur la partie alternance, PROMEO souhaite poursuivre sur la partie formation continue. C'est pourquoi PROMEO a souhaité développer une application pour analyser les besoins des salariés de la division Langues. Cette application vise à dématérialiser l'analyse des besoins de formation linguistique. Elle se présente sous deux aspects. Une application destinée aux clients de PROMEO. Un autre accès pour les employés de PROMEO.
    
# Installation
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/74053c23c5734e3286f85feadf02ecf3)](https://app.codacy.com/gh/KadenHD/TheBlog?utm_source=github.com&utm_medium=referral&utm_content=KadenHD/TheBlog&utm_campaign=Badge_Grade_Settings)

### Prérequis

Il faut d'abord installer

```
Xamp ou Laragon ainsi qu'une DB MySQL, Composer et PHP (en version 7.2 minimum).
```

S'incrire sur le site Mailtrap pour la réception de mails
    
```
https://mailtrap.io/
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

Editer dans le fichier .env l'url de la DB ainsi que rajouter les identifiants de Mailtrap

```
MAILER_DSN=smtp://*MailtrapURL*  
```
    
Ensuite    
    
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
> JS

# To-do

- faire un captcha sur les 3 pages accessible par des utilisateurs non-connectés

- faire choisir la langue et le niveau de langue sur la page inscription puis grace a url ou autre choisir au hasard un questionnaire du niveau et langage souhaité et le générer

- Dans le form d'inscription, faire une condition pour cocher que 4 prioritaires par partie maximum

- Réaliser la génération et envoie par mail des pdf (dompdf)
- optimiser les fonctions crud

# Sources

- Vidéo sur la création de formulaires : https://youtu.be/_cgZheTv-FQ
- Vidéo sur la réinitialisation de mots de passe par token : https://youtu.be/9RA3yAp4xw8?list=LL
- Vidéo sur la création d'une libraire pour le bundle reCAPTCHA : https://youtu.be/sNmpddaseK8
