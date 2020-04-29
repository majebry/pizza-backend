<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;

class AuthController extends AccessTokenController
{
    /**
     * Login user by passing their credentials to passport' issueToken method
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        // validate the request
        (new Request($request->getParsedBody()))->validate([
            'username'  =>  'required|email',
            'password'  =>  'required'
        ]);

        // build passport server request
        $request  = $request->withParsedBody($request->getParsedBody() + [
            'provider'          =>  'users',
            'grant_type'        =>  'password',
            'client_id'         =>  config('passport_client.id'),
            'client_secret'     =>  config('passport_client.secret'),
        ]);

        return parent::issueToken($request);
    }

    public function logout()
    {
        auth()->user()->tokens()->each(function($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
