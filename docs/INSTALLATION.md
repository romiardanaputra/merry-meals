# Installation Guide

## Prerequisites

- **PHP** >= 8.0.2
- **Composer** >= 2.0
- **Node.js** >= 16.x
- **NPM** or **Yarn**
- **MySQL** >= 5.7 atau **MariaDB**
- **Stripe Account** (untuk donasi)

## Installation Steps

### 1. Clone Repository

```bash
git clone https://github.com/your-repo/merry-meals.git
cd merry-meals
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
# atau
yarn install
```

### 4. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=merry_meals
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Configure Stripe

```env
STRIPE_KEY=pk_test_xxxxx
STRIPE_SECRET=sk_test_xxxxx
CASHIER_CURRENCY=usd
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed Database (Optional)

```bash
php artisan db:seed
```

---

## Running the Application

### Development

```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite dev server
npm run dev
```

Application akan tersedia di: `http://localhost:8000`

### Production Build

```bash
npm run build
```

---

## Testing

### Run All Tests

```bash
./vendor/bin/pest
```

### Run Specific Test

```bash
./vendor/bin/pest tests/Feature/ExampleTest.php
```

---

## Useful Commands

| Command                     | Description           |
| --------------------------- | --------------------- |
| `php artisan serve`         | Start dev server      |
| `php artisan migrate`       | Run migrations        |
| `php artisan migrate:fresh` | Reset & migrate       |
| `php artisan db:seed`       | Seed database         |
| `php artisan cache:clear`   | Clear cache           |
| `php artisan config:clear`  | Clear config cache    |
| `php artisan route:list`    | List all routes       |
| `npm run dev`               | Start Vite dev server |
| `npm run build`             | Build for production  |

---

## Troubleshooting

### Permission Issues (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

### Clear All Cache

```bash
php artisan optimize:clear
```

### Composer Autoload

```bash
composer dump-autoload
```
