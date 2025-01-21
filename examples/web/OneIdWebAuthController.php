<?php

namespace App\Http\Controllers\OneId;

use Exception;
use Ijodkor\OneId\Http\Requests\OneIdAccessRequest;
use Ijodkor\OneId\Services\OneIdService;
use Illuminate\Routing\Controller;

class OneIdWebAuthController extends Controller {

    public function __construct(
        private OneIdService $oneIdService
    ) {
    }

    public function access(OneIdAccessRequest $request) {
        try {
            $userInfo = $this->oneIdService->getUser($request->validated());

            /* Write your logic here */

            return $userInfo;

            /* Write your logic here */
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
