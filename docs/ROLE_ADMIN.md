# Role: Admin

## Overview

Admin bertugas mengelola operasional harian platform Merry Meals. Fokus pada user management, donation tracking, dan operational reports.

---

## Permissions Matrix

| Permission      | Admin | Notes              |
| --------------- | :---: | ------------------ |
| View Members    |  ✅   | Read & manage      |
| View Drivers    |  ✅   | Read & manage      |
| View Partners   |  ✅   | Read only          |
| Create Users    |  ✅   | Member/Driver only |
| Edit Users      |  ✅   | Member/Driver only |
| View All Orders |  ✅   | Assign drivers     |
| View Donations  |  ✅   | Read only          |
| View Reports    |  ✅   | Limited scope      |
| System Settings |  ❌   | Super admin only   |

---

## Features

### 1. User Management

- Manage members and drivers
- View user details and history
- Activate/deactivate accounts
- Password reset assistance

### 2. Donation Management

- View donation list
- Donor information
- Transaction status
- Basic filtering

### 3. Report Analysis

- Operational reports
- Order statistics
- Delivery metrics
- Member activity

### 4. Order Oversight

- View all orders
- Assign drivers to orders
- Update order status
- Handle issues

---

## Dashboard Components

| Component           | Description                |
| ------------------- | -------------------------- |
| Active Orders       | Today's orders             |
| Pending Assignments | Orders without driver      |
| Donation Today      | Daily total                |
| User Stats          | Active members/drivers     |
| Alert Panel         | Issues requiring attention |

---

## Routes (Current)

```php
Route::middleware('roles:admin')->prefix('admin')->group(function () {
    // Dashboard & User Management
    Route::get('/', [UserManagementController::class, 'index'])->name('admin.index');
    Route::get('/create', [UserManagementController::class, 'create'])->name('admin.create');
    Route::post('/store', [UserManagementController::class, 'store'])->name('admin.store');
    Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.edit');
    Route::put('/update/{id}', [UserManagementController::class, 'update'])->name('admin.update');
    Route::delete('/destroy/{id}', [UserManagementController::class, 'destroy'])->name('admin.destroy');

    // Donations
    Route::get('/donator-list', [UserManagementController::class, 'donatorList'])->name('donator.list');

    // Partners (read only)
    Route::get('/partners', [PartnerController::class, 'index'])->name('admin.partners.index');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/assign/{id}', [OrderController::class, 'assignRider'])->name('admin.orders.assign');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});
```

---

## Workflow

### Daily Tasks

1. Check pending orders → Assign drivers
2. Review donation activity
3. Handle user support requests
4. Monitor delivery progress

### Weekly Tasks

1. Review performance reports
2. Follow up on issues
3. Partner status check
