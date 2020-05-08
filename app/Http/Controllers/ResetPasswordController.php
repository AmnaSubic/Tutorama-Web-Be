<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request) {
        if(!$this->validateEmail($request->email)) {
            return $this->failedResponse();
        }

        $this->send($request->email);
        return $this->successResponse();
    }

    public function send($email) {
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    public function createToken($email) {
        $oldToken = DB::table('password_resets')->where('Email', $email)->first();
          if ($oldToken != null) {
            return $oldToken->Token;
         }

        $token = Str::random(60);
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email) {
        DB::table('password_resets')->insert([
            'Email' => $email,
            'Token' => $token,
            'Created_at' => Carbon::now()
        ]);
    }

    public function failedResponse() {
        return response()->json([
            'error' => 'Email does not exist'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse() {
        return response()->json([
            'data' => 'Reset email is sent. Please check your inbox.'
        ], Response::HTTP_OK);
    }

    public function validateEmail($email) {
        return !!User::where('Email', $email)->first();
    }
}
