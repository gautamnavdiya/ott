# OTT Platform - Modern Streaming Application

A premium OTT (Over-The-Top) streaming platform built with Laravel, React, TypeScript, and TailwindCSS. This application provides a Netflix/Amazon Prime-like experience with modern UI, smooth animations, and a comprehensive feature set.

## 🚀 Features

### User Features
- ✅ User registration and login (email, phone, Google/social media)
- ✅ Profile management (multiple profiles per account)
- ✅ Subscription plans and renewal
- ✅ Content browsing by genre, language, and release year
- ✅ Search & filter options
- ✅ Watchlist / Favourites
- ✅ Continue watching section
- ✅ Multi-language subtitles & audio
- ✅ Video playback controls
- ✅ User ratings & reviews
- ✅ AI-based content recommendations
- ✅ Parental controls
- ✅ Notifications for new releases
- ✅ Dark mode interface

### Admin Features
- Admin dashboard for platform management
- Content upload and scheduling system
- Category and genre management
- User management (ban, edit, subscription tracking)
- Analytics dashboard (views, watch time, engagement)
- Payment and transaction reports
- Ad management system
- Push notification control panel
- CMS for managing movies and shows
- Multi-admin access with role-based permissions

## 🛠️ Tech Stack

- **Backend**: Laravel 9
- **Frontend**: React 18 + TypeScript
- **UI Framework**: TailwindCSS
- **State Management**: Inertia.js
- **Build Tool**: Vite
- **Icons**: Heroicons

## 📋 Prerequisites

- PHP >= 8.0.2
- Composer
- Node.js >= 16.x
- npm or yarn
- MySQL/PostgreSQL
- XAMPP/WAMP (for local development)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ott
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   Edit `.env` file and update database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ott_platform
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Build Assets**
   ```bash
   npm run dev
   # Or for production
   npm run build
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Access the application at `http://localhost:8000`

## 🎨 Project Structure

```
ott/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   └── DashboardController.php
│   │   └── Middleware/
│   │       └── HandleInertiaRequests.php
│   └── Models/
│       └── User.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── Components/
│   │   │   ├── Button.tsx
│   │   │   ├── Input.tsx
│   │   │   └── AuthLayout.tsx
│   │   ├── Pages/
│   │   │   ├── Auth/
│   │   │   │   ├── Login.tsx
│   │   │   │   └── Register.tsx
│   │   │   └── Dashboard.tsx
│   │   ├── app.tsx
│   │   └── types/
│   │       └── global.d.ts
│   └── views/
│       └── app.blade.php
├── routes/
│   └── web.php
└── database/
    └── migrations/
        └── 2014_10_12_000000_create_users_table.php
```

## 🎯 Usage

### Authentication

1. **Register**: Navigate to `/register` and create an account using email or phone number
2. **Login**: Navigate to `/login` and sign in with your credentials
3. **Social Login**: Click on Google or Facebook buttons for OAuth login (to be implemented)

### Dashboard

After login, you'll be redirected to the dashboard where you can:
- Browse featured content
- View continue watching section
- Explore trending content
- Access personalized recommendations

## 🔧 Development

### Running in Development Mode

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev
```

### Building for Production

```bash
npm run build
php artisan optimize
```

## 📝 Next Steps

- [ ] Implement Google OAuth
- [ ] Add video player component
- [ ] Create content management system
- [ ] Implement subscription plans
- [ ] Add payment gateway integration
- [ ] Create admin panel
- [ ] Add search and filter functionality
- [ ] Implement watchlist feature
- [ ] Add user profiles
- [ ] Create content recommendation system

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Built with ❤️ using Laravel and React
