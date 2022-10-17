<?php

require_once "../src/AccessToken2.php";
require_once "../src/RtmTokenBuilder2.php";

class RtmTokenBuilder2Test
{
    public $appId = "2c914c4d804a4a629a82d5f344e9c66b";
    public $appCertificate = "9544879a63ec4ed79e2943693461e4d9";
    public $expire = 600;
    public $userId = "test_user";

    public function run()
    {
        $this->test_buildToken();
    }

    public function test_buildToken()
    {
        $token = RtmTokenBuilder2::buildToken($this->appId, $this->appCertificate, $this->userId, $this->expire);
        $accessToken = new AccessToken2();
        $accessToken->parse($token);

        Util::assertEqual($this->appId, $accessToken->appId);
        Util::assertEqual($this->expire, $accessToken->expire);
        Util::assertEqual($this->userId, $accessToken->services[ServiceRtm::SERVICE_TYPE]->userId);
        Util::assertEqual(ServiceRtm::SERVICE_TYPE, $accessToken->services[ServiceRtm::SERVICE_TYPE]->type);
        Util::assertEqual($this->expire, $accessToken->services[ServiceRtm::SERVICE_TYPE]->privileges[ServiceRtm::PRIVILEGE_LOGIN]);
    }
}

$rtmTokenBuilder2Test = new RtmTokenBuilder2Test();
$rtmTokenBuilder2Test->run();