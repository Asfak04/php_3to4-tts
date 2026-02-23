<?php
require 'config.php';

use League\OAuth2\Client\Provider\Google;

$provider = new Google([
    'clientId' => $googleClientId,
    'clientSecret' => $googleClientSecret,
    'redirectUri' => $googleRedirectUri,
]);

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}

if (!isset($_GET['code'])) {
    exit('No authorization code received');
}

$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

$user = $provider->getResourceOwner($token);
$userData = $user->toArray();

$_SESSION['user'] = [
    'name' => $userData['name'] ?? '',
    'email' => $userData['email'] ?? ''
];

header('Location: index.php');
exit;
?>