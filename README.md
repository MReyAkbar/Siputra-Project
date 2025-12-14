# Siputra-Project

A Laravel-based web application using Blade templates. This repository contains application source code, Blade views, frontend tooling (Vite/Tailwind/PostCSS), and typical Laravel project files.

Languages (detected):
- Blade: 68.9%
- PHP: 30.6%
- Other: 0.5%

---

## Table of Contents
- About
- Repository layout
- Requirements
- Installation (local)
- Configuration
- Database: migrations & seeders
- Frontend / Assets
- Run (development)
- Tests
- Deployment (notes)
- Contributing
- License
- Maintainers / Contact

---

## About
Siputra-Project is a server-rendered web application built with PHP and Blade templates (Laravel framework conventions). The repo contains app/, resources/, routes/, database/ and typical Laravel tooling files (composer.json, package.json, vite/tailwind/postcss configs).

Replace or expand this section with a short summary of the project's purpose, target users, scope, and any screenshots or demo links.

---

## Repository layout (selected)
- .editorconfig, .gitattributes, .gitignore
- README.md (this file)
- composer.json, composer.lock
- package.json, package-lock.json
- phpunit.xml
- artisan (Laravel console entry)
- app/ (application PHP source)
- bootstrap/
- config/
- database/ (migrations, seeders, factories)
- public/ (web root)
- resources/ (Blade views, assets)
- routes/ (routes/web.php, routes/api.php etc.)
- storage/
- tests/
- vite.config.js, tailwind.config.js, postcss.config.js

Use the above as a quick guide to the code layout. Inspect routes/ and resources/views to see available pages and components.

---

## Requirements
- PHP 8.0+ (or the project-specific version in composer.json)
- Composer
- A database supported by Laravel (MySQL, MariaDB, PostgreSQL, SQLite)
- Node.js + npm (for frontend tooling)
- Git

Check composer.json and package.json for exact version constraints and additional required PHP extensions or Node modules.

---

## Installation (local development)

1. Clone the repository
   git clone https://github.com/MReyAkbar/Siputra-Project.git
   cd Siputra-Project

2. Install PHP dependencies
   composer install

3. Install frontend dependencies
   npm install

4. Copy environment file and set credentials
   cp .env.example .env
   - Update .env with your DB credentials and other environment values
   - Generate app key:
     php artisan key:generate

5. (Optional) Create the storage symlink
   php artisan storage:link

6. Run database migrations and seeders
   php artisan migrate
   php artisan db:seed   # or php artisan migrate --seed

Notes:
- If you prefer SQLite for quick local testing, set DB_CONNECTION=sqlite and configure DB_DATABASE to a local file.
- If there are project-specific seeders or factory instructions, follow them (see database/ directory).

---

## Configuration
- Edit .env to configure APP_URL, database connection, mail, queue, and other environment-specific settings.
- If you added third-party services (Sentry, social providers, etc.), add their credentials to .env and config files.

---

## Frontend / Assets
This project includes Vite and Tailwind configuration files (vite.config.js, tailwind.config.js, postcss.config.js). The typical commands:

- Development (hot reload/watch)
  npm run dev

- Build production assets
  npm run build

- If a legacy Laravel Mix setup is used replace npm scripts accordingly — consult package.json for exact scripts.

---

## Running the application (development)
Start the built-in PHP server:
php artisan serve

Visit the app at http://127.0.0.1:8000 (or the address shown in the console).

If using Vite dev server, run npm run dev concurrently to enable hot module replacement for frontend assets.

---

## Tests
Run the PHP test suite (if tests are present):
./vendor/bin/phpunit
or
php artisan test

See tests/ directory for available test cases.

---

## Deployment (notes)
- Set APP_ENV=production and APP_DEBUG=false in production .env.
- Ensure a valid APP_KEY is set (php artisan key:generate --show to print).
- Build assets for production: npm run build
- Configure the webserver document root to point to the project's public/ directory (Nginx/Apache).
- Set correct filesystem permissions for storage/ and bootstrap/cache/.
- Use queue workers, scheduling, and supervisor/systemd for background processing as needed.

---

## Contributing
1. Fork the repository.
2. Create a branch: git checkout -b feature/your-feature
3. Commit changes: git commit -m "Short description"
4. Push branch and open a pull request.
5. Run tests and linters locally before opening a PR.

Please include tests for new features and document any public API changes.

---

## Useful commands
- composer install
- composer update
- php artisan migrate
- php artisan migrate:rollback
- php artisan db:seed
- php artisan route:list
- php artisan config:clear
- php artisan cache:clear
- npm install
- npm run dev
- npm run build
- php artisan storage:link

---

## Maintainers / Contact
Repository owner: `MReyAkbar`
Contributor `splakplutoy`, `Achmad-D-Fajar`, `akhaly998`, `itsvinaas`
For questions or issues, open an issue on the repository: https://github.com/MReyAkbar/Siputra-Project/issues

---

If you want, I can:
- Extract exact scripts from package.json and list them here,
- Read composer.json to document PHP/package requirements,
- Generate a short Quick Start section customized to the repository contents (routes, example env variables),
or produce the README as a file ready to commit. Which would you prefer?
