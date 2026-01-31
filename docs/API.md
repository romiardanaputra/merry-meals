# API & Routes Documentation

## Route Structure

```
routes/
├── web.php      # Web routes (public + auth)
├── api.php      # API routes (Sanctum)
├── auth.php     # Authentication routes (Breeze)
├── console.php  # Artisan commands
└── channels.php # Broadcasting channels
```

## Web Routes

### Public Routes

| Method | URI                | Controller                | Name            |
| ------ | ------------------ | ------------------------- | --------------- |
| GET    | `/`                | IndexController@index     | index           |
| GET    | `/about`           | AboutController@index     | about           |
| GET    | `/contact`         | ContactController@index   | contact         |
| GET    | `/blog`            | BlogController@index      | blog            |
| GET    | `/donation`        | DonationController@index  | donation        |
| GET    | `/donation/create` | DonationController@create | donation.create |

### Authenticated Routes

| Method | URI          | Controller                | Middleware     |
| ------ | ------------ | ------------------------- | -------------- |
| GET    | `/dashboard` | - (view)                  | auth, verified |
| GET    | `/profile`   | ProfileController@edit    | auth           |
| PATCH  | `/profile`   | ProfileController@update  | auth           |
| DELETE | `/profile`   | ProfileController@destroy | auth           |

### Member Routes

| Method | URI              | Controller             | Description |
| ------ | ---------------- | ---------------------- | ----------- |
| GET    | `/member/orders` | OrderController@index  | View orders |
| POST   | `/member/orders` | OrderController@store  | Place order |
| GET    | `/member/survey` | SurveyController@index | Take survey |

### Partner Routes

| Method | URI                   | Controller                    | Description  |
| ------ | --------------------- | ----------------------------- | ------------ |
| GET    | `/partner/meals`      | PartnerMealController@index   | View meals   |
| POST   | `/partner/meals`      | PartnerMealController@store   | Create meal  |
| PUT    | `/partner/meals/{id}` | PartnerMealController@update  | Update meal  |
| DELETE | `/partner/meals/{id}` | PartnerMealController@destroy | Delete meal  |
| GET    | `/partner/profile`    | PartnerProfileController@edit | Edit profile |

---

## Auth Routes (Laravel Breeze)

### Guest Routes

| Method | URI                       | Name             | Description         |
| ------ | ------------------------- | ---------------- | ------------------- |
| GET    | `/register`               | register         | Registration form   |
| POST   | `/register`               | -                | Create account      |
| GET    | `/login`                  | login            | Login form          |
| POST   | `/login`                  | -                | Authenticate        |
| GET    | `/forgot-password`        | password.request | Password reset form |
| POST   | `/forgot-password`        | password.email   | Send reset link     |
| GET    | `/reset-password/{token}` | password.reset   | Reset form          |
| POST   | `/reset-password`         | password.store   | Update password     |

### Authenticated Routes

| Method | URI                                | Name                | Description         |
| ------ | ---------------------------------- | ------------------- | ------------------- |
| GET    | `/verify-email`                    | verification.notice | Email verification  |
| GET    | `/verify-email/{id}/{hash}`        | verification.verify | Verify email        |
| POST   | `/email/verification-notification` | verification.send   | Resend verification |
| GET    | `/confirm-password`                | password.confirm    | Confirm password    |
| PUT    | `/password`                        | password.update     | Update password     |
| POST   | `/logout`                          | logout              | Logout              |

---

## API Routes

### Sanctum Protected

| Method | URI         | Description            |
| ------ | ----------- | ---------------------- |
| GET    | `/api/user` | Get authenticated user |

---

## Middleware

### Available Middleware

| Alias      | Class                   | Description            |
| ---------- | ----------------------- | ---------------------- |
| `auth`     | Authenticate            | Require authentication |
| `guest`    | RedirectIfAuthenticated | Guest only             |
| `verified` | EnsureEmailIsVerified   | Email verified         |
| `roles`    | Roles                   | Role-based access      |

### Usage Example

```php
// Single role
Route::middleware('roles:admin')->group(function () {
    // Admin only routes
});

// Multiple roles
Route::middleware('roles:admin,partner')->group(function () {
    // Admin or Partner routes
});
```

---

## Route Naming Convention

```
resource.action
```

**Examples:**

- `profile.edit` - Edit profile
- `donation.create` - Create donation
- `password.update` - Update password
