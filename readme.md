## About App

A simple Laravel web application to pull and display top 10 images from Instagram using their API.

## Getting Started
Begin by cloning the repository:
git clone https://github.com/gndlovu/instagram.git
cd path/to/instagram/dir

Use composer to get dependencies:
`composer install`

## Configurations

cd path/to/instagram/dir
cp .env.example .env

Open .env and provide values on below variables:

INSTAGRAM_CALBACK_URL=http://localhost:8000/instagram/callback
INSTAGRAM_CLIENT_ID=**** Your Instagram Client ID
INSTAGRAM_CLIENT_SECRET=**** Your Instagram Client Secret

## Development server

Run `php artisan serve` for a dev server. Navigate to `http://localhost:8000`. The app will automatically redirect to instagram to get authorization.

Once you authorize, you should get 10 most recent instagram images.