<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

// Test Provinsi List
echo "=== Testing Provinsi List ===\n";
$provinsi = \App\Models\Province::orderBy('name')->limit(3)->get(['id', 'name']);
foreach($provinsi as $p) {
    echo "ID: {$p->id}, Name: {$p->name}\n";
}

// Test get Regencies by Province
echo "\n=== Testing Regencies by Province ===\n";
if($provinsi->first()) {
    $provinceId = $provinsi->first()->id;
    echo "Getting regencies for province_id: {$provinceId}\n";
    $regencies = \App\Models\Regency::where('province_id', $provinceId)->orderBy('name')->limit(3)->get(['id', 'name', 'province_id']);
    foreach($regencies as $r) {
        echo "ID: {$r->id}, Name: {$r->name}, Province: {$r->province_id}\n";
    }
}

// Test Districts by Regency
echo "\n=== Testing Districts by Regency ===\n";
$firstRegency = \App\Models\Regency::orderBy('id')->first();
if($firstRegency) {
    echo "Getting districts for regency_id: {$firstRegency->id}\n";
    $districts = \App\Models\District::where('regency_id', $firstRegency->id)->orderBy('name')->limit(3)->get(['id', 'name', 'regency_id']);
    echo "Found " . count($districts) . " districts\n";
    foreach($districts as $d) {
        echo "ID: {$d->id}, Name: {$d->name}, Regency: {$d->regency_id}\n";
    }
}

echo "\n=== Summary ===\n";
echo "Total Provinces: " . \App\Models\Province::count() . "\n";
echo "Total Regencies: " . \App\Models\Regency::count() . "\n";
echo "Total Districts: " . \App\Models\District::count() . "\n";
echo "Total Villages: " . \App\Models\Village::count() . "\n";
