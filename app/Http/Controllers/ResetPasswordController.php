<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /**
     * Send function that handles the password reset request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendEmail(Request $request) {
        if(!$this->validateEmail($request->email)) {
            return $this->failedResponse();
        }

        $this->send($request->email);
        return $this->successResponse();
    }

    /**
     * Send email for password reset.
     *
     * @param $email
     */
    public function send($email) {
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    /**
     * Create a token for password reset.
     *
     * @param $email
     * @return mixed|string
     */
    public function createToken($email) {
        $oldToken = DB::table('password_resets')->where('Email', $email)->first();
          if ($oldToken != null) {
            return $oldToken->Token;
         }

        $token = Str::random(60);
        $this->saveToken($token, $email);
        return $token;
    }

    /**
     * Save token for password reset.
     *
     * @param $token
     * @param $email
     */
    public function saveToken($token, $email) {
        DB::table('password_resets')->insert([
            'Email' => $email,
            'Token' => $token,
            'Created_at' => Carbon::now()
        ]);
    }

    /**
     * Handle not existing email error.
     *
     * @return JsonResponse
     */
    public function failedResponse() {
        return response()->json([
            'error' => 'Email does not exist'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Handle existing email response.
     *
     * @return JsonResponse
     */
    public function successResponse() {
        return response()->json([
            'data' => 'Reset email is sent. Please check your inbox.'
        ], Response::HTTP_OK);
    }

    /**
     * Validate email.
     *
     * @param $email
     * @return bool
     */
    public function validateEmail($email) {
        return !!User::where('Email', $email)->first();
    }
}
