## Introduction
This is a Laravel framework based Editor/Writer dashboard implementation. Data is stored using `sqlite`. Front-end uses Blade templates with `vite`.

## Setup
Install the dependecies for both the `php` and `vite` libraries. You need to have `composer` and `npm` in your local development environment.
```bash
composer install
npm install
```

## Deployment 
For first-time deployment, execute the following commands.
```bash
php artisan storage:link
php artisan migrate:fresh
php artisan db:seed
```

Before deploying, execute the following command to build the front-end files.
```bash
npm run build
```
To start the server, run the following command.
```bash
php artisan serve
```

To view live updates on the front-end files, you can run this command on a separate terminal instead.
```bash
npm run dev
```

## Users
The default editor has the following credentials:
```bash
email: default.editor@example.com
password: password
```

The default writers has the following credentials:
```bash
email: default.writer@example.com
password: password
```

## Live
Live deployment available in https://archintel.lambdasys.dev/.