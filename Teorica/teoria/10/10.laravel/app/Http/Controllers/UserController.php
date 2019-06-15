<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::All();
        $pagetitle = "List of Users";
        return view('users.list', compact('users', 'pagetitle'));
    }

    public function create()
    {
        $pagetitle = "Add user";
        return view('users.create', compact('pagetitle'));
    }

    public function store(Request $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }
        $user = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'age' => 'required|integer|between:1,120',
        ], [  // Custom Messages
            'name.regex' => 'Name must only contain letters and spaces.',
        ]);
        // if any error, automatic redirect to back (previous)
        // in this case, goes to "/users/create"
        // Error messages are automatically flashed to the session.
        User::create($user);
        return redirect()->action('UserController@index');
    }

    public function edit($id)
    {
        $pagetitle = "Edit user";
        $user = User::findOrFail($id);
        return view('users.edit', compact('pagetitle', 'user'));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }
        $user = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'age' => 'required|integer|between:1,120',
        ], [  // Custom Messages
            'name.regex' => 'Name must only contain letters and spaces.',
        ]);
        $userModel = User::findOrFail($id);
        $userModel->fill($user);
        $userModel->save();
        return redirect()->action('UserController@index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->action('UserController@index');
    }

}
