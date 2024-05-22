<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Services\UserService;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showForm(): View
    {
        $positions = Position::pluck('name', 'id')->toArray();
        Session::put('positions', $positions);
        return view('auth.register-info');
    }

    /**
     * Store user information in session and redirect to confirmation page.
     *
     * @param  CreateUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function info(CreateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();
        Session::flash('step', 'info');
        Session::flash('register', $validatedData);
        return redirect()->route('auth.register.confirm');
    }

    /**
     * Display the confirmation page.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showConfirm(): View|RedirectResponse
    {
        if (Session::get('step') !== 'info') {
            return redirect()->route('auth.register.info');
        }
        return view('auth.register-confirm');
    }

    /**
     * Confirm registration and redirect to completion page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(): RedirectResponse
    {
        $registerData = Session::get('register');
        Session::flash('username', $registerData['username']);
        $this->userService->create($registerData);
        Session::flash('step', 'confirm');
        Session::forget('register');
        return redirect()->route('auth.register.complete');
    }

    /**
     * Display the registration completion page.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showComplete(): View|RedirectResponse
    {
        if (Session::get('step') !== 'confirm') {
            return redirect()->route('auth.register.info');
        }
        return view('auth.register-complete');
    }

    /**
     * Process user login.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user && $user->hasRole('admin')) {
                return redirect()->route('admin.post.index');
            } elseif ($user && $user->hasRole('user')) {
                return redirect()->route('user.post.index', ['author' => 'all'])->with('success', __('messages.login_success'));
            }
        }
        return redirect()->route('auth.showLogin')->withErrors([
            'email' => __('messages.invalid-account'),
        ]);
    }

    /**
     * Logout the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth('web')->logout();
        return redirect()->route('auth.login')->with("success", __('messages.logout_success'));
    }
}
