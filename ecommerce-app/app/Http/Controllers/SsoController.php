<?php

namespace App\Http\Controllers;


use App\Services\SsoService;
use Illuminate\Http\Request;

class SsoController extends Controller
{
    public function ssoLogin(Request $request, SsoService $ssoService)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        return $ssoService->ssoLogin($request);
    }
}
