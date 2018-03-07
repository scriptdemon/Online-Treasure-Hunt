<!DOCTYPE html>
<html>
<head>
  <title>Online Treasure Hunt</title>
  <link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body id='main_body'>
<h1 style="text-align:center;font-family:hack;font-size:50px;">ONLINE TREASURE HUNT</h1>
<?php

require_once __DIR__.'/gplus-lib/vendor/autoload.php';

const CLIENT_ID = '916447758038-badsfmji5vf838bruvgpiacvjjchv4rh.apps.googleusercontent.com';
const CLIENT_SECRET = 'Bhjr0PTMmuCg92MWz2vnvaxL';
const REDIRECT_URI = 'http://ieeevesit.org/oth2k17';

session_start();

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes('email');

$plus = new Google_Service_Plus($client);

if (isset($_REQUEST['logout'])) {
   session_unset();
}


if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $me = $plus->people->get('me');

  $_SESSION['id'] = (string)$me['id'];
  $_SESSION['name'] = (string)$me['displayName'];
  $_SESSION['email'] = (string)$me['emails'][0]['value'];
  $_SESSION['profile_url'] = (string)$me['url'];
  header('Location: home.php');

} else {
  // get the login url   
  $authUrl = $client->createAuthUrl();
}


?>

<div>
    <?php
    if (isset($authUrl)) {
      ?>
      <div class="row">
        <div class="col-lg-8" style="text-align:center;margin-top:100px;">
        <a class='login' href="<?php echo $authUrl;?>"><img src='gplus-lib/signin_button.png' height='50px'/></a>
        <p style="color:white;">&copy;2017 IEEE-VESIT ALL RIGHTS RESERVED</p>
        </div>
      </div>
    <?php
    }

    ?>
</div>
</body>
</html>

