<?php

namespace App\Http\Controllers\Api\OneId;

use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\OneId\Http\Requests\OneIdAccessRequest;
use Ijodkor\OneId\Services\OneIdService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OneIdAuthController extends Controller {
    use RestResponse;

    public function __construct(
        private OneIdService $oneIdService
    ) {
    }

    public function token(OneIdAccessRequest $request): JsonResponse {
        try {
            $userInfo = $this->oneIdService->getUser($request->validated());

            /* Write your logic here */

            return $this->success([
                'token' => "",
                'user' => $userInfo
            ]);

            /* Write your logic here */
        } catch (Exception $ex) {
            return $this->fail(message: $ex->getMessage());
        }
    }
}
