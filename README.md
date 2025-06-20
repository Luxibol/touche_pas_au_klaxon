# 🚗 Touche Pas au Klaxon

**Touche Pas au Klaxon** est une application web de covoiturage d’entreprise permettant aux collaborateurs de différents sites de proposer et réserver des trajets en toute simplicité. Elle fonctionne en intranet, avec des rôles utilisateurs/admins, une gestion sécurisée des trajets, agences et utilisateurs.

---

## ✨ Fonctionnalités principales

- Création, modification et suppression de trajets
- Visualisation de tous les trajets proposés
- Gestion des agences et des utilisateurs (admin uniquement)
- Authentification avec rôles (utilisateur ou administrateur)
- Interface responsive (Bootstrap + SCSS)
- Validation serveur (PHP)
- Sécurité de base (sessions, accès restreints)
- Tests unitaires pour les opérations d’écriture (PHPUnit)
- Analyse statique du code (PHPStan)

---

## 🛠️ Technologies utilisées

- **Front-end** : HTML5, Bootstrap 5, SCSS
- **Back-end** : PHP 8 (programmation orientée objet)
- **Base de données** : MySQL/MariaDB
- **Routeur** : [`bramus/router`](https://github.com/bramus/router)
- **Tests** : PHPUnit 11
- **Vérification statique** : PHPStan 2.1

---

## ⚙️ Installation du projet

### 1. Prérequis

- PHP ≥ 8.1
- Composer
- Node.js + npm
- Serveur local (XAMPP recommandé)
- MySQL/MariaDB

---

### 2. Cloner le projet

```bash
git clone https://github.com/luxibol/touche_pas_au_klaxon.git
cd touche_pas_au_klaxon
```

---

### 3. Installer les dépendances 

#### a. Dépendances PHP

```bash
composer install
```

#### b. Dépendances front-end (SCSS/JS)

```bash
npm install
```
---

### 4. Compilation du CSS

```bash
# Compiler une fois
npm run build-css

# OU pour surveiller les changements en temps réel
npm run watch-css
```

Le CSS compilé sera généré dans Public/assets/css/

---

### 5. Configuration de la base de données

Deux bases sont nécessaires : une pour l’application, une pour les tests.

#### 🟦 Base de production : `touche_pas_au_klaxon`

- Créez la base :
```sql
CREATE DATABASE touche_pas_au_klaxon DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
```
- Importez les deux fichiers dans le dossier `sql/` :
  - `create_tables.sql`
  - `seed.sql`

#### 🟧 Base de test : `tpk_test`

- Créez la base :
```sql
CREATE DATABASE tpk_test DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
```
- Importez uniquement :
  - `create_tables.sql`

> 🛑 Ne pas importer `seed.sql` dans `tpk_test` : les tests créent leurs propres données.

---

### 6. Lancer l’application

- Lancez votre serveur local (XAMPP / MAMP)
- Accédez à l’adresse : [http://localhost/touche_pas_au_klaxon/Public/](http://localhost/touche_pas_au_klaxon/Public/)

---

## 🧪 Tests

### PHPUnit

Des tests unitaires couvrent toutes les fonctionnalités d’écriture en base de données (création, modification et suppression de trajets et agences).

Lancez les tests avec :

```bash
./vendor/bin/phpunit
```

> ⚠️ Les tests utilisent automatiquement la base `tpk_test`.

---

## 🔎 Analyse statique

Le projet utilise PHPStan pour vérifier la qualité du code PHP :

```bash
./vendor/bin/phpstan analyse
```

> Aucun warning ne doit apparaître à ce stade.

---

## 👥 Comptes de test

- **Administrateur**  
  Email : `arthur.henry@email.fr`  
  Mot de passe : `azerty`

- **Utilisateur simple**  
  Email : `alexandre.martin@email.fr`  
  Mot de passe : `azerty`

> ⚠️ Les mots de passe sont hachés dans la base.

---

## 📂 Structure du projet

```txt
├── App/
│   └── Controllers/       # Tous les contrôleurs de l'application
├── Core/                  # Configuration de l'application et base de données (Database.php)
├── Templates/             # Fichiers de vues HTML/PHP
├── Public/
│   ├── assets/            # Fichiers SCSS, JS, images, etc. (CSS généré ignoré par Git)
│   └── index.php          # Point d’entrée de l’application
├── sql/                   # Scripts SQL de création et de remplissage des bases
├── tests/                 # Tests unitaires avec PHPUnit
├── composer.json
├── phpunit.xml
├── phpstan.neon
├── .gitignore
└── README.md              # Ce fichier
```

---

## 🧑‍💻 Auteur

Mathieu Billoux  
📧 mathieu.billoux@outlook.fr  
🔗 [GitHub – Luxibol](https://github.com/Luxibol)

---
