<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementUser extends Controller
{
    public function index()
    {
        if (auth()->user()->role == "superadmin") {
            $users = User::all();
            return view('dashboard.user.index', compact('users'));
        } else
            abort(403);
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'      => ['required'],
                'username'  => ['required', 'unique:App\Models\User,username'],
                'email'     => ['email', 'required', 'unique:App\Models\User,email'],
                'password'  => ['required'],
                'role'      => ['required']
            ]
        );

        User::create(
            [
                'name'      => $request->input('name'),
                'username'  => $request->input('username'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'role'      => $request->input('role')
            ]
        );

        return redirect()->route('user.index');
    }

    public function edit()
    {
        return view('dashboard.user.edit');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'              => ['required'],
                'username'          => ['required', 'unique:App\Models\User,username'],
                'email'             => ['email', 'required', 'unique:App\Models\User,email'],
                'password'          => ['required_with:password_confirm', 'same:password_confirm'],
                'password_confirm'  => ['required'],
                'role'              => ['required']
            ]
        );

        User::where('id', $id)->update(
            [
                'name'      => $request->input('name'),
                'username'  => $request->input('username'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]
        );

        if (auth()->user()->role  == "superadmin") {
            User::where('id', $id)->update(
                [
                    'role'  => $request->input('role')
                ]
            );
        }

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        User::where('$id', $id)->delete();
        return redirect()->route('user.index');
    }
}
