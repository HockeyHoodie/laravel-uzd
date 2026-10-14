# Treniņu žurnāls (Praktiskais darbs 2)

Laravel tīmekļa lietotne treniņu un vingrojumu uzskaites pārvaldībai.

## Prasību izpilde

- **Autentifikācija:** Laravel Breeze (Blade stack) — reģistrācija, pieslēgšanās, e-pasta verifikācija
- **Modeļi:** `User` → `Workout` → `Exercise` (Eloquent relācijas)
- **CRUD:** pilns treniņu (`Workout`) CRUD autentificētam lietotājam
- **Seeders:** `php artisan migrate:fresh --seed` (2 lietotāji, treniņi un vingrojumi)
- **AJAX:** vingrojuma dzēšana treniņa skatā bez lapas pārlādes (`fetch` + JSON atbilde)
- **Blade:** lietotāja saskarne veidota ar Blade veidnēm
- **Validācija:** Form Request klases treniņiem un vingrojumiem

## Demo konti (pēc seed)

| E-pasts | Parole |
|---------|--------|
| `anna@example.com` | `password` |
| `janis@example.com` | `password` |

## Palaišana

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

Atver `http://127.0.0.1:8000`, pieslēdzies un atver sadaļu **Treniņi**.

## AI rīku izmantošana

Projekta izstrādē izmantots Cursor (LLM palīgs) migrāciju un modeļu struktūrai, Breeze/Blade integrācijai, CRUD kontrolleriem, seeders un AJAX dzēšanas skriptam. Kods pārskatīts un pielāgots projekta prasībām.

## Prezentācijas ieteikums

1. Arhitektūra: maršruti → kontrolleri → Form Requests → modeļi
2. Relāciju shēma `User` / `Workout` / `Exercise`
3. Live demo: CRUD, validācijas kļūda, AJAX dzēšana (pārlūka Network cilne)
4. `database/seeders` un `migrate:fresh --seed`
