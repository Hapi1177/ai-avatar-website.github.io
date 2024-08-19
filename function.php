<?php
// Your D-ID API key
$apiKey = 'YXNuZmFkbmFAZ21haWwuY29t:Tq_uelln_1QAbeOOTpQfV';

// API URL (update based on the actual D-ID API endpoint you want to use)
$endpoint = 'https://api.d-id.com/talks';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'];
    $imageFile = $_FILES['image'];

    // Prepare data for the API request
    $data = [
        'script' => [
            'type' => 'text',
            'input' => $text
        ],
        'source_url' => $imageFile
    ];

    // Initialize cURL for API request
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $responseData = json_decode($response, true);
        echo '<h2>API Response:</h2>';
        echo '<pre>';
        print_r($responseData);
        echo '</pre>';
    }

    curl_close($ch);
}
?>
