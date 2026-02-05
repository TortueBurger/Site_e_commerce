# 👟 Kickstep - E-commerce de Sneakers

**Kickstep** est une plateforme de vente en ligne spécialisée dans les sneakers. Ce projet propose une expérience d'achat complète, allant de la consultation du catalogue à la gestion administrative des stocks et des commandes.

---

## 🚀 Fonctionnalités Principales

### 🛒 Interface Client
* **Navigation Intuitive :** Page d'accueil dynamique présentant les dernières "drops" et collections.
* **Gestion du Panier :** Système complet d'ajout et de modification d'articles.
* **Espace Personnel :** Inscription, connexion et gestion du profil utilisateur.


### 🔐 Interface Administration
* **Tableau de Bord :** Vue globale sur l'état de la boutique.
* **Gestion du Catalogue :** CRUD complet (Ajouter, Modifier, Supprimer) sur les produits.
* **Gestion Utilisateurs :** Modération et suivi des comptes clients.


---

## 📂 Arborescence du projet

```text
Site_e_commerce/
├── src/
│   ├── config/
│   │   └── config.php
│   ├── css/
│   │   ├── admin_add.css
│   │   ├── admin_dashboard.css
│   │   ├── admin_edit.css
│   │   ├── admin_users.css
│   │   ├── cart.css
│   │   ├── commands.css
│   │   ├── drop.css
│   │   ├── footer.css
│   │   ├── header.css
│   │   ├── homepage.css
│   │   ├── login.css
│   │   ├── products.css
│   │   └── profile.css
│   ├── database/
│   │   ├── create_database.php
│   │   └── create_tables.php
│   ├── images/
│   │   ├── drop1.jpg
│   │   ├── drop2.jpg
│   │   ├── img1.jpg
│   │   ├── img2.jpg
│   │   ├── img3.jpg
│   │   └── logo_ecommerce.png
│   ├── js/
│   │   ├── countdown.js
│   │   ├── handle_redirection.js
│   │   ├── order.js
│   │   └── script.js
│   ├── management/
│   │   ├── admin_gestion.php
│   │   ├── login_request.php
│   │   ├── order_gestion.php
│   │   ├── product_management.php
│   │   └── register_request.php
│   ├── pages/
│   │   ├── admin_add.php
│   │   ├── admin_dashboard.php
│   │   ├── admin_edit.php
│   │   ├── admin_users.php
│   │   ├── cart.php
│   │   ├── commands.php
│   │   ├── drop.php
│   │   ├── homepage.php
│   │   ├── login.php
│   │   ├── logout.php
│   │   ├── products.php
│   │   ├── profile.php
│   │   └── register.php
│   └── templates/
│       ├── footer.php
│       ├── header.php
│       ├── layout.php
│       └── main.php
├── LICENSE
└── README.md
```
---

## 🛠️ Installation et Utilisation

1. **Installer WAMPSERVER**

2. **Cloner le projet dans le dossier www de wamp64**
   ```bash
   git clone https://github.com/TortueBurger/Site_e_commerce.git
   ```

3. **Initaliser le projet en lançant via WAMP 'main.php'**

**Attention, si vous relancez 'main.php' alors qu'une base de donnée existe déjà, les produits ajoutés lors de se lancement n'auront pas de stock attribué. Nous recommandons de supprimer la base de donnée sur 'localhost/phpmyadmin5.2.3' avant de relancer le 'main.php'.**
