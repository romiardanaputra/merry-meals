# Merry Meals

Platform pengiriman makanan berbasis Laravel untuk program Meals on Wheels yang membantu lansia dan penyandang disabilitas mendapatkan makanan bergizi.

## Tech Stack

| Category  | Technology                       |
| --------- | -------------------------------- |
| Framework | Laravel 9.x                      |
| PHP       | 8.0.2+                           |
| Auth      | Laravel Breeze + Sanctum         |
| Payment   | Laravel Cashier + Stripe         |
| Frontend  | Tailwind CSS, Alpine.js, DaisyUI |
| Testing   | Pest PHP                         |

## Quick Links

- [Installation Guide](INSTALLATION.md)
- [Architecture Overview](ARCHITECTURE.md)
- [Database Schema](DATABASE.md)
- [API Documentation](API.md)
- [Features](FEATURES.md)

## User Roles

| Role        | Description                               |
| ----------- | ----------------------------------------- |
| **Admin**   | System administration                     |
| **Member**  | Penerima makanan (lansia/disabilitas)     |
| **Partner** | Pemilik restoran yang menyediakan makanan |
| **Rider**   | Volunteer yang mengantarkan makanan       |

## Key Features

- 🍽️ **Meal Management** - Partner dapat mengelola menu makanan
- 🛒 **Order System** - Member dapat memesan makanan
- 🚚 **Delivery Tracking** - Volunteer assignment dan status tracking
- 💳 **Donations** - Sistem donasi terintegrasi Stripe
- 📊 **Survey** - Feedback dari member

## Quick Start

```bash
# Clone repository
git clone https://github.com/your-repo/merry-meals.git

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
php artisan serve
npm run dev
```

## Project Structure

```
merry-meals/
├── app/
│   ├── Interfaces/      # Repository contracts
│   ├── Repositories/    # Data access layer
│   ├── Services/        # Business logic layer
│   ├── Models/          # Eloquent models
│   ├── Http/Controllers/
│   └── Providers/
├── database/migrations/
├── resources/views/
├── routes/
└── docs/               # Documentation
```

## License

MIT License
