<?php
require('../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$appId = getenv('PUSHER_APP_ID');
$appKey = getenv('PUSHER_APP_KEY');
$appSecret = getenv('PUSHER_APP_SECRET');

$pusher = new Pusher($appKey, $appSecret, $appId);

$channelName = $_POST['channel_name'];
$socketId = $_POST['socket_id'];

/*
TODO: implement checks to determine if the user is:
1. Authenticated with the app
2. Allowed to subscribe to the $channelName
3. Sanitize any additional data that has been recieved and is to be used

If so, proceed...
*/

$userId = uniqid('user_');
$userInfo = [
  'website' => 'http://www.leggetter.co.uk',
  'company' => 'Pusher',
  'job_title' => 'Head of Developer Relations',
  'is_active' => true,
  'email' => 'phil@pusher.com'
];

$auth = $pusher->presence_auth($channelName, $socketId, $userId, $userInfo);

header('Content-Type: application/json');
echo($auth);