# Features Documentation

## Overview

Merry Meals adalah platform pengiriman makanan untuk program Meals on Wheels yang membantu lansia dan penyandang disabilitas.

---

## Public Features

### Homepage

- Landing page dengan informasi program
- Preview menu makanan
- Call-to-action untuk registrasi

### About Page

- Informasi tentang organisasi
- Misi dan visi program

### Contact Page

- Form kontak
- Informasi alamat dan telepon

### Blog

- Artikel dan berita seputar program
- Update kegiatan

### Donation System

- **Stripe Integration** - Pembayaran kartu kredit
- Form donasi dengan nama, email, jumlah
- Tracking donasi

---

## Member Features

### Dashboard

- Overview informasi member
- Status pesanan terkini
- Akses cepat ke fitur

### Order Meals

- **Browse Menu** - Lihat menu dari berbagai partner
- **Meal Details** - Deskripsi, bahan, gambar
- **Package Selection** - Pilih paket makanan
- **Temperature Preference** - Hot/Cold
- **Place Order** - Submit pesanan

### Order History

- Daftar pesanan sebelumnya
- Status tracking (pending, assigned, delivered)
- Detail pesanan

### Profile Management

- Edit informasi pribadi
- Update kontak
- Ubah password

### Survey Feedback

- Form 8 pertanyaan
- Rating overall
- Feedback untuk peningkatan layanan

---

## Partner Features

### Partner Dashboard

- Overview restaurant
- Statistik pesanan

### Meal Management

| Action     | Description                    |
| ---------- | ------------------------------ |
| **Create** | Tambah menu baru               |
| **Edit**   | Update detail menu             |
| **Delete** | Hapus menu                     |
| **Toggle** | Aktif/nonaktifkan ketersediaan |

### Meal Details

- Nama makanan
- Bahan-bahan (ingredients)
- Gambar
- Tipe makanan
- Deskripsi
- Status ketersediaan

### Profile Management

- Informasi restoran
- Alamat dan kontak
- Gambar restoran
- Tipe makanan yang disajikan

### Order Management

- Lihat pesanan masuk
- Status pesanan

---

## Rider/Volunteer Features

### Delivery Dashboard

- Pesanan yang di-assign
- Status delivery

### Order Assignment

- Terima assignment dari admin
- Update status delivery

### Delivery Tracking

- Mark as picked up
- Mark as delivered

---

## Admin Features

### User Management

- Kelola semua user
- Assign roles
- Deactivate accounts

### Partner Management

- Approve partner baru
- Manage restaurants

### Order Oversight

- Monitor semua pesanan
- Assign volunteer ke pesanan
- Handle issues

### Reports & Analytics

- Donation statistics
- Order statistics
- Survey results

---

## Technical Features

### Authentication

- **Registration** - Multi-role signup
- **Login/Logout** - Session management
- **Password Reset** - Email-based reset
- **Email Verification** - Verified email required

### Security

- CSRF Protection
- Password hashing (bcrypt)
- Role-based middleware
- Sanctum API tokens

### Payment

- Stripe integration via Laravel Cashier
- Secure payment processing
- Donation tracking

### Location

- Geolocation tracking
- Distance calculation for delivery
- Address management
