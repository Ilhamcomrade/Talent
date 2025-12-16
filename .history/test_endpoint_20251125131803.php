<?php
// Quick test of API endpoint
$url = 'http://localhost:8000/api/reference/kabupaten/by-province?parent_id=11';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response:\n";
echo $response . "\n";

if ($response) {
    $data = json_decode($response, true);
    echo "\nTotal items: " . count($data) . "\n";
    if (!empty($data)) {
        echo "First item:\n";
        echo json_encode($data[0], JSON_PRETTY_PRINT) . "\n";
    }
}
?>
