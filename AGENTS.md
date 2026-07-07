# AGENTS.md

## Project Name

Mall of the North - Meet Henry & James Minions QR Clue Hunt

## Project Type

Laravel 10 mobile-first competition web application.

This application is designed mainly for mobile users visiting Mall of the North. Users enter their details, join the competition, scan QR codes placed at participating stores, receive clues, and track their progress until all 20 stores are found.

## Important Project Locations

Use the following local paths when working on this project:

```txt
Project root:
C:\xampp\htdocs\gabrielWork\fgx\moa\project

Screen/user journey references:
C:\xampp\htdocs\gabrielWork\fgx\moa\assets\screens

Game/application assets:
C:\xampp\htdocs\gabrielWork\fgx\moa\elements
```

## Technology Rules

Build the project using:

- Laravel 10
- PHP 8+
- Blade templates
- MySQL
- JavaScript
- jQuery
- HTML5
- CSS3

Do not use:

- Vue.js
- React
- Angular
- Inertia
- Livewire unless specifically requested later
- Any heavy frontend JavaScript framework

The application must remain simple, fast, mobile-friendly, and suitable for in-mall users scanning QR codes.

## Visual Direction

The uploaded screen designs are the main visual reference. Match them as closely as possible.

### Main Background

Use this gradient for the main body background:

```css
background: linear-gradient(348deg, #0097CC 0%, #0E4774 100%);
```

### Primary Colour

Use this as the main yellow campaign colour:

```css
#F9EF48
```

### General Style

The interface should feel:

- Fun
- Bold
- Child-friendly
- Mobile-first
- Competition/game focused
- Simple to use
- Fast to load

### Layout Behaviour

Design primarily for mobile portrait screens.

Use a centred app wrapper with a max width so it still looks good on desktop testing:

```css
.app-wrapper {
    width: 100%;
    max-width: 430px;
    min-height: 100vh;
    margin: 0 auto;
}
```

Use the supplied campaign assets for the header graphics, logo, characters, and footer branding.

## Application Flow

### 1. Landing Screen

The first screen introduces the game.

Main message:

```txt
Henry & James need YOUR help! Hunt down all the store clues hidden around Mall of the North.
```

Button text:

```txt
Let's GO!
```

Small note:

```txt
Free to enter. One entry per person.
```

When the user taps the button, they should go to the entry form.

### 2. Entry Form Screen

The user must submit their competition details before they can play.

Required fields:

- Name
- Surname
- Email
- Cell Phone

Submit button text:

```txt
Submit
```

Validation rules:

- Name is required
- Surname is required
- Email is required and must be valid
- Cell phone is required
- Email should be unique where possible
- Cell phone should be unique where possible
- One entry per person

After successful submission:

- Create the participant record
- Store participant ID in session
- Redirect user to the game/progress screen

### 3. Game Progress Screen Before Any QR Scan

Show progress:

```txt
Minions found: 0/20
20 to go!
```

Show 20 progress slots.

All slots must be empty when no stores are found.

Instruction text:

```txt
Scan a Minion QR code at any store to reveal your next clue.
```

Main button text:

```txt
Scan Now
```

Small text:

```txt
Scan the next Minion QR code you find to reveal your next clue.
```

### 4. QR Scan Behaviour

Each store must have a unique QR code.

The QR code should point to a Laravel route similar to:

```txt
/scan/{storeSlug}
```

Example:

```txt
/scan/le-creuset
/scan/spur
/scan/clicks
```

When the user scans a QR code:

- Check if participant exists in session
- If not, redirect to landing or entry form
- Find the store using the scanned slug
- Check whether this participant has already logged this store
- If not logged before, create a participant store scan record
- Show the clue for that store
- Update progress count
- Fill the correct number of progress slots

### 5. Successful New Store Scan Screen

When the user scans a new store, show:

```txt
Minions found: X/20 | Y to go!
```

Show filled progress slots based on stores found.

Success message:

```txt
Nice find! On to the next Minion.
```

Show the store name and clue in a white clue card.

Example:

```txt
Le Creuset
Even Minions need to cook up something delicious! Find the store where kitchen treasures and colourful cookware bring recipes to life.
```

Show the Scan Now button below.

### 6. Already Logged Store Screen

If the participant scans a store they already scanned before, do not create another scan record.

Show the error message:

```txt
You've already logged this store - here's the clue again.
```

The message should be styled in a visible error/warning colour similar to the screen design.

Still show the same store name and clue again.

Progress count must not increase.

### 7. Completed Game Screen

When all 20 stores have been found, show:

```txt
Minions found: 20/20 | 0 to go!
```

Show all 20 progress slots as filled.

Completion message:

```txt
That's all 20! Head to the info desk to claim your prize!
```

The user should still be able to see the Scan Now button if required, but the main focus must be the completion message.

## Core Database Tables

Create clean Laravel migrations for the following tables.

### participants

Stores competition entrants.

Suggested columns:

```txt
id
name
surname
email
cell_phone
session_token nullable
completed_at nullable
created_at
updated_at
```

Recommended indexes:

```txt
email
cell_phone
session_token
```

### stores

Stores participating locations and clues.

Suggested columns:

```txt
id
name
slug
clue
sort_order
is_active default true
created_at
updated_at
```

Recommended indexes:

```txt
slug unique
is_active
sort_order
```

### participant_store_scans

Tracks which participant scanned which store.

Suggested columns:

```txt
id
participant_id
store_id
scanned_at
created_at
updated_at
```

Important unique constraint:

```txt
participant_id + store_id must be unique
```

This prevents duplicate scans for the same participant and store.

## Models

Create these Laravel models:

- Participant
- Store
- ParticipantStoreScan

### Participant Relationships

```php
public function scans()
{
    return $this->hasMany(ParticipantStoreScan::class);
}

public function stores()
{
    return $this->belongsToMany(Store::class, 'participant_store_scans')
        ->withPivot('scanned_at')
        ->withTimestamps();
}
```

### Store Relationships

```php
public function scans()
{
    return $this->hasMany(ParticipantStoreScan::class);
}
```

### ParticipantStoreScan Relationships

```php
public function participant()
{
    return $this->belongsTo(Participant::class);
}

public function store()
{
    return $this->belongsTo(Store::class);
}
```

## Store Data And Clues

Seed exactly 20 stores.

Use the following store names, slugs, and clues.

### Ackermans

Slug:

```txt
ackermans
```

Clue:

```txt
Need a new outfit for your Minion mission? Look for the store where the whole family can dress for less.
```

### Lacoste

Slug:

```txt
lacoste
```

Clue:

```txt
A stylish Minion always dresses to impress! Find the store where classic fashion and the famous crocodile make a statement.
```

### Spec-Savers

Slug:

```txt
spec-savers
```

Clue:

```txt
A Minion misplaced his banana because he couldn't see! Visit the place that helps you spot every clue clearly.
```

### Baby City

Slug:

```txt
baby-city
```

Clue:

```txt
Little ones need lots of love and care. Find the store with baby essentials, outfits and treasures to share.
```

### The Fun Company

Slug:

```txt
the-fun-company
```

Clue:

```txt
Games, excitement and lots of laughs await! Find the place where fun is the main attraction.
```

### Expedition North

Slug:

```txt
expedition-north
```

Clue:

```txt
Every Minion explorer needs adventure gear! Find the store that's ready for mountains, trails and the great outdoors.
```

### Coricraft

Slug:

```txt
coricraft
```

Clue:

```txt
After a busy banana hunt, a Minion needs a comfy place to relax. Find the store where beautiful furniture makes a house a home.
```

### Legends Barbershop

Slug:

```txt
legends-barbershop
```

Clue:

```txt
Even Minions need a fresh haircut! Find the place where great styles become legendary.
```

### Clicks

Slug:

```txt
clicks
```

Clue:

```txt
Need toothpaste, shampoo or a quick health fix? Find the store that has a little bit of everything.
```

### Lovisa

Slug:

```txt
lovisa
```

Clue:

```txt
Sparkles catch a Minion's eye! Find the store filled with dazzling jewellery and accessories.
```

### Destinations by Frasers

Slug:

```txt
destinations-by-frasers
```

Clue:

```txt
A Minion adventure awaits! Find the store where suitcases, travel bags and journey essentials help explorers pack for their next mission.
```

### Freedom of Movement

Slug:

```txt
freedom-of-movement
```

Clue:

```txt
For this stop, find the place where style takes the lead. From leather treasures to branded looks, they have everything you need to move freely and confidently.
```

### Sorbet

Slug:

```txt
sorbet
```

Clue:

```txt
It's time to relax and glow! Find the place where beauty treatments and pampering help you shine from head to toe.
```

### Old School

Slug:

```txt
old-school
```

Clue:

```txt
A true supporter needs the right gear! Find the store where fans can show their colours and wear their team pride.
```

### Le Creuset

Slug:

```txt
le-creuset
```

Clue:

```txt
Even Minions need to cook up something delicious! Find the store where kitchen treasures and colourful cookware bring recipes to life.
```

### PNA

Slug:

```txt
pna
```

Clue:

```txt
Need something to write, create or learn? Find the place where stationery, gifts and school essentials take their turn!
```

### Crocs

Slug:

```txt
crocs
```

Clue:

```txt
Minions love to stand out! Find the store where colourful, comfy and funky footwear brings fun to every step.
```

### Cell C

Slug:

```txt
cell-c
```

Clue:

```txt
Minions love to stay connected! Find the store where you can call, chat and share your banana discoveries.
```

### Totalsports

Slug:

```txt
totalsports
```

Clue:

```txt
Ready, set, GO! Find the store where athletes and sports fans gear up for action.
```

### Spur

Slug:

```txt
spur
```

Clue:

```txt
Follow the smell of burgers and family fun! A hungry Minion knows exactly where to go.
```

## Recommended Routes

Use simple web routes.

```php
Route::get('/', [GameController::class, 'landing'])->name('game.landing');
Route::get('/enter', [GameController::class, 'enter'])->name('game.enter');
Route::post('/enter', [GameController::class, 'storeParticipant'])->name('game.store-participant');
Route::get('/game', [GameController::class, 'game'])->name('game.index');
Route::get('/scan/{store:slug}', [GameController::class, 'scan'])->name('game.scan');
```

Optional admin/export routes can be added later if requested.

## Controller Requirements

Create a `GameController`.

Suggested methods:

```txt
landing()
enter()
storeParticipant(Request $request)
game()
scan(Store $store)
```

### Participant Session Logic

After a participant submits the entry form, store their participant ID in the session:

```php
session(['participant_id' => $participant->id]);
```

Every game and scan route should check this session value.

If the session does not exist, redirect the user to the entry screen.

### Progress Calculation

Total stores:

```php
$totalStores = Store::where('is_active', true)->count();
```

Found stores:

```php
$foundCount = $participant->scans()->count();
```

Remaining:

```php
$remaining = max($totalStores - $foundCount, 0);
```

Completion:

```php
$isComplete = $foundCount >= $totalStores;
```

When complete, set `completed_at` on the participant if it has not already been set.

## Blade View Structure

Recommended Blade files:

```txt
resources/views/layouts/app.blade.php
resources/views/game/landing.blade.php
resources/views/game/enter.blade.php
resources/views/game/index.blade.php
resources/views/game/scan.blade.php
resources/views/components/progress-bars.blade.php
resources/views/components/clue-card.blade.php
resources/views/components/primary-button.blade.php
```

Keep views simple and reusable.

## Progress Bar Design

There are 20 small pill-shaped slots.

Empty slot:

- Transparent or semi-transparent inside
- Yellow border
- Rounded pill shape

Filled slot:

- Yellow fill
- Yellow border

Suggested CSS:

```css
.progress-slots {
    display: grid;
    grid-template-columns: repeat(20, 1fr);
    gap: 6px;
    width: 100%;
}

.progress-slot {
    height: 45px;
    border: 2px solid #F9EF48;
    border-radius: 999px;
}

.progress-slot.is-filled {
    background: #F9EF48;
}
```

Adjust sizes for mobile if needed.

## Button Style

Buttons should match the yellow 3D-style design in the screens.

Suggested CSS:

```css
.btn-primary-game {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 76px;
    padding: 18px 28px;
    border: 0;
    border-radius: 18px;
    background: #F9EF48;
    color: #000;
    font-size: 42px;
    font-weight: 800;
    line-height: 1;
    text-align: center;
    text-decoration: none;
    box-shadow: 10px 12px 0 #000;
}
```

For smaller buttons, reduce width and font size.

## Form Style

Form fields should match the screen design.

Suggested CSS:

```css
.form-label {
    display: block;
    margin-bottom: 10px;
    color: #fff;
    font-size: 24px;
    font-weight: 400;
}

.form-control-game {
    width: 100%;
    min-height: 70px;
    padding: 16px 22px;
    border: 0;
    border-radius: 16px;
    background: #fff;
    color: #111;
    font-size: 24px;
    outline: none;
}

.form-control-game::placeholder {
    color: #8a8a8a;
}
```

## Clue Card Style

The clue card should be white with rounded corners.

Suggested CSS:

```css
.clue-card {
    width: 100%;
    padding: 22px;
    border-radius: 16px;
    background: #fff;
    color: #111;
}

.clue-card-title {
    margin: 0 0 14px;
    color: #0E4774;
    font-size: 26px;
    font-weight: 800;
}

.clue-card-text {
    margin: 0;
    font-size: 22px;
    line-height: 1.25;
}
```

## QR Code Requirements

Generate or prepare one QR code per store.

Each QR code must point to the correct `/scan/{storeSlug}` URL.

Examples:

```txt
https://campaign-domain.co.za/scan/ackermans
https://campaign-domain.co.za/scan/le-creuset
https://campaign-domain.co.za/scan/spur
```

Do not hard-code the final domain unless the final campaign URL is provided.

Use Laravel route generation where possible.

## Data Rules

- A participant may only log each store once.
- A duplicate scan must not increase the total found count.
- A duplicate scan must show the duplicate message and repeat the clue.
- The system must support exactly 20 active stores for this campaign.
- The game is free to enter.
- Treat one participant as one entry.

## Security And Validation

Use Laravel validation for all form submissions.

Protect against:

- Empty form submissions
- Invalid emails
- Duplicate participant entries where possible
- Invalid store slugs
- Duplicate store scans

Use CSRF protection on all POST forms.

Never trust QR parameters without checking the database.

## Recommended Seeder

Create a `StoreSeeder` that inserts the 20 stores in the order provided above.

Use `updateOrCreate` so the seeder can be safely re-run.

Example format:

```php
Store::updateOrCreate(
    ['slug' => 'le-creuset'],
    [
        'name' => 'Le Creuset',
        'clue' => 'Even Minions need to cook up something delicious! Find the store where kitchen treasures and colourful cookware bring recipes to life.',
        'sort_order' => 15,
        'is_active' => true,
    ]
);
```

## Optional Admin Features For Later

Do not build these unless requested, but keep the structure ready for them:

- Admin login
- View participants
- View completed participants
- Export participants to CSV/Excel
- View scans by participant
- View scan counts per store
- Reset test participants
- Generate printable QR codes

## Development Notes For Codex

When generating code for this project:

- Create complete files, not small disconnected snippets.
- Keep the Laravel structure clean and standard.
- Use route names instead of hard-coded links where possible.
- Keep all styles in a dedicated CSS file unless the project setup requires inline styles temporarily.
- Match the supplied mobile screens closely.
- Do not add unnecessary packages.
- Do not use frontend frameworks.
- Use jQuery only for light enhancements if needed.
- Keep the app fast and simple.
- Use comments only where they help future developers understand the logic.

## Definition Of Done

The project is considered ready when:

- A user can open the landing screen.
- A user can submit their details.
- A participant session is created.
- A user can scan a store QR link.
- A new store scan increases progress.
- A duplicate store scan shows the duplicate warning and does not increase progress.
- Progress slots update correctly from 0 to 20.
- The completion message appears when all 20 stores are found.
- The UI closely matches the supplied mobile screen designs.
- The application works without Vue, React, or any frontend framework.
