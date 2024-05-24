# Documentation du site rapTest

## Contexte et besoins

**rapTest** est un site développé en PHP avec le framework Laravel. Il s'agit d'un site de quiz ayant pour thème la musique.

## Réalisations

### Base de données

Les tables sont créées sous forme de migrations.

**Migrations créées :**
- `users`
- `articles`
- `rappeurs`
- `quiz`
- `paniers`

### Outils du framework utilisés

- **Migrations** : pour ajouter des tables
- **Vues** : pour afficher les différentes pages
- **Controllers** : pour implémenter les méthodes
- **Models** : pour récupérer les colonnes utilisées pour chaque migration
- **Routes** : pour utiliser les méthodes des Controllers
- **Seeders** : pour remplir la base de données
- **Providers**

### Fonctionnalités intégrées

**Authentification Utilisateur :**
- Connexion
- Inscription
- Suppression
- Modification de profil

**Quiz :**
- Création d'interface
- Ajout de points aux utilisateurs en répondant aux quiz

**Musique :**
- Écouter/télécharger de la musique

**Boutique :**
- Création d'interface
- Achat d'articles

**Classement :**
- Affichage d'un classement des utilisateurs (par valeur)

**Ajout d'un footer**

**Attribution de bonus selon les actions de l'utilisateur**

## Contraintes

- Le design doit etre responsive
- Un guest doit pouvoir consulter le site
- Absolument tout doit etre stocké dans la BDD  

