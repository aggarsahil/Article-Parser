# Articles Parser UI

A full-stack project that scrapes articles from BeyondChats, stores them in a Laravel backend, and displays them in a React frontend.

## Project Structure

articles-parser-ui/
├── backend/ # Laravel backend
│ ├── app/
│ ├── routes/
│ ├── database/
│ ├── public/
│ └── ...
├── frontend/ # React frontend
│ ├── public/
│ ├── src/
│ ├── package.json
│ └── ...
├── .env
├── README.md
└── ...





## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL or SQLite
- Node.js 18 or higher
- npm

## Setup

### 1. Clone the Repository

git clone https://github.com/aggarsahil/article-parser.git
cd articles-parser-ui





### 2. Backend Setup (Laravel)

#### Install Dependencies

cd backend
composer install





#### Configure Environment

- Copy `.env.example` to `.env`:

cp .env.example .env





- Update `.env` with your database settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=beyond_blogs
DB_USERNAME=root
DB_PASSWORD=





#### Create Database

- Create a database named `beyond_blogs` in MySQL.
- Run migrations:

php artisan migrate





#### Run Artisan Command (Scrape Articles)

- Run the scraper command:

php artisan scrape:beyondchats





#### Start Laravel Server

php artisan serve





### 3. Frontend Setup (React)

#### Install Dependencies

cd ../frontend
npm install





#### Configure API URL

- Update the API base URL in `src/api.ts`:

const api = axios.create({
baseURL: 'http://127.0.0.1:8000/api',
});





#### Start React Server

npm run dev





## Usage

- Laravel backend: `http://127.0.0.1:8000`
- React frontend: `http://127.0.0.1:5173` (or as per your Vite config)

## Deployment

### Deploy Laravel Backend

- Use a PHP hosting provider (e.g., Hostinger, SiteGround, DigitalOcean App Platform, Render).
- Upload backend files.
- Set up environment variables.
- Run `composer install` and `php artisan migrate`.

### Deploy React Frontend

- Build the React app:

npm run build





- Copy the built files to Laravel’s `public` folder.
- Serve Laravel as the main server.

## Contributing

- Fork the repository.
- Create a new branch for your feature.
- Submit a pull request.

## License

MIT

---

For more details, check the documentation in each project folder.
