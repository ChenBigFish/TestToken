<?php
include("../src/RtmTokenBuilder.php");

$appID = "2c914c4d804a4a629a82d5f344e9c66b";
$appCertificate = "9544879a63ec4ed79e2943693461e4d9";
$user = "test_user_id";
$role = RtmTokenBuilder::RoleRtmUser;
$expireTimeInSeconds = 3600;
$currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
$privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

$token = RtmTokenBuilder::buildToken($appID, $appCertificate, $user, $role, $privilegeExpiredTs);
echo 'Rtm Token: ' . $token . PHP_EOL;

?>