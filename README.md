# Future Care Network — Laravel Application
## Complete Setup Instructions

---

## Prerequisites

Install these before starting:
- **PHP 8.2+** — https://www.php.net/downloads
- **Composer** — https://getcomposer.org/download/
- **MySQL 8.0+** — https://dev.mysql.com/downloads/
- **Node.js** (optional, for assets) — https://nodejs.org

---

## Step 1 — Clone / Extract Project

```bash
unzip fcn-laravel.zip
cd fcn-laravel
```

---

## Step 2 — Install PHP Dependencies

```bash
composer install
```

---

## Step 3 — Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

---

## Step 4 — Database Setup

### Create the MySQL database:
```sql
CREATE DATABASE fcn_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Update your .env file:
```
DB_DATABASE=fcn_platform
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

## Step 5 — Run Migrations & Seed Data

```bash
php artisan migrate
php artisan db:seed
```

This creates all tables and adds:
- Admin user account
- 8 sample families
- 5 sample educators
- 2 sample matches

---

## Step 6 — Start the Server

```bash
php artisan serve
```

Open your browser: **http://localhost:8000**

---

## Step 7 — Login to Admin

URL: **http://localhost:8000/admin/login**

```
Email:    admin@futurecareproject.com.au
Password: Admin@FCN2026
```

---

## Application URLs

| Page | URL |
|------|-----|
| Home / Landing | http://localhost:8000 |
| Family Registration | http://localhost:8000/family-register |
| Educator Registration | http://localhost:8000/educator-register |
| Admin Login | http://localhost:8000/admin/login |
| Admin Dashboard | http://localhost:8000/admin/dashboard |
| Admin Families | http://localhost:8000/admin/families |
| Admin Educators | http://localhost:8000/admin/educators |
| Admin Matches | http://localhost:8000/admin/matches |

---

## Features

### Public Pages
- Professional landing page with problem statement and statistics
- Family registration form with full validation and reference number
- Educator registration form with Blue Card and qualifications tracking

### Admin Dashboard
- KPI cards: Total families, educators, matches, waitlisted
- Bar chart: Monthly registrations (families vs educators)
- Donut chart: Care type demand breakdown
- Regional demand table: Top postcodes by family count
- Recent families and Blue Card compliance tables

### Admin Management
- View all families with search and status filter
- View all educators with Blue Card expiry highlighting
- Update status (pending / matched / waitlisted / verified)
- Delete records
- Auto-matching algorithm based on postcode + care type

### Matching System
- Click "Run Auto-Matching" on the Matches page
- System automatically matches pending families with verified educators
- Matching criteria: same postcode + matching care type
- Unmatched families are marked as waitlisted

---

## Database Structure

```
families        — family registrations with care preferences
educators       — educator profiles with qualifications and compliance
users           — admin accounts
matches         — family-educator pairs with status
```

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 11 (PHP 8.2) |
| Database | MySQL 8.0 |
| Frontend | Bootstrap 5.3 + Chart.js 4 |
| Auth | Laravel built-in auth middleware |
| Icons | Bootstrap Icons |
| Fonts | Google Fonts (Inter) |

---

## Troubleshooting

**500 Server Error:**
```bash
php artisan config:clear
php artisan cache:clear
chmod -R 775 storage bootstrap/cache
```

**Database connection error:**
- Check .env DB_USERNAME and DB_PASSWORD
- Ensure MySQL is running
- Confirm database `fcn_platform` exists

**Migrations fail:**
```bash
php artisan migrate:fresh --seed
```

---

## Team

Built by **Agile Avengers** — CSC6200 Advanced ICT Professional Project  
University of Southern Queensland, Trimester 1, 2026

| Member | Role |
|--------|------|
| Vaidehi Sunilkumar Modi | Systems Analyst |
| Pradip Dhakal | Backend Developer|
| Vedant Patel | Software Architect |
| Shreya Shridhar Jadhav | Data & Analytics Specialist |

**Client:** Angela Cochrane, Future Care Network  
**Supervisor:** Dr Aqeel Sahi  
**Course Coordinator:** Dr Ignacio Zapata
