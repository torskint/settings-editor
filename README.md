# Settings Editor for Laravel

**SettingsEditor** est un module Laravel autonome qui permet à vos clients de modifier dynamiquement les informations de contact de leur site — comme le nom du site, le téléphone, WhatsApp, l’adresse ou l’email — sans avoir besoin d’une base de données.

## 🔧 Fonctionnalités principales

- ✅ Sans base de données  
- 🗂️ Données enregistrées dans un fichier JSON  
- 🌐 Interface web simple et intuitive pour éditer les paramètres  
- ⚙️ Chargement automatique via Composer  
- 🚀 Idéal pour les déploiements multi-sites ou via FTP  

## ⚙️ Installation

### 1. Ajouter le package avec Composer

```bash
composer require torskint/settings-editor
````


### 2. Publier les fichiers de configuration

> 📄 **Publie le fichier de configuration** `torskint-settings-editor.php` dans le répertoire `config/`.
> Cela permet de personnaliser les options du module.

```bash
php artisan vendor:publish --tag="torskint-settings-editor-config" --ansi --force
```


### 3. Publier les assets

> 🖼️ **Publie les assets (CSS, JS, images, etc.)** dans `public/vendor/settings-editor`.
> Cela permet à l'interface web de fonctionner avec son style et ses scripts.

```bash
php artisan vendor:publish --tag="torskint-settings-editor-assets" --ansi --force
```


## 🚀 Utilisation

Accédez à l'interface web d’édition à l’adresse :

```
/settings-editor
```

Les données modifiées sont automatiquement enregistrées dans un fichier JSON (`storage/app/torskint-settings-editor.json` par défaut).


## 📌 Constantes disponibles

Les constantes suivantes sont automatiquement définies à partir des paramètres sauvegardés :

* `GOOGLE_TAG_MANAGER_ID`
* `SITE_NAME`
* `SITE_ADDRESS`
* `SITE_EMAIL`
* `SITE_WWW`
* `SITE_PHONE`
* `SITE_PHONE_2`
* `SITE_WHATSAPP`
* `AUTHOR_NAME`
* `AUTHOR_EMAIL`
* `WEBMASTER_NAME`
* `WEBMASTER_EMAIL`
* `SITE_PRIMARY_COLOR`
* `CRISP_CHAT_WIDGET_ID`
* `CREATED_DATE`
* `WEBSITE_CREATED_DATE`
* `TEAG`

Ces constantes sont accessibles globalement dans votre code PHP et dans vos vues Blade avec `{{ SITE_NAME }}` par exemple.
