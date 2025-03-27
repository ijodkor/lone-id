<?php

namespace Ijodkor\OneId\Services;

use Ijodkor\OneId\Exceptions\OneIdException;
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
     * @throws OneIdException
     */
    public function getUser(array $data) {
        $redirectUrl = Arr::get($data, 'redirect_url', route('one-id.access'));
        $code = Arr::get($data, 'code');

        // Get access token
        $token = $this->oneIdAuthService->getAccessToken($code, $redirectUrl);
        $accessToken = Arr::get($token, 'access_token');
        if (!$accessToken) {
            throw new OneIdException("Unable to get OneId access token", 400);
        }

        // Get user info
        return $this->oneIdUserService->getUserInfo($accessToken);
    }
}
