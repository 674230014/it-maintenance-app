# IT Maintenance App

A Laravel-based IT maintenance and repair management application for handling equipment issues, technician workflows, payment slips, and receipt generation.

## Overview

This project allows:
- Users to submit equipment repair requests
- Technicians/admins to review and manage repair tickets
- Repair statuses to be updated (pending, in progress, success, rejected)
- Repair costs and repair details to be recorded
- Payment slip upload and approval workflow
- Printable receipt generation after payment approval

The application includes:
- Login and registration
- Role-based redirection for admin/technician and general users
- Repair history and technician dashboard views
- File uploads for issue images and payment slips
- Laravel + Vite frontend setup

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL/SQLite database support
- Vite
- Tailwind CSS
- Composer + npm

## Project Structure

The main Laravel app is located under:

- `it-maintenance-app-main/`

Typical structure:
- `app/` — controllers, models, providers
- `config/` — Laravel configuration
- `database/migrations/` — database schema
- `public/` — public web assets
- `resources/` — views, CSS, and JS
- `routes/web.php` — app routes
- `tests/` — automated tests

## Features

### User Roles
- `user` — submit repair reports
- `admin` — technician/admin dashboard access

### Repair Workflow
- Create repair request with:
  - equipment code
  - equipment name
  - problem detail
  - urgency level
  - reporter name
  - issue image
- View repair history
- Update repair status and details
- Add service cost
- Upload payment slip
- Approve slip and print receipt

## Local Setup

1. Clone the repository
2. Navigate to the app directory:

```bash
cd it-maintenance-app-main
```

3. Install PHP dependencies:

```bash
composer install
```

4. Copy the environment file:

```bash
cp .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Configure your database in `.env` and then run migrations:

```bash
php artisan migrate
```

7. Install frontend dependencies:

```bash
npm install
```

8. Build the frontend assets:

```bash
npm run build
```

9. Start the app:

```bash
php artisan serve
```

Then open:

```text
http://localhost:8000
```

## Default Routes

- `/login` — login page
- `/register` — registration page
- `/technician/dashboard` — technician dashboard
- `/repair/create` — create repair request
- `/repair/history` — repair history
- `/repair/{repair}/receipt` — receipt page after payment approval

## Database

The app includes a `repairs` table with fields such as:
- equipment code
- equipment name
- problem detail
- urgency
- reporter name
- image path
- status
- repair details
- price
- slip path
- payment status

## Development Scripts

From the Laravel project root:

```bash
composer test
```

```bash
npm run dev
```

## License

This project is licensed under the MIT License.

## Notes

This application is designed as a maintenance workflow system for internal IT operations and can be extended with:
- authentication improvements
- PDF export
- role-based authorization policies
- admin notifications
- advanced reporting
