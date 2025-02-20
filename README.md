# zoo_arcadia

## Description
Zoo_arcadia est un site web créé avec Symfony, utilisant Twig pour les templates, Sass pour le style et javascript pour les interactions.
Dans ce projet, un visiteur peut :
Avoir un apperçu des différents habitats et animaux du zoo ;
Laisser un commentaire ;
Contacter le zoo.

Le zoo possède un vétérinaire, un employé et un administrateur. Tous doivent se connecter pour accéder à leur dashboard.
Un administrateur peut tout vérifier et contrôler les contenus.
Un employé pour valider ou non un avis et remplir la ficher de l'animal.
Un vétérinaire indique et rempli la fiche de chaque animal.

## Prérequis
Avant de commencer, assure-toi que tu as installé les outils suivants :
- [PHP](https://www.php.net/) >= 7.4
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) et [Yarn](https://yarnpkg.com/) (si tu utilises Webpack Encore ou Sass)

## Installation
- Installer les dépendances PHP avec Composer
composer install

Installer les dépendances frontend avec Yarn ou npm
yarn install |ou| npm install

- Configure ton environnement
Crée un fichier .env.local à la racine du projet et configure les variables d'environnement, telles que la connexion à la base de données, par exemple :
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7

- Crée et migre la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

- Importer les données via le fichier zoo_arcadia.sql à la racine du projet.

- Lancer le serveur de développement
symfony server:start -d

### Clone le dépôt
```bash
git clone https://github.com/ValentinBurillier/zoo-arcadia.git
cd zoo-arcadia
