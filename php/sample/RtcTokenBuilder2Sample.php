<?php
include("../src/RtcTokenBuilder2.php");

$appId = "2c914c4d804a4a629a82d5f344e9c66b";
$appCertificate = "9544879a63ec4ed79e2943693461e4d9";
$channelName = "room";
$uid = 2882341273;
$uidStr = "2882341273";
$tokenExpirationInSeconds = 3600;
$privilegeExpirationInSeconds = 3600;

$token = RtcTokenBuilder2::buildTokenWithUid($appId, $appCertificate, $channelName, $uid, RtcTokenBuilder2::ROLE_PUBLISHER, $tokenExpirationInSeconds, $privilegeExpirationInSeconds);
echo 'Token with int uid: ' . $token . PHP_EOL;

$token = RtcTokenBuilder2::buildTokenWithUserAccount($appId, $appCertificate, $channelName, $uidStr, RtcTokenBuilder2::ROLE_PUBLISHER, $tokenExpirationInSeconds, $privilegeExpirationInSeconds);
echo 'Token with user account: ' . $token . PHP_EOL;

$token = RtcTokenBuilder2::buildTokenWithUidAndPrivilege($appId, $appCertificate, $channelName, $uid, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds);
echo 'Token with int uid and privilege: ' . $token . PHP_EOL;

$token = RtcTokenBuilder2::buildTokenWithUserAccountAndPrivilege($appId, $appCertificate, $channelName, $uidStr, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds);
echo 'Token with user account and privilege: ' . $token . PHP_EOL;