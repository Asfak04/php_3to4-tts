<!DOCTYPE html>
<html>
<head>
    <title>Location Finder</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 30px;
        }
        form {
            margin-bottom: 20px;
        }
        input {
            padding: 8px;
            width: 300px;
        }
        button {
            padding: 8px 15px;
            background: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .result {
            background: white;
            padding: 15px;
            border-radius: 5px;
            width: 420px;
        }
        iframe {
            margin-top: 15px;
            width: 100%;
            height: 300px;
            border: 0;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>📍 Find Location Coordinates</h2>

<form method="get">
    <input type="text" name="address" placeholder="Enter address" required
        value="<?= isset($_GET['address']) ? htmlspecialchars($_GET['address']) : '' ?>">
    <button type="submit">Get Location</button>
</form>

<?php
if (!empty($_GET['address'])) {

    $address = urlencode($_GET['address']);

    // Call API file (same folder)
    $url = "http://localhost/Assingments/Web_Services_%20Api_%20Extensions_assignment/Google_Maps_Geocoding_API_12/get_location.php?address=$address";

    $response = @file_get_contents($url);

    if ($response === false) {
        echo "<p class='error'>❌ Unable to reach API</p>";
        exit;
    }

    $data = json_decode($response, true);

    if (!$data || $data['status'] !== true) {
        echo "<p class='error'>❌ Location not found</p>";
        exit;
    }

    $lat = $data['lat'];
    $lon = $data['lon'];
?>

<div class="result">
    <p><strong>Latitude:</strong> <?= htmlspecialchars($lat) ?></p>
    <p><strong>Longitude:</strong> <?= htmlspecialchars($lon) ?></p>

    <!-- ✅ MAP IFRAME (as requested) -->
    <iframe
        src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $lon-0.02 ?>,<?= $lat-0.02 ?>,<?= $lon+0.02 ?>,<?= $lat+0.02 ?>&layer=mapnik&marker=<?= $lat ?>,<?= $lon ?>">
    </iframe>
</div>

<?php } ?>

</body>
</html>
