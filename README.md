# 🎮 GameHub - Laravel Gaming API

A modern, feature-rich gaming API built with Laravel, featuring a sleek gaming-themed UI with neon colors, glassmorphism effects, and Steam integration.

## ✨ Features

### 🎯 Core Features
- **Modern Gaming UI** - Dark theme with neon colors and glassmorphism effects
- **Game Management** - Complete CRUD operations for games, publishers, developers
- **Steam Integration** - Search and import games from Steam
- **User Management** - Authentication and user administration
- **Advanced Search** - Filter games by genre, platform, and search terms
- **Reviews System** - User reviews and ratings for games
- **RESTful API** - Complete API endpoints for all features

### 🎨 UI/UX Features
- **Gaming Theme** - Custom dark theme with neon accents
- **Responsive Design** - Mobile-friendly responsive layout
- **Interactive Elements** - Hover effects and smooth animations
- **Modern Components** - Cards, buttons, and forms with gaming aesthetics
- **Glass Effects** - Glassmorphism design throughout the interface

### 🔧 Technical Features
- **Laravel 11** - Latest Laravel framework
- **MySQL Database** - Robust relational database design
- **API Documentation** - Built-in API documentation page
- **Error Handling** - Comprehensive error handling and validation
- **Caching** - Optimized performance with caching
- **Security** - Authentication and authorization

## 🚀 Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js (for frontend assets)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/gamehub-laravel-api.git
   cd gamehub-laravel-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   ```bash
   # Edit .env file with your database credentials
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gaming_api
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

## 📱 Usage

### Web Interface
- **Homepage**: `http://localhost:8000` - Gaming-themed landing page
- **Dashboard**: `http://localhost:8000/dashboard` - Command center with stats
- **Games**: `http://localhost:8000/games` - Browse and search games
- **Steam Search**: `http://localhost:8000/steam/search` - Search Steam games
- **Users**: `http://localhost:8000/users` - User management (requires auth)
- **API Docs**: `http://localhost:8000/docs` - Complete API documentation

### API Endpoints
- **Games**: `GET /api/games`, `POST /api/games`, `GET /api/games/{id}`
- **Users**: `GET /api/users`, `POST /api/users`, `PUT /api/users/{id}`
- **Publishers**: `GET /api/publishers`, `POST /api/publishers`
- **Developers**: `GET /api/developers`, `POST /api/developers`
- **Reviews**: `GET /api/reviews`, `POST /api/reviews`

## 🎮 Features Overview

### Game Management
- Create, read, update, delete games
- Upload game images and metadata
- Assign publishers, developers, genres, platforms
- Steam integration for automatic game import

### User System
- User registration and authentication
- User profiles and preferences
- Admin user management interface
- Role-based permissions

### Steam Integration
- Search Steam's game library
- Import game data automatically
- Popular games discovery
- Real-time Steam API integration

### Advanced Search
- Full-text search across game titles and descriptions
- Filter by genre (Action, RPG, Sports, etc.)
- Filter by platform (PS5, Xbox, Nintendo Switch, etc.)
- Pagination and sorting options

## 🛠️ Technology Stack

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade templates, Bootstrap 5, Custom CSS
- **Database**: MySQL with Eloquent ORM
- **Authentication**: Laravel Sanctum
- **API**: RESTful API with JSON responses
- **External APIs**: Steam Web API integration
- **Styling**: Custom gaming theme with neon colors

## 📊 Database Schema

### Core Tables
- `games` - Game information and metadata
- `users` - User accounts and authentication
- `publishers` - Game publishers
- `developers` - Game developers
- `genres` - Game genres/categories
- `platforms` - Gaming platforms
- `reviews` - User reviews and ratings

### Relationships
- Games have many-to-many relationships with developers, genres, platforms
- Games belong to publishers
- Users can have many reviews
- Reviews belong to games and users

## 🎨 UI Themes

### Gaming Aesthetic
- **Primary Colors**: Neon cyan (#00ffff), neon purple (#ff00ff)
- **Background**: Dark theme with gradients
- **Effects**: Glassmorphism, hover animations, glow effects
- **Typography**: Gaming-style fonts and tech aesthetics
- **Components**: Custom styled cards, buttons, and forms

## 🔌 API Integration

### Steam Web API
- Automatic game data import
- Search functionality
- Popular games discovery
- Game metadata synchronization

### Custom API
- Complete RESTful API
- JSON responses
- Authentication support
- Comprehensive error handling

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure production database
3. Run `php artisan config:cache`
4. Set up web server (Apache/Nginx)
5. Configure SSL certificates

### Environment Variables
- `APP_URL` - Application URL
- `DB_*` - Database configuration
- `STEAM_API_KEY` - Steam Web API key (optional)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🎯 Future Enhancements

- [ ] Advanced user profiles
- [ ] Game wishlists
- [ ] Social features (friends, sharing)
- [ ] Game recommendations
- [ ] Mobile app API
- [ ] Real-time notifications
- [ ] Enhanced Steam integration
- [ ] Game statistics and analytics

## 📞 Support

For support, please open an issue on GitHub or contact the development team.

---

**Built with ❤️ for gamers by gamers**
