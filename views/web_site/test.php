
<?php
session_start();
require_once 'vendor/autoload.php';

$id_token = filter_input(INPUT_POST, 'id_token');
define('CLIENT_ID', '495315229122-bpud393l4rlnj8fab8qctujkkmfgmggv.apps.googleusercontent.com');

$client = new Google_Client(['client_id' => CLIENT_ID]);
$payload = $client->verifyIdToken($id_token);
if ($payload) {
    $userid = $payload['sub'];
}

//DBなどとのやりとりする

$_SESSION['login'] = true;
exit;
?>
