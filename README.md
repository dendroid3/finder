# FINDER

[![repo size](https://img.shields.io/github/repo-size/<your-username>/finder)](https://github.com/<your-username>/finder) 
[![license](https://img.shields.io/github/license/<your-username>/finder)](LICENSE) 
[![build](https://img.shields.io/github/actions/workflow/status/<your-username>/finder/php.yml)](https://github.com/<your-username>/finder/actions)

---

## Short Description
A MVC-style PHP portfolio system built as a group project. The app serves multiple portfolio "templates" and exposes CRUD controllers for each portfolio section. The project is inspired by Laravel's structure but implemented with plain PHP.

---

## Tech Stack
- PHP (plain PHP, no framework)
- MySQL (used for persistence)
- HTML/PHP views for front-end
- Designed to run in XAMPP or any LAMP stack

---

## Quick Links
- **Entry point:** `public/index.php`
- **Routes:** `routes/web.php`
- **App bootstrap:** `app/App.php`
- **Migrations:** `database/run_migrations.php`
- **Views:** `views/`
- **Templates:** `views/templates/` and `templates/` (per-member directories)
- **Controllers:** `controllers/`

---

## Prerequisites
- PHP 7.4+ (or compatible)
- MySQL
- XAMPP (recommended) or any local web server
- (Optional) Composer if you later add dependencies

---

## Environment Setup
Create a local copy of the configuration used by the repo. The project currently uses a simple PHP migration file; storing DB credentials in a small config file is recommended. Example `.env` variables (not implemented by default):

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finder
DB_USERNAME=root
DB_PASSWORD=
Clone & Setup
Fork this repository and clone your fork into your web server root (for XAMPP: C:\xampp\htdocs\):

bash
Copy code
git clone https://github.com/<your-username>/finder.git
Open database/run_migrations.php and change database_user and database_password to match your MySQL credentials.

Create the database named finder in your MySQL server (via phpMyAdmin or mysql CLI).

Run migrations:

bash
Copy code
php database/run_migrations.php
This will create the tables required by the app.

Start the server:

With XAMPP: place the repo in htdocs and navigate to http://localhost/finder/public

PHP built-in server: from project root:

bash
Copy code
php -S localhost:8000 -t public
Then open http://localhost:8000

Project Structure (Top-level)
public/ — application entry point (web server document root)

index.php

app/ — bootstrap / request dispatching

App.php

routes/ — URL → controller mappings

web.php

controllers/ — Application controllers (CRUD)

views/

layouts/ — per-member layout files (login/register)

templates/ — per-member portfolio templates

templates/ — pre-created member template directories (1..5)

database/

run_migrations.php — migration script to create DB tables

storage/ — runtime file storage (uploads, etc.)

Controller Conventions
Each controller should have ONLY these public methods:

create / store

view / read

update

delete

Any other helper methods must be private.

Team member assignments (implement CRUD for your section):

Authentication & Links → Wanjohi

About → Alfred

Services → Eric

References → Ryan

Contacts → Victor

Views & Templates
Add your portfolio template to: views/templates/<your_number>/ (or templates/<your_number>/)

Add layout files (register.php, login.php) to: views/layouts/<your_number>/

Forms:

Register form → action="/register"

Login form → action="/login"

Contribution Workflow
Create a branch named with your assigned number (e.g., 1, 2, ...):

bash
Copy code
git checkout -b 2
Make changes in your branch; do NOT push directly to main.

Commit messages: concise and descriptive, e.g.:

bash
Copy code
git commit -m "Add Services section CRUD"
Push your branch to your fork:

bash
Copy code
git push origin 2
Open a Pull Request (PR) to merge your branch into the fork's main branch.

PRs should be reviewed and approved by at least one other team member before merging.

Usage / Demo
After setup, navigate to http://localhost/finder/public (XAMPP) or http://localhost:8000 (PHP built-in server)

Register a new user and explore your assigned portfolio section.

CRUD operations are accessible via the routes defined in routes/web.php.

License
This project is licensed under the MIT License. See LICENSE for details.

Optional Enhancements
Add screenshots or GIFs of portfolio templates.

Document any Composer or JavaScript dependencies.

Troubleshooting tips (e.g., MySQL port conflicts or PHP version issues).

yaml
Copy code

---

This version:  
- Finishes the contribution workflow  
- Adds badges with real links (replace `<your-username>` with your GitHub username)  
- Adds usage/demo section  
- Adds license section  
- Keeps your original instructions but improves clarity  
