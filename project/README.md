# Mall of the North - Find the Bananas

Laravel 10 mobile-first competition web application for the Mall of the North banana QR clue hunt campaign.

## Overview

Players register, log in, scan store QR codes, receive clues for the next location, and track progress until they complete the hunt.

The project is built with:

- Laravel 10
- PHP 8.2+
- Blade templates
- MySQL
- Bootstrap 5
- JavaScript + jQuery
- Vite

The frontend is intentionally simple and does not use Vue, React, or Livewire.

## Project Paths

- Project root: `C:\xampp\htdocs\gabrielWork\fgx\moa\project`
- Design references: `C:\xampp\htdocs\gabrielWork\fgx\moa\assets\screens`
- Campaign assets: `C:\xampp\htdocs\gabrielWork\fgx\moa\elements`

## Core Features

- Landing screen and registration flow
- Player login flow
- Player password reset flow using email + cellphone verification
- Session-based player access to the game
- Admin login and entries export
- QR-based store progression
- Progress tracker and completion screen
- Terms & Conditions placeholder page

## Current Game Logic

### Registration and intro

- New players register at `/register`
- Registration stores the player in the database and logs them into the session
- After registration, the player is redirected to the Ackermans intro state:
  - progress shows `0/20`
  - no success message is shown
  - the clue card points to `Ackermans`

### Scan progression

- Each QR route is in the form `/scan/{storeSlug}`
- Scanning a store logs that store for the player, unless it has already been scanned
- The clue card shows the next store in the sequence, not the currently scanned store

Examples:

- `/scan/ackermans` logs Ackermans and shows the clue for `Lacoste`
- `/scan/spec-savers` logs Spec-Savers and shows the clue for `Baby City`

### Sequence enforcement

Players are expected to follow the next relevant clue in order.

If a player jumps ahead and scans the wrong next location, they see:

`Boo-doo! You missed some banana codes! Go hunt again!`

### Duplicate scans

If a player scans a store they already logged, progress does not increase and the player sees:

`You've already logged this store - here's the clue again.`

### Completion

- Progress displays out of `20`
- When all required store visits are complete, the player is redirected to `/complete`
- The final winner message is shown on the completion screen

## Store Order

The hunt order is controlled by `sort_order` in `StoreSeeder`.

Current sequence:

1. Ackermans
2. Lacoste
3. Spec-Savers
4. Baby City
5. The Fun Company
6. Expedition North
7. Coricraft
8. Legends Barbershop
9. Clicks
10. Lovisa
11. Destinations by Frasers
12. Freedom of Movement
13. Sorbet
14. Old School
15. Le Creuset
16. PNA
17. Crocs
18. Cell C
19. Totalsports
20. Spur

## Main Routes

### Public / player routes

- `GET /` - landing page
- `GET /login` - player login
- `POST /login` - player login submit
- `POST /logout` - player logout
- `GET /forgot-password` - player password reset form
- `POST /forgot-password` - player password reset submit
- `GET /register` - player registration form
- `POST /register` - player registration submit
- `GET /terms-and-conditions` - placeholder terms page

### Protected game routes

- `GET /game` - progress screen
- `GET /scan/{store:slug}` - store scan screen
- `GET /complete` - completion screen

### Admin routes

- `GET /admin/login`
- `POST /admin/login`
- `POST /admin/logout`
- `GET /admin/entries`
- `GET /admin/entries/export`

## Key Controllers

- `HomeController`
- `RegistrationController`
- `PlayerAuthController`
- `PlayerPasswordController`
- `GameController`
- `QRCodeController`
- `AdminAuthController`
- `AdminEntryController`

## Database

### Main tables

- `players`
- `stores`
- `player_store_visits`
- `admins`

### Player passwords

Players now have a `password` column. If you pull the latest changes into a live environment, run the migration:

```bash
php artisan migrate
```

## Local Setup

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Copy environment file:

```bash
cp .env.example .env
```

4. Generate app key:

```bash
php artisan key:generate
```

5. Configure MySQL credentials in `.env`

6. Run migrations:

```bash
php artisan migrate
```

7. Seed stores and admin user:

```bash
php artisan db:seed
```

8. Start the app:

```bash
php artisan serve
```

9. Start Vite during development:

```bash
npm run dev
```

## Production / cPanel Deployment Notes

### Build assets before upload

```bash
npm run build
```

Upload the generated `public/build` folder together with your PHP changes.

### Clear Laravel caches after deployment

```bash
php artisan optimize:clear
```

### Important deployment checks

- `public/build` must exist on the live server
- `public/hot` must not exist on the live server
- `APP_URL` should match the live domain
- the site should consistently use HTTPS
- session storage must be writable

### HTTPS recommendation

Canonical production URL should be:

`https://findthebananas.co.za`

Recommended:

- set `APP_URL=https://findthebananas.co.za`
- force HTTPS at the web server level
- clear caches after changing URL settings

## Frontend Notes

- Main styling lives in `resources/css/app.css`
- Main JS lives in `resources/js/app.js`
- Fonts are bundled through Vite
- Current scan instruction text is plain copy on the player screens:

`Instructions: Open your device camera to Scan`

## Testing

Run the test suite with:

```bash
php artisan test
```

## Known Product Decisions

- The QR scan button itself is not currently wired as an in-page scanner
- Players are instructed to open their device camera and scan physical QR codes directly
- The Terms & Conditions page exists, but some links are still intentionally set to `#` until final linking is approved

## Files Often Updated During Deployment

Commonly changed areas in this project:

- `app/Http/Controllers`
- `app/Models`
- `database/migrations`
- `resources/views`
- `resources/css/app.css`
- `resources/js/app.js`
- `routes/web.php`
- `public/build`

## Maintainer Notes

This project has had multiple campaign-specific copy and flow changes. Before changing game progression logic, always check:

- intro Ackermans behavior
- next-clue sequencing
- duplicate scan messaging
- out-of-sequence warning behavior
- completion redirect rules

