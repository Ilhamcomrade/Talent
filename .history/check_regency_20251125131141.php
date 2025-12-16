<?php
require 'bootstrap/app.php';
use App\Models\Province;
use App\Models\Regency;

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

// Check provinces
echo "=== Checking Provinces ===\n";
$provinces = Province::take(5)->get(['id', 'name']);
echo "Total provinces: " . Province::count() . "\n";
foreach($provinces as $p) {
    echo "  ID: '{$p->id}', Name: {$p->name}\n";
}

echo "\n=== Checking Regencies ===\n";
echo "Total regencies: " . Regency::count() . "\n";

echo "\n=== Regencies by Province (first 10 provinces) ===\n";
$byProvince = Regency::selectRaw("province_id, COUNT(*) as count")
    ->groupBy('province_id')
    ->orderBy('province_id')
    ->get();

foreach($byProvince->take(10) as $r) {
    echo "  Province '{$r->province_id}': {$r->count} regencies\n";
}

echo "\n=== Sample for Province '11' ===\n";
$regencies = Regency::where('province_id', '11')->take(5)->get(['id', 'name']);
echo "Found: " . count($regencies) . " regencies\n";
foreach($regencies as $r) {
    echo "  ID: '{$r->id}', Name: {$r->name}\n";
}

if(count($regencies) == 0) {
    echo "\n!!! NO REGENCIES FOUND FOR PROVINCE '11' !!!\n";
    echo "\nChecking available province_ids in regencies table:\n";
    $availableIds = Regency::selectRaw('DISTINCT province_id')
        ->orderBy('province_id')
        ->get();
    
    echo "Found " . count($availableIds) . " unique province_ids:\n";
    foreach($availableIds as $p) {
        echo "  - '{$p->province_id}'\n";
    }
}
?>
