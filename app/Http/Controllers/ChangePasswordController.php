<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request) {
        return $this->getPasswordResetTableRow($request)->count()>0 ? $this->changePassword($request) : $this->tokenNotFoundResponse();
    }

    private function getPasswordResetTableRow($request) {
        return DB::table('password_resets')->where(['Email'=>$request->email,'Token'=>$request->resetToken]);
    }

    private function tokenNotFoundResponse() {
        return response()->json(['error' => 'Token or email is incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function changePassword($request) {
        $user = User::whereEmail($request->email)->first();
        $user->update(['Password' => $request->password]);
        $this->getPasswordResetTableRow($request)->delete();
        return response()->json(['data' => 'Password successfully changed'], Response::HTTP_CREATED);
    }
}
