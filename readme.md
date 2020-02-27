## How to Install and Test

1. Clone the repository from: https://github.com/kevincho7/weatherapi

2. Inside your clonned local project folder, run composer install.

3. Edit the .env.example appropriately with your environment variables and rename it to .env file.

4. Run php artisan serve

5. You can test this api with this endpoint with the http get method: /api/v1/wind/{zipcode}