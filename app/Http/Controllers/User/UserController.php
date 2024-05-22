<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    public UserService $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the user's profile.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $positions = Position::pluck('name', 'id')->toArray();
        Session::put('positions', $positions);

        $user = auth()->user();
        unset($user->password);

        return view('user.profile')->with('user', $user);
    }

    /**
     * Update the user's profile.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userService->update($request);

        return redirect()->route('user.profile')->with('success', __('messages.update_profile_success'));
    }
}
