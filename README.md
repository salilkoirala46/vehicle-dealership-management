# Vehicle Dealership Management

A Laravel + Vue 3 single-page application for managing a vehicle dealership inventory.

---

## Tech Stack

- **Backend:** Laravel 10, Laravel Sanctum (API auth)
- **Frontend:** Vue 3, Vue Router, Vuex, Vite
- **UI:** AdminLTE 3, Bootstrap 5, Font Awesome
- **Styling:** Sass, Tailwind CSS
- **Alerts:** SweetAlert2

---

## Choose your setup method

| Method | Best for |
|--------|----------|
| [Docker / Laravel Sail](#option-a-docker--laravel-sail-recommended) | Any OS — no local PHP/MySQL needed |
| [Manual (no Docker)](#option-b-manual-setup-no-docker) | When you already have PHP & MySQL installed |
| [GitHub Codespaces](#option-c-github-codespaces) | Browser-based, zero local install |

---

## Option A: Docker / Laravel Sail (recommended)

Works on macOS, Windows, and Linux. Requires only Docker — no PHP or MySQL needed on your machine.

### Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed and running

### Steps

**1. Clone the repository**

```bash
git clone <repo-url>
cd vehicle-dealership-management
```

**2. Install PHP dependencies without local PHP**

```bash
docker run --rm -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

> On **Windows (PowerShell)**, use:
> ```powershell
> docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
> ```

**3. Configure environment**

```bash
cp .env.example .env
```

Open `.env` and set the following (leave everything else as-is):

```env
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

**4. Start the containers**

```bash
./vendor/bin/sail up -d
```

> First run downloads Docker images — this takes a few minutes.  
> On **Windows**, use `vendor\bin\sail up -d` in PowerShell.

**5. Generate app key**

```bash
./vendor/bin/sail artisan key:generate
```

**6. Run migrations and seed demo data**

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

**7. Install frontend dependencies and start Vite**

Open a second terminal in the project folder:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

**8. Open the app**

Visit [http://localhost](http://localhost) in your browser.

---

## Option B: Manual Setup (no Docker)

Use this if you already have PHP and MySQL installed locally.

### Prerequisites

| Tool | Version |
|------|---------|
| PHP | >= 8.1 (with `pdo_mysql`, `mbstring`, `xml`, `curl` extensions) |
| Composer | >= 2.x |
| Node.js | >= 18.x |
| npm | >= 9.x |
| MySQL | >= 8.0 |

**Check your versions:**

```bash
php --version
composer --version
node --version
npm --version
mysql --version
```

### Steps

**1. Clone the repository**

```bash
git clone <repo-url>
cd vehicle-dealership-management
```

**2. Install dependencies**

```bash
composer install
npm install
```

**3. Configure environment**

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and update the database block:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicle_dealership
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

**4. Create the database**

Log in to MySQL and run:

```sql
CREATE DATABASE vehicle_dealership CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or from the terminal:

```bash
mysql -u root -p -e "CREATE DATABASE vehicle_dealership CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

**5. Run migrations and seed demo data**

```bash
php artisan migrate:fresh --seed
```

**6. Start the servers**

Open **two terminals** in the project folder:

```bash
# Terminal 1 — Laravel backend
php artisan serve
```

```bash
# Terminal 2 — Vite frontend
npm run dev
```

**7. Open the app**

Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## Option C: GitHub Codespaces

No local install needed — runs entirely in the browser.

**1.** Click **Code → Codespaces → Create codespace on main** in the GitHub repo.

**2.** Once the Codespace loads, run in the terminal:

```bash
cd vehicle-dealership-management
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

**3.** Open `.env` and update both URLs to match your Codespace name:

```env
APP_URL=https://<codespace-name>-80.app.github.dev
VITE_DEV_SERVER_URL=https://<codespace-name>-5173.app.github.dev
```

> Your codespace name appears in the browser URL bar, e.g. `bug-free-fishstick-vg5xw59qqqvfw5p`.

**4.** In the **Ports** panel (bottom of VS Code), set ports **80** and **5173** visibility to **Public**.

**5.** Visit the forwarded URL for port **80** shown in the Ports panel.

---

## Test Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@dealership.com` | `password` |
| Staff | `staff@dealership.com` | `password` |

---

## Stopping the app

**Sail (Docker):**

```bash
./vendor/bin/sail down
```

**Manual:**

Press `Ctrl+C` in both terminals.

---

## Common Issues

**`./vendor/bin/sail: Permission denied`**

```bash
chmod +x vendor/bin/sail
```

**`Port 80 already in use` (Sail)**

Another service is using port 80. Change `APP_PORT` in `.env`:

```env
APP_PORT=8080
```

Then restart: `./vendor/bin/sail down && ./vendor/bin/sail up -d`  
Visit [http://localhost:8080](http://localhost:8080).

**`SQLSTATE[HY000] [2002] Connection refused` (manual setup)**

MySQL isn't running. Start it:

```bash
# macOS (Homebrew)
brew services start mysql

# Ubuntu / Debian
sudo service mysql start
```

**`php_pdo_mysql` extension missing**

```bash
# macOS (Homebrew)
brew install php
# or enable in your php.ini:
extension=pdo_mysql

# Ubuntu / Debian
sudo apt install php-mysql
```

---

## Useful Commands

```bash
# Re-run all migrations and reseed from scratch
./vendor/bin/sail artisan migrate:fresh --seed   # Docker
php artisan migrate:fresh --seed                 # manual

# Clear all caches
./vendor/bin/sail artisan optimize:clear         # Docker
php artisan optimize:clear                       # manual

# List registered routes
./vendor/bin/sail artisan route:list             # Docker
php artisan route:list                           # manual

# Open a shell inside the Docker container
./vendor/bin/sail shell
```
