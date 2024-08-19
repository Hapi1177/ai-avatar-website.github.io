<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-ID Integration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input, label {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

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

<h1>D-ID API Integration</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="text">Enter Text for Animation:</label>
    <input type="text" id="text" name="text" required>

    <label for="image">Upload an Image (optional):</label>
    <input type="file" id="image" name="image">

    <button type="submit">Submit</button>
</form>

</body>
</html>
