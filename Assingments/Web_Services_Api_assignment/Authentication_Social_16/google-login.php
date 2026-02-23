<?php
require 'config.php';

use League\OAuth2\Client\Provider\Google;

$provider = new Google([
    'clientId' => $googleClientId,
    'clientSecret' => $googleClientSecret,
    'redirectUri' => $googleRedirectUri,
]);

$authUrl = $provider->getAuthorizationUrl();

$_SESSION['oauth2state'] = $provider->getState();

header('Location: ' . $authUrl);
exit;
?>