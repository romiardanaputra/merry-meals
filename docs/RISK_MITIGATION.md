# Merry Meals - Risk Mitigation & Analysis

## Platform Overview

Merry Meals adalah platform charity Meals on Wheels yang menghubungkan:

- **Member** (lansia/penyandang disabilitas)
- **Partner** (restoran/dapur)
- **Driver** (volunteer)
- **Admin** (pengelola)

Sebagai platform charity, ada risiko unik yang perlu dimitigasi.

---

## Risk Categories

### 1. 🔴 Critical Risks

#### R1. Food Safety & Quality

| Aspect        | Risk                           | Impact   | Probability |
| ------------- | ------------------------------ | -------- | ----------- |
| Temperature   | Makanan tidak dijaga suhu      | High     | Medium      |
| Freshness     | Makanan basi saat sampai       | High     | Low         |
| Allergens     | Member alergi tidak terdeteksi | Critical | Medium      |
| Contamination | Kontaminasi selama transit     | High     | Low         |

**Proposed Solutions:**

1. **Temperature Tracking**

   - Tambah field `temperatureCheck` pada Order
   - Driver wajib input suhu saat pickup
   - Alert jika suhu di luar range aman

2. **Allergy Management**

   - Tambah `allergies` field pada Member profile
   - Tampilkan warning saat order meal dengan alergen
   - Partner wajib list semua ingredients

3. **Delivery Time Limit**
   - Max 45 menit dari pickup ke delivery
   - Auto-alert admin jika melebihi batas
   - Priority routing untuk makanan panas

```php
// Proposed: Order model enhancement
protected $fillable = [
    // ... existing
    'pickupTemperature',
    'deliveryTemperature',
    'pickupTime',
    'deliveryTime',
    'maxDeliveryMinutes'
];
```

---

#### R2. Volunteer Driver Reliability

| Aspect        | Risk                  | Impact   | Probability |
| ------------- | --------------------- | -------- | ----------- |
| No-show       | Driver tidak datang   | High     | Medium      |
| Late delivery | Terlambat signifikan  | Medium   | High        |
| Misconduct    | Perilaku tidak pantas | Critical | Low         |

**Proposed Solutions:**

1. **Driver Verification**

   - Background check requirement
   - ID verification saat registrasi
   - Training completion badge

2. **Backup Driver System**

   - Auto-assign backup jika driver tidak response 10 menit
   - Multiple driver pool per area
   - Driver rating system

3. **Real-time Tracking**
   - GPS tracking selama delivery
   - Check-in points (pickup, arrived)
   - Member confirmation button

```php
// Proposed: Driver metrics
class DriverMetric extends Model {
    protected $fillable = [
        'userID',
        'totalDeliveries',
        'onTimeRate',
        'avgDeliveryTime',
        'memberRating',
        'lastActiveAt',
        'verificationStatus'
    ];
}
```

---

### 2. 🟠 High Risks

#### R3. Member Safety & Accessibility

| Aspect            | Risk                         | Impact   | Probability |
| ----------------- | ---------------------------- | -------- | ----------- |
| Wrong address     | Delivery ke alamat salah     | Medium   | Medium      |
| Unable to receive | Member tidak bisa buka pintu | Medium   | High        |
| Medical emergency | Kondisi darurat member       | Critical | Low         |

**Proposed Solutions:**

1. **Enhanced Geolocation**

   - Address verification dengan maps
   - Delivery instructions field
   - Alternative contact person

2. **Accessibility Features**

   - Special instructions untuk member berkebutuhan khusus
   - Photo proof of delivery
   - Leave at door option

3. **Welfare Check**
   - Driver report jika member tidak merespon
   - Auto-notify admin untuk follow-up
   - Emergency contact system

---

#### R4. Partner Kitchen Compliance

| Aspect   | Risk                           | Impact | Probability |
| -------- | ------------------------------ | ------ | ----------- |
| Hygiene  | Standar kebersihan rendah      | High   | Medium      |
| Capacity | Tidak bisa penuhi order volume | Medium | Medium      |
| Closure  | Partner tutup mendadak         | Medium | Low         |

**Proposed Solutions:**

1. **Partner Verification**

   - Food license requirement
   - Regular audit system
   - Hygiene certification

2. **Capacity Management**
   - Daily meal limit per partner
   - Real-time availability toggle
   - Auto-disable jika overload

```php
// Proposed: Partner model enhancement
protected $fillable = [
    // ... existing
    'dailyMealLimit',
    'currentDailyOrders',
    'hygieneCertificate',
    'licenseNumber',
    'lastAuditDate',
    'complianceStatus'
];
```

---

### 3. 🟡 Medium Risks

#### R5. Donation Fraud

| Aspect         | Risk                     | Impact | Probability |
| -------------- | ------------------------ | ------ | ----------- |
| Fake donations | Transaksi fraudulent     | Medium | Low         |
| Misuse         | Dana tidak tepat sasaran | High   | Low         |

**Proposed Solutions:**

1. **Stripe Verification** - Already implemented
2. **Donation Transparency**
   - Public donation ledger
   - Monthly impact reports
   - Donor dashboard with meal count

---

#### R6. Data Privacy

| Aspect        | Risk                   | Impact | Probability |
| ------------- | ---------------------- | ------ | ----------- |
| Member data   | Sensitive info exposed | High   | Low         |
| Location data | Tracking info leaked   | Medium | Low         |

**Proposed Solutions:**

1. **Data Minimization**

   - Only collect necessary data
   - Driver sees limited member info
   - Auto-delete old geolocation

2. **Access Control** - Already implemented via Roles middleware

---

## Proposed Implementation Priority

### Phase 1: Critical (Week 1-2)

| Item                | Description         | Effort |
| ------------------- | ------------------- | ------ |
| Allergy field       | Add to Member model | Low    |
| Temperature log     | Add to Order flow   | Medium |
| Driver verification | Status field + UI   | Medium |

### Phase 2: High (Week 3-4)

| Item                   | Description                | Effort |
| ---------------------- | -------------------------- | ------ |
| Delivery time tracking | Pickup/delivery timestamps | Medium |
| Backup driver system   | Auto-reassignment logic    | High   |
| Partner compliance     | Audit fields + dashboard   | Medium |

### Phase 3: Medium (Week 5-6)

| Item                  | Description          | Effort |
| --------------------- | -------------------- | ------ |
| Welfare check         | Driver report system | Medium |
| Donation transparency | Public ledger page   | Low    |
| Enhanced geolocation  | Map integration      | High   |

---

## Monitoring & Metrics

### Key Performance Indicators

| KPI                   | Target      | Alert Threshold |
| --------------------- | ----------- | --------------- |
| On-time delivery rate | >95%        | <90%            |
| Average delivery time | <40 min     | >50 min         |
| Driver availability   | >3 per area | <2 per area     |
| Partner compliance    | 100%        | <95%            |
| Member satisfaction   | >4.5/5      | <4.0/5          |

### Dashboard Widgets (Proposed)

1. **Real-time Order Status** - Map view dengan active orders
2. **Driver Availability** - Heat map per area
3. **Alert Panel** - Overdue deliveries, compliance issues
4. **Weekly Trends** - Order volume, response times

---

## Emergency Procedures

### Scenario 1: Driver No-Show

```
1. System detects no pickup after 15 min
2. Auto-notify backup driver pool
3. Alert admin dashboard
4. Notify member of delay
5. Escalate to partner if needed
```

### Scenario 2: Food Quality Complaint

```
1. Member reports via survey/contact
2. Admin reviews order history
3. Partner notified for investigation
4. Member offered replacement/credit
5. Partner flagged for audit if repeated
```

### Scenario 3: Member Emergency

```
1. Driver reports unresponsive member
2. System notifies emergency contact
3. Admin attempts phone contact
4. Escalate to local authorities if needed
5. Log incident for follow-up
```

---

## Compliance Checklist

- [ ] Food safety regulations compliance
- [ ] Data protection (GDPR-like) compliance
- [ ] Volunteer management guidelines
- [ ] Insurance coverage for volunteers
- [ ] Partner restaurant licensing
- [ ] Accessibility standards (WCAG)
