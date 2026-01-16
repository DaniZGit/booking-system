# Hotel Booking System (Laravel + Twill + Filament)

To je večjezična aplikacija za rezervacijo hotelskih sob, razvita z ogrodjem **Laravel**.  
Vključuje **Twill CMS** za upravljanje vsebin sob in **Filament Admin** panel za pregled vseh rezervacij.

## Tehnologije

-   **Framework:** Laravel 11
-   **Frontend:** Livewire Volt, Tailwind CSS
-   **CMS:** [Twill CMS](https://twillcms.com/) – upravljanje sob na `/cms`
-   **Admin Panel:** [Filament PHP](https://filamentphp.com/) – pregled rezervacij na `/admin`
-   **Baza:** MySQL (preko Docker Compose)

## Navodila za namestitev in zagon

Sledite spodnjim korakom za lokalno vzpostavitev projekta.

---

### 1. Kloniranje projekta in namestitev odvisnosti

Najprej klonirajte repozitorij in namestite PHP ter JS pakete:

```bash
git clone https://github.com/DaniZGit/booking-system
cd booking-system

composer install
npm install
```

### 2. Okoljske spremenljivke (.env, APP_KEY)

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Zagon MYSQL (Docker)

```bash
docker compose up -d
```

### 4. Migracije in začetni podatki (Seeding)

```
php artisan migrate
php artisan db:seed
```

### 5. Zagon aplikacije

```
php artisan serve
npm run dev
```

Aplikacija bo dostopna na [http://127.0.0.1:8000](http://127.0.0.1:8000)
