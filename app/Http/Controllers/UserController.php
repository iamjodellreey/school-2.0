<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // TODO: Move to another place
    private array $roles = [
        '1' => 'admin',
        '2' => 'operator',
        '3' => 'user',
    ];

    public function index()
    {
        $user = User::find(auth()->id());

        $data['allData'] = $user->admin()->get();

        return view('user.index', [
            'allData' => $data['allData'],
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $code = rand(0000,9999);

        User::create([
            'usertype' => 'Admin',
            'role' => $this->roles[$data['role']],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($code),
            'code' => $code,
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $this->roles[$data['role']],
        ]);

        return redirect()->route('users.index');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
