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
```

### 2. Publier le fichier de configuration

```bash
php artisan vendor:publish --provider="SettingsEditor\SettingsEditorServiceProvider" --tag="settings-editor"
```
