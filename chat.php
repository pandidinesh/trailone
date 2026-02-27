<?php
$msg = $_POST['message'] ?? '';

$apiKey = "YOUR_API_KEY_HERE"; // correct API key podunga

$url = "https://api.openai.com/v1/chat/completions";

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "user", "content" => $msg]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

/* 🔐 SAFETY CHECK */
if (isset($result['choices'][0]['message']['content'])) {
    echo $result['choices'][0]['message']['content'];
} else {
    echo "Bot error 😔 API not responding";
}
?>
