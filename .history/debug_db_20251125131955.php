<?php
require 'vendor/autoload.php';

$config = require 'config/database.php';
$connection = $config['default'];

// For development
if($connection === 'sqlite') {
    $pdo = new PDO('sqlite:database/database.sqlite');
} elseif($connection === 'pgsql') {
    $dsn = "pgsql:host={$config['connections']['pgsql']['host']};" .
           "port={$config['connections']['pgsql']['port']};" .
           "dbname={$config['connections']['pgsql']['database']}";
    $pdo = new PDO($dsn, $config['connections']['pgsql']['username'], $config['connections']['pgsql']['password']);
} else {
    die('Unsupported database');
}

echo "=== Checking Provinces ===\n";
$stmt = $pdo->query("SELECT id, name FROM provinces LIMIT 3");
$provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($provinces as $p) {
    echo "ID: {$p['id']}, Name: {$p['name']}\n";
}

echo "\n=== Checking Regencies (all provinces) ===\n";
$stmt = $pdo->query("SELECT COUNT(*) as count FROM regencies");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Total Regencies: {$result['count']}\n";

echo "\n=== Checking Regencies for each Province ===\n";
$stmt = $pdo->query("SELECT province_id, COUNT(*) as count FROM regencies GROUP BY province_id LIMIT 5");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $r) {
    echo "Province ID: {$r['province_id']}, Regencies Count: {$r['count']}\n";
}

echo "\n=== Sample Regencies for first Province ===\n";
$firstProv = $provinces[0]['id'];
$stmt = $pdo->prepare("SELECT id, name, province_id FROM regencies WHERE province_id = ? LIMIT 3");
$stmt->execute([$firstProv]);
$regencies = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Regencies for Province ID '{$firstProv}':\n";
foreach($regencies as $r) {
    echo "  ID: {$r['id']}, Name: {$r['name']}, Province: {$r['province_id']}\n";
}

if(empty($regencies)) {
    echo "  NO REGENCIES FOUND FOR THIS PROVINCE!\n";
    echo "\n=== Checking all regencies ===\n";
    $stmt = $pdo->query("SELECT DISTINCT province_id FROM regencies LIMIT 5");
    $provinces_in_reg = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Sample Province IDs in Regencies:\n";
    foreach($provinces_in_reg as $p) {
        echo "  {$p['province_id']}\n";
    }
}
