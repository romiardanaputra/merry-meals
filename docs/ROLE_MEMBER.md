# Role: Member

## Overview

Member adalah penerima manfaat utama platform Merry Meals - lansia dan penyandang disabilitas yang membutuhkan bantuan nutrisi.

---

## Permissions Matrix

| Permission         | Member | Notes           |
| ------------------ | :----: | --------------- |
| View Own Profile   |   ✅   | Edit allowed    |
| View Meals         |   ✅   | All available   |
| Place Orders       |   ✅   | Own orders only |
| View Order History |   ✅   | Own orders      |
| Submit Survey      |   ✅   | After delivery  |
| View Geolocation   |   ✅   | Own location    |
| View Other Users   |   ❌   | Privacy         |

---

## Features

### 1. Order History

- View past orders
- Order status tracking
- Delivery details
- Reorder functionality (proposed)

### 2. Browse Meals

- View available meals from partners
- Filter by diet type/restrictions
- Search functionality
- Partner information

### 3. Meal Details

- Full meal description
- Ingredients list
- Nutritional information (proposed)
- Allergen warnings
- Meal image gallery

### 4. Geolocation

- Set delivery address
- Update location
- Delivery instructions
- Access verification for drivers

### 5. Nutrition Tracking (Proposed)

- Daily intake log
- Nutritional goals
- Diet recommendations
- Health metrics dashboard

### 6. Survey Feedback

- Post-delivery surveys
- Rating system
- Improvement suggestions
- Driver feedback

---

## Proposed New Features

### Nutrition Dashboard

```
- Calorie tracking per meal
- Nutrient breakdown (protein, carbs, fats)
- Weekly/monthly summaries
- Diet preference settings
- Allergy alert system
```

### Health Integration

```
- Dietary restriction profiles
- Medical condition awareness
- Medication interaction warnings
- Care provider notes
```

### Accessibility Features

```
- Large font options
- High contrast mode
- Voice navigation (future)
- Simplified UI mode
```

---

## Dashboard Components

| Component         | Description              |
| ----------------- | ------------------------ |
| Next Delivery     | Upcoming order status    |
| Recent Orders     | Last 5 orders            |
| Favorites         | Frequently ordered meals |
| Nutrition Summary | Weekly intake (proposed) |
| Quick Order       | One-click reorder        |

---

## Routes

```php
// Current
Route::middleware('roles:member')->prefix('member')->group(function () {
    Route::get('/dashboard', [MemberManagementController::class, 'index'])->name('member.dashboard');
    Route::get('/survey', [MemberManagementController::class, 'surveyShow'])->name('member.survey');
    Route::post('/survey', [MemberManagementController::class, 'surveyStore'])->name('member.survey.store');
});

// Proposed additions
Route::middleware('roles:member')->prefix('member')->group(function () {
    // Order History
    Route::get('/orders', [MemberOrderController::class, 'index'])->name('member.orders');
    Route::get('/orders/{id}', [MemberOrderController::class, 'show'])->name('member.orders.show');

    // Nutrition (proposed)
    Route::get('/nutrition', [NutritionController::class, 'index'])->name('member.nutrition');
    Route::post('/nutrition/log', [NutritionController::class, 'log'])->name('member.nutrition.log');

    // Preferences
    Route::get('/preferences', [PreferenceController::class, 'edit'])->name('member.preferences');
    Route::put('/preferences', [PreferenceController::class, 'update'])->name('member.preferences.update');
});

// Shared meal routes (authenticated)
Route::name('meal.')->group(function () {
    Route::get('/menu', [MemberManagementController::class, 'menuMealShow'])->name('menu');
    Route::get('/meal/{id}', [MemberManagementController::class, 'menuDetailShow'])->name('detail');
    Route::get('/package/{id}', [MemberManagementController::class, 'packageFood'])->name('package');
});
```

---

## User Experience Considerations

### Accessibility

- Large, clear buttons
- Simple navigation
- Minimal steps to order
- Clear status indicators

### Safety

- Emergency contact option
- Welfare check system
- Easy cancellation
- Contact support button
