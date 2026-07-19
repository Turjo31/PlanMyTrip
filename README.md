# PlanMyTrip - Travel Planning System

A full-stack travel planning web application built with Laravel 12 and MySQL. Users can create and manage personal trip plans, track budgets, explore destination information, and share travel stories with a community of fellow travelers.

---

## Features

- User registration, login, and logout with role-based access control
- Full trip CRUD — create, view, edit, and delete trips with destination, dates, budget, and status
- Place management — add places to visit within each trip with estimated costs
- Budget tracking — compare estimated vs total budget with a visual progress bar
- Live weather fetched asynchronously via JavaScript using OpenWeatherMap API
- Nearby tourist attractions fetched asynchronously via JavaScript using Geoapify Places API
- Destination info (country, city, timezone, currency) via Geoapify Geocoding API
- Community feed — users can share and read travel stories
- Site-wide announcements managed by admin
- PDF export — download a full trip summary as a PDF file
- Admin panel — manage users (activate/deactivate) and announcements, view site statistics
- Dark mode with localStorage persistence
- Last login tracking via sessions and cookies
- About page with contact form

---

## Tech Stack

- Backend: Laravel 12 (PHP 8.2)
- Database: MySQL via XAMPP
- Frontend: Blade templating, Bootstrap 5
- Icons: Tabler Icons
- Fonts: Bebas Neue, Inter (Google Fonts)
- PDF: barryvdh/laravel-dompdf
- APIs: OpenWeatherMap, Geoapify

---

## Installation

1. Clone the repository

```bash
git clone https://github.com/Turjo31/PlanMyTrip.git
cd PlanMyTrip
```

2. Install dependencies

```bash
composer install
npm install
```

3. Copy the environment file and generate app key

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure `.env` with your database and API keys

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=planmytrip
DB_USERNAME=root
DB_PASSWORD=

OPENWEATHER_API_KEY=your_openweathermap_key
GEOAPIFY_API_KEY=your_geoapify_key
```

5. Run migrations

```bash
php artisan migrate
```

6. Create an admin user via Tinker

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@planmytrip.com',
    'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
    'role' => 'admin',
    'is_active' => true,
]);
```

7. Start the development server

```bash
php artisan serve
```

Visit `http://localhost:8000`

---

## API Keys

- OpenWeatherMap: https://openweathermap.org/api (free tier)
- Geoapify: https://myprojects.geoapify.com (free tier, 3000 requests/day)

---

## Developer

Name: Sabyasachi Sadhu Turjo
Roll: 2207093
Department: Computer Science and Engineering, KUET
Email: ssturjo.2003@gmail.com
GitHub: https://github.com/Turjo31

---

## Course

Web Programming Lab
CSE 3rd Year, 1st Semester
Khulna University of Engineering and Technology