 # Tasks Manager - PHP / PostgreSQL (MVC & OOP)

Application de gestion de tâches collaborative avec authentification
(**Login / Register**) développée en **PHP** avec **PostgreSQL**.

Le projet adopte :

- une **architecture MVC propre**
- une **approche orientée objet**
- une **couche Repository**
- une séparation stricte entre logique, données et vues

---

# Uilisation
Clonez le repo avec 
```
git clone https://github.com/nosleepman1/task-Collab
```
creer un fichier **.env**  avec les donnees de .env.exemple

---
##  Fonctionnalités

###  Authentification
- Inscription utilisateur
- Connexion / Déconnexion
- Sessions sécurisées
- Hashage des mots de passe

###  Gestion des tâches
- Création de tâches
- Modification & suppression
- Attribution utilisateur
- Tâches personnelles / collaboratives
- Gestion des statuts

###  Architecture
- MVC strict
- Repositories par entité
- Code modulaire et extensible

---

##  Architecture du projet
```
taskmanager/
│
├── public/
│ ├── css/
│ ├── js/
│ ├── index.php
│ └── .htaccess
│
├── src/
│ ├── controllers/
│ │ ├── UserController.php
│ │ └── TaskController.php
│ │
│ ├── models/
│ │ ├── User.php
│ │ └── Task.php
│ │
│ ├── repositories/
│ │ ├── UserRepository.php
│ │ └── TaskRepository.php
│ |
| | ├── Middlewares/
│ │ ├── taskValidations.php
│ │ └── userValidations.php
│ │
│ ├── Utils/
│ └── UI/
│
├── views/
│ ├── layouts/
│ │ └── main.php
│ ├── auth/
│ ├── tasks/
│ └── pages/
│
├── database/
│ └── database.php
│
├── config/
├── .htaccess
├── composer.json
└── README.md
```



