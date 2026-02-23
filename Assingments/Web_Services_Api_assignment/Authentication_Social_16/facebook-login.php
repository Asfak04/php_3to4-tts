<?php
require 'config.php';

use League\OAuth2\Client\Provider\Facebook;

$provider = new Facebook([
    'clientId'          => $facebookClientId,
    'clientSecret'      => $facebookClientSecret,
    'redirectUri'       => $facebookRedirectUri,
    'graphApiVersion'   => 'v18.0',
]);

$authUrl = $provider->getAuthorizationUrl(['scope' => ['email']]);

$_SESSION['oauth2state'] = $provider->getState();

header('Location: ' . $authUrl);
exit;
