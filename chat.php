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
