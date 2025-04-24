<?php
/**
 * Simple test script for the API
 * 
 * Usage:
 * php test-api.php                  # Test with default values
 * php test-api.php 2,4,6,8,10       # Test with custom values
 */

// Get numbers from command line or use default
$numbersString = $argv[1] ?? '1,2,3,4,5,6';
$numbers = array_map('intval', explode(',', $numbersString));

// Prepare the request
$data = json_encode(['numbers' => $numbers]);
$url = 'http://localhost:5000/api/sum-even';

echo "Testing Sum Even Numbers API\n";
echo "Numbers: " . implode(', ', $numbers) . "\n\n";

// Make the request
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data)
]);

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Display the result
echo "Response Status Code: " . $httpCode . "\n";
echo "Response Body: " . $result . "\n\n";

// Parse and show in a friendly format
$response = json_decode($result, true);
if (isset($response['sum'])) {
    echo "Sum of even numbers: " . $response['sum'] . "\n";
    
    // Calculate the sum manually for verification
    $evenSum = 0;
    $evenNumbers = [];
    foreach ($numbers as $number) {
        if ($number % 2 === 0) {
            $evenSum += $number;
            $evenNumbers[] = $number;
        }
    }
    
    echo "Even numbers in the input: " . implode(', ', $evenNumbers) . "\n";
    echo "Manual calculation: " . $evenSum . "\n";
    
    // Verify the result
    if ($evenSum === $response['sum']) {
        echo "✓ API response matches the expected result!\n";
    } else {
        echo "✗ API response does not match the expected result!\n";
    }
} elseif (isset($response['errors'])) {
    echo "Error: " . json_encode($response['errors'], JSON_PRETTY_PRINT) . "\n";
} else {
    echo "Unexpected response format\n";
}