<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid ID";
    exit;
}

$api_url = "http://localhost:8080/api/students/$id";

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

header("Location: fetch_data.php");
exit;
