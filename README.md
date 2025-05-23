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
## 📬 Contact

Développé par **Salma Nechda**  
💼 Étudiante en ingénierie - TDIA à ENSAH  
📧 Email : nechdasalma1@gmail.com
