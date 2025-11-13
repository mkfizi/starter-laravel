# Starter Laravel.
Starter Kit for Laravel projects.

## Description
This Laravel starter kit serves as starting point when developing web applications or sites. It comes with built-in Authentication, Notification, Role Permissions and User Management modules.

### Preconfigured Library
|Modules |Library |
|--------|--------|
|Authentication | [Laravel Fortify](https://laravel.com/docs/12.x/fortify) |

## Installation
Clone this repository to get started.

Run the following commands in project directory to install dependencies, generate env key and setup database.
```bash
npm install
composer install
php artisan key:generate
php artisan migrate
```

Run one of the following commands to execute or build site using Vite server:
```bash
npm run dev
npm run build
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](https://github.com/mkfizi/starter-laravel/blob/main/LICENSE)