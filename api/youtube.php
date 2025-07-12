<?php
require_once __DIR__.'/config.php';
header('Content-Type: application/json');

$query = $_GET['query'] ?? 'música popular';
$maxResults = 3;


$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://www.googleapis.com/youtube/v3/search?part=snippet&q=".urlencode($query)."&maxResults={$maxResults}&type=video&key=".YOUTUBE_API_KEY,
    CURLOPT_RETURNTRANSFER => true
]);

$response = json_decode(curl_exec($ch), true);
$results = [];

if (!empty($response['items'])) {
    foreach ($response['items'] as $item) {
        $results[] = [
            'id' => $item['id']['videoId'],
            'title' => $item['snippet']['title'],
            'thumbnail' => $item['snippet']['thumbnails']['default']['url']
        ];
    }
}

echo json_encode($results);
?>