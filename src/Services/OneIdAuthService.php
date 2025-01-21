<?php

namespace Ijodkor\OneId\Services;

use Ijodkor\OneId\Entities\OneId;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OneIdAuthService {
    private string $authorizationUrl;
    private string $clientId;
    private string $clientSecret;
    private string $scope;
    private string $state;

    public function __construct() {
        $this->authorizationUrl = config('integration.one_id_sso_url');
        $this->clientId = config('integration.one_id_client_id');
        $this->clientSecret = config('integration.one_id_client_secret');

        $this->scope = config('integration.one_id_client_scope') ?: OneId::SCOPE;
        $this->state = config('integration.one_id_client_state') ?: OneId::STATE;
    }

    public function getAuthorizationServerUrl(string $redirectUrl): string {
        return $this->authorizationUrl . '?' . http_build_query([
                'response_type' => OneId::RESPONSE_TYPE,
                'client_id' => $this->clientId,
                'redirect_uri' => $redirectUrl,
                'scope' => $this->scope,
                'state' => $this->state
            ]);
    }

    /**
     * @throws ConnectionException
     */
    public function getAccessToken(string $code, string $redirectUrl) {
        $response = Http::asForm()->post($this->authorizationUrl, [
            'grant_type' => OneId::GRANT_TYPE_AUTHORIZATION_CODE,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $redirectUrl,
            'code' => $code
        ]);

        return $response->json();
    }
}
