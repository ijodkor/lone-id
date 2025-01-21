<?php

namespace Ijodkor\OneId\Rest\Controllers;

use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\OneId\Http\Requests\OneIdAccessRequest;
use Ijodkor\OneId\Http\Requests\OneIdLoginRequest;
use Ijodkor\OneId\Services\OneIdAuthService;
use Ijodkor\OneId\Services\OneIdUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OneIdAuthController extends Controller {
    use RestResponse;

    private string $redirectUrl;

    public function __construct(
        private OneIdAuthService $service,
        private OneIdUserService $authService
    ) {
        $this->redirectUrl = route('one-id.access-code');
    }

    public function login(OneIdLoginRequest $request): JsonResponse {
        try {
            $redirectUrl = $request->get('redirect_url', $this->redirectUrl);
            return $this->success([
                'url' => $this->service->getAuthorizationServerUrl($redirectUrl)
            ]);
        } catch (Exception $ex) {
            return $this->fail(message: $ex->getMessage());
        }
    }

    public function token(OneIdAccessRequest $request): JsonResponse {
        try {
            $redirectUrl = $request->get('redirect_url', $this->redirectUrl);
            $token = $this->service->getAccessToken($request->get('code'), $redirectUrl);

            return $this->success([
                'token' => $token,
            ]);
        } catch (Exception $ex) {
            return $this->fail(message: $ex->getMessage());
        }
    }

    public function access(OneIdAccessRequest $request): JsonResponse {
        try {
            return $this->success([
                'code' => $request->get('code')
            ]);
        } catch (Exception $ex) {
            return $this->fail(message: $ex->getMessage());
        }
    }

    public function logout(): JsonResponse {
        try {
            return $this->success();
        } catch (Exception) {
            return $this->fail(message: "Incorrect data format!");
        }
    }
}
