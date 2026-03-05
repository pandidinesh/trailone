<<<<<<< HEAD
<?php
header('Content-Type: application/json');

// Your HuggingFace API key (keep secret)
$api_key = "hhf_YUtcavRIYwgEKzviaVwezBkkNUInqDRWAF";

// Get user message from POST request
$input = json_decode(file_get_contents("php://input"), true);
$message = $input['message'] ?? '';

// Prepare request to HuggingFace
$url = "https://router.huggingface.co/hf-inference/models/gpt2";
$data = json_encode([
    "inputs" => $message,
    "parameters" => ["max_new_tokens" => 200]
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $api_key",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
=======
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
>>>>>>> 567c4a9d0bad21e248c6b18fd98bdf607e03f40c
