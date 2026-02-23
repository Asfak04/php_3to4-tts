<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Check for hashtag parameter
if (!isset($_GET['hashtag']) || empty($_GET['hashtag'])) {
    echo json_encode(["status" => "error", "message" => "Hashtag is required"]);
    exit;
}

$hashtag = urlencode($_GET['hashtag']);
$bearer_token = "YOUR_TWITTER_BEARER_TOKEN";

// Twitter API endpoint (recent search)
$url = "https://api.twitter.com/2/tweets/search/recent?query=%23$hashtag&tweet.fields=created_at,author_id&expansions=author_id&user.fields=username,name,profile_image_url";

// Initialize cURL
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $bearer_token",
        "User-Agent: PHP-App"
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(["status" => "error", "message" => "Failed to fetch tweets"]);
    exit;
}

$data = json_decode($response, true);

// Combine tweet data with user info
$tweets = [];
if (isset($data['data'])) {
    $users = [];
    if (isset($data['includes']['users'])) {
        foreach ($data['includes']['users'] as $u) {
            $users[$u['id']] = $u;
        }
    }

    foreach ($data['data'] as $tweet) {
        $user = $users[$tweet['author_id']] ?? [];
        $tweets[] = [
            "text" => $tweet['text'],
            "username" => $user['username'] ?? "unknown",
            "name" => $user['name'] ?? "",
            "profile_image" => $user['profile_image_url'] ?? "",
            "created_at" => $tweet['created_at']
        ];
    }
}

echo json_encode([
    "status" => "success",
    "tweets" => $tweets
]);
