# Words Loader

This application allows you to load and save words from the Oxford Dictionaries API. It retrieves translations and examples of usage for specified topics and stores them in a database.

## Prerequisites

Before running this application, make sure you have the following installed on your system:

- PHP (version 7.4 or higher)
- Composer
- Docker
- Laravel Framework (version 8.x)

## Installation

1. Clone the repository to your local machine.

2. Navigate to the project directory.

3. Install the dependencies by running the following commands and create docker containers:

   ```
   composer install
   npm install
   docker-compose up -d
   ```
   
4. Copy the .env.example file and rename it to .env. 

5. Open the .env file and configure the database connection settings according to your environment. 
6. 
7. Run the database migrations to create the necessary tables:
    ```
    php artisan migrate
    ```
8. Run the database seeder:
   ```
   php artisan db:seed
   ```
