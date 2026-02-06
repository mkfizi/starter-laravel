# Starter Laravel.
Starter Kit for Laravel projects.

## Description
This Laravel starter kit serves as starting point when developing web applications or sites. It comes with built-in Authentication, Notification, Role Permissions and User Management modules.

## Preconfigured Library
|Modules |Library |
|--------|--------|
|Authentication | [Laravel Fortify](https://laravel.com/docs/12.x/fortify) |
|Roles & Permission | [Spatie Laravel Permissions](https://spatie.be/docs/laravel-permission/v6/introduction)|
|Activity Log | [Spatie Laravel Activity Log](https://spatie.be/docs/laravel-activitylog/v4/introduction) |
|Frontend | [Alpine.js](https://alpinejs.dev/) + [Tailwind CSS](https://tailwindcss.com/) |
|Testing | [Pest PHP](https://pestphp.com/) |

## Features

### Authentication & Security
- **User Registration** - Complete user registration system with validation
- **Login/Logout** - Secure authentication with failed login tracking
- **Password Reset** - Email-based password recovery system
- **Email Verification** - Email confirmation required for new accounts
- **Two-Factor Authentication** - Optional 2FA with QR code generation and recovery codes
- **Password Confirmation** - Sensitive actions require password re-confirmation
- **Forced Password Change** - Users can be required to change password on next login
- **Activity Logging** - Tracks all authentication events (login, logout, failed attempts)
- **Rate Limiting** - Throttling for login and 2FA attempts to prevent brute force attacks

### User Management
- **User CRUD Operations** - Create, read, update, and delete users with permission checks
- **Profile Management** - Users can view and update their own profile information
- **Password Management** - Users can change their passwords with validation
- **Account Settings** - Dedicated settings pages for account, password, and 2FA management
- **Account Deletion** - Users can delete their own accounts with confirmation
- **Session History** - Track and view all user login sessions with device/browser information

### Roles & Permissions
- **Custom Role System** - Create and manage roles with ULID identifiers
- **Permission Assignment** - Assign specific permissions to roles
- **Role Management** - Full CRUD operations for roles with permission checks
- **Permission Middleware** - Route protection based on user permissions
- **Dashboard Admin Access** - Special permissions for administrative sections

### Audit & Logging
- **Activity Log** - Comprehensive logging of all user actions and system events
- **Session History** - Records login sessions with IP address, user agent, and device information
- **Failed Login Tracking** - Logs failed authentication attempts for security monitoring
- **User Agent Detection** - Parses and displays device, browser, and OS information

### Notifications
- **New User Credentials** - Automated email with temporary credentials for new users
- **Password Updated** - Notification sent when user password is changed
- **Mail Configuration** - Pre-configured mail settings for notifications

### Configuration
- **Custom Routes Config** - Centralized `config/routes.php` file for managing navigation menus with support for icons, active states, and nested items
- **Separate Route Groups** - Organized web and dashboard routes with dedicated navigation structures for public and authenticated areas
- **Permission-Based Navigation** - Automatic menu visibility control based on user permissions defined in route configuration
- **Custom App Config** - Extended `config/app.php` with additional settings:
  - `app.metadata` - Application metadata including description for SEO
  - `app.super_admin` - Super admin email address with unrestricted access
  - `app.error_send` - Toggle for sending error notifications via email
  - `app.error_email` - Email address to receive error notifications

### Localization
- **Multi-Language Support** - Built-in support for English (en) and Malay (ms) languages
- **Hybrid Storage Approach** - Guest preferences stored in session, authenticated users in database for cross-device persistence
- **SetLocale Middleware** - Automatically detects and sets user locale with priority: URL parameter > Session/User preference > Browser language > Default
- **Centralized Translations** - Organized translation files in `lang/` directory:
  - `lang/ms.json` - JSON translation file with 220+ keys organized by file/folder structure
  - `lang/ms/*.php` - Standard Laravel translation files (auth, passwords, pagination, validation)
- **Language Switcher Component** - Form-based language menu with SSR support and preference persistence
- **Database Integration** - User locale stored in `users` table and automatically synced on language change
- **All User-Facing Text Localized** - Controllers, views, components, and navigation menus fully localized

### UI Components & Layouts
- **Responsive Layouts** - Multiple dashboard layouts (collapse, stacked)
- **Reusable Components** - 60+ pre-built Blade components including:
  - Buttons (primary, secondary, outline, ghost, link, danger, success)
  - Forms (input, textarea, select, checkbox, radio, password, search)
  - Cards, Modals, Offcanvas, Dropdowns
  - Tables with sortable columns
  - Alerts, Badges, Tooltips
  - Navigation (sidebar, links, titles, collapse)
  - Typography (headings, display text, paragraphs)
  - Icons, Dividers, Pagination
  - Dark mode toggle menu
- **Authentication Views** - Pre-styled login, register, password reset pages
- **Dashboard Views** - Admin panel with user, role, and audit management interfaces

### Frontend Stack
- **Alpine.js** - Lightweight JavaScript framework with official plugins:
  - @alpinejs/anchor - Anchor positioning
  - @alpinejs/focus - Focus management
  - @alpinejs/persist - Persistent state across page loads
- **Tailwind CSS v4** - Latest utility-first CSS framework
- **Vite** - Modern build tool for fast development

### Developer Tools
- **Pest PHP** - Modern testing framework for PHP
- **Laravel Pint** - Opinionated code formatter
- **Laravel Pail** - Real-time log viewing in terminal
- **Composer Scripts** - Pre-configured setup, dev, and test commands
- **Concurrently** - Run multiple dev servers simultaneously (Laravel, queue, logs, Vite)

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