<?php

namespace App\Http\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserService
{
    /**
     * Create a new user.
     *
     * @param array<string, string>  $request
     * @return \App\Models\User
     */
    public function create(array $request): User
    {
        // Encrypt the password before storing
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request);

        $userRole = Role::where('name', 'user')->first();
        $user->roles()->attach($userRole);

        event(new Registered($user));

        return $user;
    }

    /**
     * Update an existing user.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \App\Models\User
     */
    public function update(UpdateUserRequest $request): User
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Find the user by ID
        $userDb = User::findOrFail($validatedData['id']);

        // Update user details
        $userDb->username = $validatedData['username'];
        $userDb->gender = $validatedData['gender'];
        $userDb->phone = $validatedData['phone'];
        $userDb->address = $validatedData['address'];
        $userDb->position_id = $validatedData['position_id'];
        if (!empty($validatedData['avatar'])) {
            $userDb->avatar = $validatedData['avatar']; // Assuming you're updating the avatar path
        }
        // Update the password only if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed'
            ]);
            $userDb->password = bcrypt($request['password']); // Hash the new password
        }

        $userDb->save();
        return $userDb;
    }
}
