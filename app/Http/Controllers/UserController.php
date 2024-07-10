<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('email', 'like', "%{$request->keyword}%")
                ->orWhere('phone', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $user = User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // edit
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        $user->role = $request->role;
        $user->save();

        // update password
        if ($request->phone) {
            $user->update (['phone'=> $request->phone]);
        }


        if ($request->password) {
            $user->update (['password'=> Hash::make($request->password)]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // delete
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','Deleted successfully');
    }

    // public function changePassword(Request $request, User $user)
    // {
    //     $user->password = Hash::make($request->password);
    //     $user->save();
    // }
}
