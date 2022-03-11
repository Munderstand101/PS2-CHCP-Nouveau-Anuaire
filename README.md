# AP-4.1-AutoCool-API

## Présentation :
```
...

```


## Installation :
```bash
//Installer les dépendances
composer install

//Créer la base de données
symfony console doctrine:database:create

//Créer une migration (sorte de sauvegarde)
symfony console make:migration

//Migrer la migration
symfony console doctrine:migrations:migrate

//Supprimer la base de données
symfony console doctrine:database:drop --force

//Charger les fixtures
symfony console doctrine:fixtures:load

//Autre 
symfony serve -d
symfony server:start
symfony server:stop

```

## Configuration :
Modifier la configuration du fichier `.env.local`, ce fichier contient la configuration du projet :
```bash
# Configurer l'accès à la base de données
# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7",
```

## Les Bundles utilisées :
Pour ce projet, j'ai utilisé les bundles suivants :
- [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html ) (pour les fixtures) : `composer require --dev orm-fixtures`
- [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) (pour la pagination) : `composer require knplabs/knp-paginator-bundle`
- [KnpTimeBundle](https://github.com/KnpLabs/KnpTimeBundle) (pour le texte "il y a 3 minutes") : `composer require knplabs/knp-time-bundle`
- [KnpMarkdownBundle](https://github.com/KnpLabs/KnpMarkdownBundle) (pour les markdown) : `composer require knplabs/knp-markdown-bundle`


Pour la partie gestion et administration :
- [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) to manage user login / registration
- [SonataAdminBundle](https://github.com/sonata-project/SonataAdminBundle) to manage backend
- [StofDoctrineExtensionsBundle](https://github.com/stof/StofDoctrineExtensionsBundle) to manage the "sluggable" behaviour

## TODO
- [x] ...
- [ ] ...
