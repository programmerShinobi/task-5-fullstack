<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'u3ynfwIXsq5XhsaQByQd801HGO60dMXnrR241VHI',
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $requestToken = Request::create(env('APP_URL') . '/oauth/token', 'post');
        return Route::dispatch($requestToken);
    }

    public function destroy(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->noContent();
    }
}
