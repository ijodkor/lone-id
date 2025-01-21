<?php

namespace Ijodkor\OneId\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Arr;

class OneIdService {

    public function __construct(
        private OneIdAuthService $oneIdAuthService,
        private OneIdUserService $oneIdUserService
    ) {
    }

    /**
     * @throws ConnectionException
     */
    public function getUser(array $data) {
        $redirectUrl = Arr::get($data, 'redirect_url', route('one-id.access'));
        $code = Arr::get($data, 'code');

        // Get access token
        $token = $this->oneIdAuthService->getAccessToken($code, $redirectUrl);
        $accessToken = Arr::get($token, 'access_token');

        // Get user info
        return $this->oneIdUserService->getUserInfo($accessToken);
    }
}
