# Movie Collection Project

## Installation

### Composer
Run `composer install` to pull in all dependencies

### Configuration
1. In the project root dir, copy the `.env.example` file to `.env`
2. The app is configured to write to a SQLite file in `storage/db.sqlite`.
 Edit your `.env` file set the full path to this sqlite file:
`DB_DATABASE=/full_path_to_project_root/storage/db.sqlite`
In the future if you wanted to use something like MySQL or SQL Server all you'd have to do is update the db settings in the config file and then run the db migration scripts.
3. Create a new app key. This should generate the key and save it to your `.env` file:
    ```
    php artisan key:generate
    ```

### Web Server
You can either serve the app either by:
1. Starting a local development server at http://localhost:8000.
From the project root directory, run:
    ```
    php artisan serve
    ```
2. Using Apache or Nginx:
* Configure your web server's document root to be the /public directory. 
* All files and directories within the `/storage` and the `/bootstrap/cache` directories should be made writable by your web server.

### Data
If you ever want to reset the SQLite file to a pristine state, run this from the project root directory:
```
php artisan migrate:refresh
```

If you want to seed the SQLite file with test data:
```
php artisan db:seed
```

## Testing
The unit and application tests are configured to run against an in-memory sqlite db so it won't have any effect on data in the sqlite file.

Run the tests from project root dir with:
```
./vendor/bin/phpunit
```
