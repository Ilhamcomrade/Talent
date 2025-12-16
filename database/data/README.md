# Dokumentasi API Kabupaten

## Struktur File

```
app/
├── Http/Controllers/api/
│   └── KabupatenController.php       # API Controller untuk kabupaten
├── Helpers/
│   └── KabupatenHelper.php           # Helper untuk memproses data kabupaten
│
database/
├── data/
│   └── kabupaten.csv                 # File CSV data kabupaten
└── seeders/
    └── KabupatenSeeder.php           # Seeder untuk import data
```

## Endpoints API

### 1. Mendapatkan Semua Kabupaten
```
GET /api/kabupaten
```

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": "1101",
            "province_id": "11",
            "name": "KABUPATEN SIMEULUE",
            "created_at": "2025-11-20T00:00:00.000000Z",
            "updated_at": "2025-11-20T00:00:00.000000Z"
        }
    ],
    "count": 514
}
```

### 2. Mendapatkan Kabupaten Berdasarkan Provinsi
```
GET /api/kabupaten/provinsi/{province_id}
```

**Contoh:**
```
GET /api/kabupaten/provinsi/11
```

### 3. Mendapatkan Detail Kabupaten
```
GET /api/kabupaten/{id}
```

**Contoh:**
```
GET /api/kabupaten/1101
```

### 4. Membuat Kabupaten Baru
```
POST /api/kabupaten
```

**Request Body:**
```json
{
    "id": "9999",
    "province_id": "11",
    "name": "KABUPATEN TEST"
}
```

### 5. Mengupdate Kabupaten
```
PUT /api/kabupaten/{id}
```

**Request Body:**
```json
{
    "name": "KABUPATEN BARU"
}
```

### 6. Menghapus Kabupaten
```
DELETE /api/kabupaten/{id}
```

### 7. Bulk Import Kabupaten
```
POST /api/kabupaten/bulk-import
```

**Request Body:**
```json
{
    "data": [
        {
            "id": "1101",
            "province_id": "11",
            "name": "KABUPATEN SIMEULUE"
        },
        {
            "id": "1102",
            "province_id": "11",
            "name": "KABUPATEN ACEH SINGKIL"
        }
    ]
}
```

## Cara Menggunakan

### 1. Setup Routes

Tambahkan ke file `routes/api.php`:

```php
Route::prefix('kabupaten')->group(function () {
    Route::get('/', [KabupatenController::class, 'index']);
    Route::get('/provinsi/{provinceId}', [KabupatenController::class, 'byProvince']);
    Route::get('/{id}', [KabupatenController::class, 'show']);
    Route::post('/', [KabupatenController::class, 'store']);
    Route::put('/{id}', [KabupatenController::class, 'update']);
    Route::delete('/{id}', [KabupatenController::class, 'destroy']);
    Route::post('/bulk-import', [KabupatenController::class, 'bulkImport']);
});
```

### 2. Import Data via CSV

Tambahkan data ke file `database/data/kabupaten.csv` dengan format:

```csv
id,province_id,name
1101,11,KABUPATEN SIMEULUE
1102,11,KABUPATEN ACEH SINGKIL
```

Kemudian jalankan seeder:

```bash
php artisan db:seed --class=KabupatenSeeder
```

### 3. Import Data via Helper (dalam kode)

```php
use App\Helpers\KabupatenHelper;

$data = [
    [
        'id' => '1101',
        'province_id' => '11',
        'name' => 'KABUPATEN SIMEULUE'
    ],
    [
        'id' => '1102',
        'province_id' => '11',
        'name' => 'KABUPATEN ACEH SINGKIL'
    ]
];

$result = KabupatenHelper::importFromArray($data);

// Output:
// [
//     'success' => true,
//     'inserted' => 2,
//     'updated' => 0,
//     'failed' => 0,
//     'errors' => []
// ]
```

### 4. Mendapatkan Data Kabupaten

```php
use App\Helpers\KabupatenHelper;

// Berdasarkan provinsi
$kabupaten = KabupatenHelper::getByProvince('11');

// Total kabupaten
$total = KabupatenHelper::getTotal();

// Statistik
$stats = KabupatenHelper::getStats();
```

## Format Data CSV

File CSV harus memiliki header: `id,province_id,name`

Format data:
- **id**: String unik (kode kabupaten)
- **province_id**: String (kode provinsi)
- **name**: String (nama kabupaten/kota)

Contoh:
```csv
id,province_id,name
1101,11,KABUPATEN SIMEULUE
1102,11,KABUPATEN ACEH SINGKIL
1103,11,KABUPATEN ACEH SELATAN
```

## Testing

Untuk testing menggunakan Postman atau tool serupa:

1. **Import All**
   - Method: GET
   - URL: `http://localhost:8000/api/kabupaten`

2. **By Province**
   - Method: GET
   - URL: `http://localhost:8000/api/kabupaten/provinsi/11`

3. **Bulk Import**
   - Method: POST
   - URL: `http://localhost:8000/api/kabupaten/bulk-import`
   - Body: JSON array dengan struktur data

## Notes

- ID kabupaten harus unik
- Province ID harus ada di tabel `provinces`
- Ketika melakukan bulk import dengan ID yang sudah ada, data akan di-update
- Semua response menggunakan format JSON yang konsisten
