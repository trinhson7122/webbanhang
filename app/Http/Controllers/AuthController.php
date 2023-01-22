<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\LoginRequest;
use App\Models\Provide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function userLogin()
    {
        $title = 'Login';
        return view('auth.login', ['title' => $title]);
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('index');
    }

    public function adminLogin()
    {
        $title = 'Admin Login';
        return view('auth.adminLogin', ['title' => $title]);
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('admin.index');
    }

    public function processAdminLogin(LoginRequest $request)
    {
        $validated = $request->validated();
        $remember = false;
        if($request->has('remember')){
            $remember = true;
        }
        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember)){
            if(auth()->user()->role == UserRole::Client){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return to_route('auth.admin_login')->with('message', 'Sai tài khoản hoặc mật khẩu');
            }
            $request->session()->regenerate();
            return to_route('admin.index');
        }
        return to_route('auth.admin_logining')->with('message', 'Sai tài khoản hoặc mật khẩu');
    }

    public function processUserLogin(LoginRequest $request)
    {
        $validated = $request->validated();
        $remember = false;
        if($request->has('remember')){
            $remember = true;
        }
        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return to_route('auth.login')->with('message', 'Sai tài khoản hoặc mật khẩu');
    }

    public function socialiteRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function socialiteCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();
        
        $provide_id = Provide::query()->where('name', '=', $provider)->get()->first()->id;
        $user = User::query()->where('email', '=', $socialiteUser->getEmail())
                ->where('provide_id', '=', $provide_id)->get()->first();
        if(!$user)
        {
            $user = User::query()->create([
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'provide_id' => $provide_id,
                'image' => $socialiteUser->getAvatar(),
                'access_token' => $socialiteUser->token,
            ]);
        }
        Auth::login($user);
        return redirect()->intended('/');
    }
}