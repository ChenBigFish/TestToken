<?php

require_once "../src/AccessToken2.php";
require_once "../src/EducationTokenBuilder.php";

class EducationTokenBuilderTest
{
    public $appId = "2c914c4d804a4a629a82d5f344e9c66b";
    public $appCertificate = "9544879a63ec4ed79e2943693461e4d9";
    public $expire = 600;
    public $roomUuid = "123";
    public $userUuid = "2882341273";
    public $role = 1;

    public function run()
    {
        $this->test_buildRoomUserToken();
        $this->test_buildUserToken();
        $this->test_buildAppToken();
    }

    public function test_buildRoomUserToken()
    {
        $token = EducationTokenBuilder::buildRoomUserToken($this->appId, $this->appCertificate, $this->roomUuid, $this->userUuid, $this->role, $this->expire);
        $accessToken = new AccessToken2();
        $accessToken->parse($token);

        Util::assertEqual($this->appId, $accessToken->appId);
        Util::assertEqual($this->expire, $accessToken->expire);
        Util::assertEqual($this->roomUuid, $accessToken->services[ServiceEducation::SERVICE_TYPE]->roomUuid);
        Util::assertEqual($this->userUuid, $accessToken->services[ServiceEducation::SERVICE_TYPE]->userUuid);
        Util::assertEqual($this->role, $accessToken->services[ServiceEducation::SERVICE_TYPE]->role);
        Util::assertEqual($this->expire, $accessToken->services[ServiceEducation::SERVICE_TYPE]->privileges[ServiceEducation::PRIVILEGE_ROOM_USER]);
    }

    public function test_buildUserToken()
    {
        $token = EducationTokenBuilder::buildUserToken($this->appId, $this->appCertificate, $this->userUuid, $this->expire);
        $accessToken = new AccessToken2();
        $accessToken->parse($token);

        Util::assertEqual($this->appId, $accessToken->appId);
        Util::assertEqual($this->expire, $accessToken->expire);
        Util::assertEqual($this->userUuid, $accessToken->services[ServiceEducation::SERVICE_TYPE]->userUuid);
        Util::assertEqual("", $accessToken->services[ServiceEducation::SERVICE_TYPE]->roomUuid);
        Util::assertEqual(-1, $accessToken->services[ServiceEducation::SERVICE_TYPE]->role);
        Util::assertEqual($this->expire, $accessToken->services[ServiceEducation::SERVICE_TYPE]->privileges[ServiceEducation::PRIVILEGE_USER]);
    }

    public function test_buildAppToken()
    {
        $token = EducationTokenBuilder::buildAppToken($this->appId, $this->appCertificate, $this->expire);
        $accessToken = new AccessToken2();
        $accessToken->parse($token);

        Util::assertEqual($this->appId, $accessToken->appId);
        Util::assertEqual($this->expire, $accessToken->expire);
        Util::assertEqual($this->expire, $accessToken->services[ServiceEducation::SERVICE_TYPE]->privileges[ServiceEducation::PRIVILEGE_APP]);

        Util::assertEqual("", $accessToken->services[ServiceEducation::SERVICE_TYPE]->roomUuid);
        Util::assertEqual("", $accessToken->services[ServiceEducation::SERVICE_TYPE]->userUuid);
        Util::assertEqual(-1, $accessToken->services[ServiceEducation::SERVICE_TYPE]->role);
    }
}

$educationTokenBuilderTest = new EducationTokenBuilderTest();
$educationTokenBuilderTest->run();