<?php
include("../src/RtmTokenBuilder2.php");

$appId = "2c914c4d804a4a629a82d5f344e9c66b";
$appCertificate = "9544879a63ec4ed79e2943693461e4d9";
$user = "2882341273";
$expireTimeInSeconds = 3600;

$token = RtmTokenBuilder2::buildToken($appId, $appCertificate, $user, $expireTimeInSeconds);
echo 'Rtm Token: ' . $token . PHP_EOL;

?>