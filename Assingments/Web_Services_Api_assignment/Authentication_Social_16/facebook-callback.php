<?php
require 'config.php';

use League\OAuth2\Client\Provider\Facebook;

$provider = new Facebook([
    'clientId'          => $facebookClientId,
    'clientSecret'      => $facebookClientSecret,
    'redirectUri'       => $facebookRedirectUri,
    'graphApiVersion'   => 'v18.0',
]);

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}

$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

$user = $provider->getResourceOwner($token);

echo "<h3>Facebook User Info</h3>";
echo "Name: " . $user->getName() . "<br>";
echo "Email: " . $user->getEmail();
