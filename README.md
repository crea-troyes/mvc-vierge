# 🧱 Mini MVC - Architecture Vierge (Jour 13)

Ce dépôt contient **l’architecture MVC vierge** réalisée dans le cadre du projet [#100JoursPourCoder](https://blog.crea-troyes.fr) mené par [Alban (Crea-Troyes)](https://crea-troyes.fr).

---

## À propos

Cette structure a été conçue **à partir de zéro**, dans une logique d’apprentissage et de pédagogie, pour servir de fondation au site [Créa-code](https://code.crea-troyes.fr), une plateforme d’exercices gratuits pour apprendre le développement web (HTML, CSS, JS, PHP, MySQL).

Elle est volontairement simple et épurée pour permettre à tous les débutants de **comprendre le fonctionnement du modèle MVC**, sans dépendances externes lourdes.

---

## Suivre le projet

- Le site est en développement **en temps réel** à l’adresse :  
  👉 [https://code.crea-troyes.fr](https://code.crea-troyes.fr)

- Le journal de bord du projet est publié jour après jour sur le Créa-blog :  
  👉 [https://blog.crea-troyes.fr](https://blog.crea-troyes.fr)

---

## Contenu du dépôt

Voici l’organisation des fichiers dans cette version du jour 13 :

```markdown
code.crea-troyes.fr/
│
├── public/                      # Dossier web accessible
│   ├── assets/
│   │   └── style.css            # Feuille de style principale
│   ├── index.php                # Point d'entrée unique de l'application
│   └── .htaccess                # Redirection vers index.php (URL rewriting)
│
├── app/                         # Cœur de l’application (MVC)
│   ├── Controllers/
│   │   └── HomeController.php   # Exemple de contrôleur
│   │
│   ├── Models/
│   │   └── Model.php            # Classe modèle de base
│   │
│   ├── Views/
│   │   ├── layout.php           # Layout principal
│   │   ├── error.php            # Vue d’erreur générique
│   │   ├── partials/
│   │   │   ├── header.php       # En-tête HTML
│   │   │   └── footer.php       # Pied de page HTML
│   │   └── home/
│   │       └── index.php        # Vue associée à HomeController
│   │
│   ├── Route/
│   │   ├── Router.php           # Routeur centralisé
│   │   └── Routes.php           # Fichier de déclaration des routes
│   │
│   └── Core/
│       ├── Controller.php       # Contrôleur parent commun
│       ├── Database.php         # Connexion PDO centralisée
│       └── View.php             # Moteur de rendu simplifié
│
│   └── .htaccess                # Protection de l’accès aux fichiers sensibles
│
├── autoload.php                 # Fonction d’autoload personnalisée
├── config.php                   # Configuration globale du site
```

---

- Le routeur est placé dans `app/Route/Router.php`
- Le système de vues utilise un layout avec `header.php` et `footer.php`
- La séparation `Controller`, `Model`, `View` est respectée
- Préparé pour intégrer une protection par middleware ou un moteur de templates plus évolué

---

## Objectif pédagogique

Cette architecture MVC sert de base d’apprentissage pour :

- Comprendre la séparation des responsabilités
- Définir ses propres routes
- Afficher des vues avec des layouts réutilisables
- Étendre facilement le système avec des middlewares ou une gestion des erreurs

---

## Licence

Projet libre et open-source. Utilisable, modifiable et réutilisable à des fins pédagogiques ou personnelles.

---

Projet imaginé, conçu et documenté par **Alban**, fondateur de [Crea-Troyes.fr](https://crea-troyes.fr).
