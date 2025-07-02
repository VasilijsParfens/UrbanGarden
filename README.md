# UrbanGarden

UrbanGarden is a Laravel-based social networking platform for houseplant enthusiasts. Users can manage and showcase their personal plant collections, follow other plant lovers, and browse a shared plant database.

## Features
- User authentication and profile management
- Plant database with details such as sunlight and watering needs
- Three plant collections: "Plants I Have", "Plants I Had", and "Plants I Want"
- Ability to follow other users and view their collections
- Admin panel for managing plants and users

## Screenshots
![Home Page](screenshots/homepage.png)
![Plant Details](screenshots/plant_details.png)
![Profile Page](screenshots/profile.png)

## Tech Stack
- Backend: Laravel (PHP)
- Frontend: Blade Templates, HTML, CSS
- Database: MySQL

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/VasilijsParfens/UrbanGarden.git
   cd UrbanGarden
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Copy and configure the environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Set up your database in `.env`:
   ```env
   DB_DATABASE=urban_garden
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Serve the application:
   ```bash
   php artisan serve
   ```

## Contributing
Contributions are welcome! If you find a bug or want to add a feature:
- Fork the repo
- Create a feature branch
- Submit a pull request
