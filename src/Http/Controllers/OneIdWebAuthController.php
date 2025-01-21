<?php

namespace Ijodkor\OneId\Http\Controllers;

use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\OneId\Http\Requests\OneIdAccessRequest;
use Ijodkor\OneId\Http\Requests\OneIdLoginRequest;
use Ijodkor\OneId\Services\OneIdAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class OneIdWebAuthController extends Controller {
    use RestResponse;

    private string $redirectUrl;

    public function __construct(
        private OneIdAuthService $service
    ) {
        $this->redirectUrl = route('one-id.access');
    }

    public function login(OneIdLoginRequest $request): RedirectResponse {
        try {
            $redirectUrl = $request->get('redirect_url', $this->redirectUrl);
            return redirect($this->service->getAuthorizationServerUrl($redirectUrl));
        } catch (Exception) {
            return redirect()->back();
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
