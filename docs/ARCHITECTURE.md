# Architecture Overview

## Directory Structure

```
app/
├── Console/           # Artisan commands
├── Enum/              # Enums
├── Exceptions/        # Exception handlers
├── Http/
│   ├── Controllers/
│   │   ├── Admin/     # Admin controllers
│   │   ├── Auth/      # Authentication (Laravel Breeze)
│   │   ├── Member/    # Member features
│   │   ├── Pages/     # Public pages
│   │   ├── Partner/   # Partner features
│   │   ├── Rider/     # Rider/volunteer features
│   │   └── User/      # User management
│   ├── Middleware/    # Custom middleware
│   └── Requests/      # Form requests
├── Interfaces/        # Repository interfaces
├── Models/            # Eloquent models (7)
├── Providers/         # Service providers
├── Repositories/      # Repository implementations
├── Services/          # Business logic services
└── View/Components/   # Blade components
```

## Design Patterns

### Repository Pattern

Project ini menggunakan Repository Pattern untuk separation of concerns:

```
Controller → Service → Repository → Model
```

**Benefits:**

- Loose coupling antara business logic dan data access
- Mudah di-test dengan mock repositories
- Single point of data access

### Layer Architecture

| Layer              | Directory                | Responsibility      |
| ------------------ | ------------------------ | ------------------- |
| **Presentation**   | `Controllers/`, `Views/` | HTTP handling, UI   |
| **Business Logic** | `Services/`              | Business rules      |
| **Data Access**    | `Repositories/`          | Database operations |
| **Domain**         | `Models/`                | Entity definitions  |

## Controllers

### Public Pages (`Pages/`)

- `IndexController` - Homepage
- `AboutController` - About page
- `ContactController` - Contact page
- `BlogController` - Blog listing
- `DonationController` - Donation system

### Authenticated Users

- `Member/` - Order management, surveys
- `Partner/` - Meal & profile management
- `Rider/` - Delivery management
- `Admin/` - System administration

## Middleware

### Roles Middleware

Custom middleware untuk role-based access control:

```php
// routes/web.php
Route::middleware('roles:admin,partner')->group(function () {
    // Admin dan partner routes
});
```

**Available Roles:**

- `admin` - Full system access
- `member` - Order meals, take surveys
- `partner` - Manage meals and restaurant
- `rider` - Handle deliveries

## Service Providers

| Provider                    | Purpose               |
| --------------------------- | --------------------- |
| `AppServiceProvider`        | Application bootstrap |
| `AuthServiceProvider`       | Auth policies         |
| `EventServiceProvider`      | Event listeners       |
| `RouteServiceProvider`      | Route configuration   |
| `RepositoryServiceProvider` | Interface bindings    |

## View Components

Located in `app/View/Components/` and `resources/views/components/`:

- **Navigation**: `navbar`, `navbarMember`, `footer`
- **Meal**: `mealMenu`, `mealDetail`, `mealPackage`
- **Forms**: `donation_form`, `survey`, `register`
- **UI**: `modal`, `dropdown`, `button`
