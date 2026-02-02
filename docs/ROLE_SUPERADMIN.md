# Role: Super Admin

## Overview

Super Admin memiliki akses penuh ke seluruh platform Merry Meals. Role ini dipegang oleh platform owner atau system administrator.

---

## Permissions Matrix

| Permission       | Super Admin | Notes                |
| ---------------- | :---------: | -------------------- |
| View All Users   |     ✅      | Semua role           |
| Create Users     |     ✅      | Semua role           |
| Edit Users       |     ✅      | Semua role           |
| Delete Users     |     ✅      | Soft delete          |
| Approve Partners |     ✅      | Verifikasi restoran  |
| Manage Drivers   |     ✅      | Verifikasi volunteer |
| View All Orders  |     ✅      | Platform-wide        |
| Manage Donations |     ✅      | Full access          |
| System Settings  |     ✅      | Exclusive            |
| View Reports     |     ✅      | All analytics        |

---

## Features

### 1. User Management

- CRUD operations untuk semua user
- Filter by role, status, date
- Bulk actions (activate, deactivate)
- Role assignment/change

### 2. Partner Management

- Review partner applications
- Approve/Reject dengan notes
- View partner performance
- License verification tracking

### 3. Member Management

- View member profiles
- See order history per member
- Dietary restrictions overview
- Geolocation data access

### 4. Driver Management

- Volunteer verification
- Background check status
- Performance metrics
- Availability monitoring

### 5. Platform Settings

- System configuration
- Feature toggles
- Notification settings
- Integration configs

### 6. Donation Management

- View all donations
- Transaction history
- Donor management
- Refund processing

### 7. Report Analysis

- Comprehensive analytics
- Export capabilities
- Custom date ranges
- Real-time metrics

---

## Dashboard Components

| Component           | Description             |
| ------------------- | ----------------------- |
| Total Users Widget  | Count per role          |
| Order Overview      | Daily/weekly/monthly    |
| Donation Summary    | Total, average, trends  |
| Partner Status      | Active/pending/rejected |
| Driver Availability | Online/offline map      |
| System Health       | Alerts, issues          |

---

## Routes

```php
Route::middleware('roles:superadmin')->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperadminController::class, 'index'])->name('superadmin.dashboard');

    // User Management (all roles)
    Route::resource('users', SuperadminUserController::class)->names('superadmin.users');

    // Platform Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('superadmin.settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('superadmin.settings.update');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('superadmin.reports');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('superadmin.reports.export');
});

// Super admin can also access admin routes
Route::middleware('roles:superadmin,admin')->prefix('admin')->group(function () {
    // Admin routes accessible by superadmin...
});
```

---

## Security Considerations

1. **Limited Accounts** - Minimize number of super admins
2. **Audit Logging** - All actions logged
3. **2FA Required** - Two-factor authentication
4. **IP Restrictions** - Optional whitelist
