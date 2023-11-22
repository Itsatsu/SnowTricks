# Snowtricks [![Codacy Badge](https://app.codacy.com/project/badge/Grade/8d1cee9a9f964f2e8b247758f08cc9b8)](https://app.codacy.com/gh/Itsatsu/SnowTricks/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
Ceci est un projet pour le parcours de formation [Développeur d'application PHP/Symfony sur Openclassroom](https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony).
Ajout de Tailwind pour aquérir de nouvelles compétences.
- symonfy 6.3

# Fichier présent dans le projet
- schema de base de donnée
- Diagrammes de séquence
- Diagrammes de cas d'utilisation
- Fichier nécessaires pour le bon fonctionnement du projet

## Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre système :
- [PHP](https://www.php.net/) 8.1 ou supérieur
- [Composer](https://getcomposer.org/) 2.6.2 ou supérieur  (pour l'installation des dépendances)
- [MySQL](https://www.mysql.com/) 8.0.30 ou supérieur (ou tout autre système de gestion de base de données compatible)
- [Mailtrap](https://mailtrap.io/) (ou tout autre service de test d'envoi de mail)
- [Symfony CLI](https://symfony.com/download) (pour lancer le projet)
- [npm](https://www.npmjs.com/) (pour l'installation des dépendances tailwind et encore)
- Fichier zip ou clone du projet
## Installation
1. Clonez ou téléchargez le repository GitHub dans le dossier voulu
2. Installez les dépendances du projet avec la commande suivante :
```composer install```
3. Une fois les dépendances installées, lancez l'instaladiton des assets avec la commande suivante :
```npm install```

4. Configurez vos variables d'environnement dans le fichier .env) à la racine du projet:
- Modifier la variable APP_ENV en dev ou prod selon votre environnement
- Ajouter une clé dans APP_SECRET
- Modifier la variable DATABASE_URL avec vos informations de connexion à la base de donnée
- Modifier la variable MAILER_DSN avec vos informations de connexion à votre service de test d'envoi de mail
- Modifier la variable MAILER_FROM avec l'adresse mail que vous souhaitez utiliser pour l'envoi de mail
5. Créez la base de données avec la commande suivante (assurez-vous que votre serveur MySQL local soit en cours d'exécution et de ne pas avoir de base de données nommé snowtricks)
   ```php bin/console doctrine:database:create```
6. Créez la structure de la base de données avec la commande suivante :
```php bin/console doctrine:schema:create```
7. Installez les fixtures avec la commande suivante :
```php bin/console doctrine:fixtures:load```

8. Lancez le serveur avec la commande suivante :
```symfony serve```

9. Lancer le watcher pour compiler les fichiers scss et js avec la commande suivante :
```npm run watch```
10. Rendez-vous sur [localhost:8000](http://localhost:8000/) pour voir le site en fonctionnement

# Les fixtures

Les fixtures présentes dans le projet permettent de générer des données fictives dans la base de données.
- 15 utilisateurs (username0 à username14 avec le mot de passe "pass") 
- 10 figures 
- 10 commentaires (ajouter aléatoirement sur les figures)
- 10 images supplémentaires (ajouter aléatoirement sur les figures)
