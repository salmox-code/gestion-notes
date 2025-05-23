# 📘 Gestion des Notes — Laravel App

Une application web de gestion des notes pour établissements scolaires développée avec Laravel.

---

## 🎯 Fonctionnalités principales

- 🧑‍🎓 Gestion des étudiants (CRUD)
- 📚 Gestion des matières
- 📝 Saisie groupée des notes
- 📄 Génération de bulletins PDF par étudiant
- 📤 Envoi de bulletins par email (Mailtrap)
- 🧑‍🏫 Gestion des surveillants
- 📅 Génération de convocations à la surveillance (PDF + Mail)
- 🔐 Authentification sécurisée (Laravel Breeze)

---

## 🛠️ Technologies utilisées

- **Laravel** 10+
- **Tailwind CSS** & Blade Components
- **DomPDF** pour génération de PDF
- **Mailtrap** pour test des emails
- **MySQL** pour la base de données
- **Git & GitHub** pour le versioning

---

## ⚙️ Installation locale

```bash
git clone https://github.com/salmox-code/gestion-notes.git
cd gestion-notes
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve

---

## 🧩 Importer la base de données

1. Ouvrir **phpMyAdmin**
2. Créer une base de données nommée `gestion_notes`
3. Aller dans l’onglet **"Importer"**
4. Sélectionner le fichier : `database_dump/gestion_notes.sql`
5. Cliquer sur **"Exécuter"** pour lancer l'import

✅ La base sera prête pour utiliser l’application Laravel avec les données.

## 📬 Contact

Développé par **Salma Nechda**  
💼 Étudiante en ingénierie - TDIA à ENSAH  
📧 Email : nechdasalma1@gmail.com
