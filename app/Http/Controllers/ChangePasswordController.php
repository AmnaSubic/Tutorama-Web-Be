<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    /**
     * Process password reset.
     *
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function process(ChangePasswordRequest $request) {
        return $this->getPasswordResetTableRow($request)->count()>0 ? $this->changePassword($request) : $this->tokenNotFoundResponse();
    }

    /**
     * Get row that requested the password reset.
     *
     * @param $request
     * @return Builder
     */
    private function getPasswordResetTableRow($request) {
        return DB::table('password_resets')->where(['Email'=>$request->email,'Token'=>$request->resetToken]);
    }

    /**
     * Response for incorrect token.
     *
     * @return JsonResponse
     */
    private function tokenNotFoundResponse() {
        return response()->json(['error' => 'Token or email is incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Change user password.
     *
     * @param $request
     * @return JsonResponse
     */
    private function changePassword($request) {
        $user = User::whereEmail($request->email)->first();
        $user->update(['Password' => $request->password]);
        $this->getPasswordResetTableRow($request)->delete();
        return response()->json(['data' => 'Password successfully changed'], Response::HTTP_CREATED);
    }
}
