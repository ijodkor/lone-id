<?php

namespace Ijodkor\OneId\Services;

use Ijodkor\OneId\Entities\OneId;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OneIdUserService {
    private string $authorizationUrl;
    private string $clientId;
    private string $clientSecret;
    private string $scope;

    public function __construct() {
        $this->authorizationUrl = config('integration.one_id_sso_url');
        $this->clientId = config('integration.one_id_client_id');
        $this->clientSecret = config('integration.one_id_client_secret');

        $this->scope = OneId::SCOPE;
    }

    /**
     * @throws ConnectionException
     */
    public function getUserInfo(string $accessToken, ?string $scope = null) {
        $result = Http::asForm()->post($this->authorizationUrl, [
            'grant_type' => OneId::GRANT_TYPE_ACCESS_TOKEN_IDENTIFY,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'access_token' => $accessToken,
            'scope' => $scope ?: $this->scope
        ]);

        return $result->json();
    }
}
