<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $routeurl="/";

        $request->session()->regenerate();

        if($request->user()->role=="admin"){
             $routeurl="dashboard";

        }
        else if($request->user()->role=="manager"){
             $routeurl="managerdashbaord";

        }
         else if($request->user()->role=="agent"){
             $routeurl="agentdashbaord";
        }

        else if($request->user()->role=="user"){
            $routeurl="userdashbaord";
        }

         else if($request->user()->role=="member"){

            $routeurl="memberdashbaord";

        }

        return redirect()->intended($routeurl);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
