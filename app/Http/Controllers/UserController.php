<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(Request $request)
    {
        // Active users
        $users = User::where("status", 1)->get();

        return view('pages.users.view', compact('users'));
    }

    public function show_addUser(Request $request)
    {
        $roles = map_options(Role::class, 'role_id', 'description');
        return view('pages.users.addUser', compact('roles'));
    }

    // Add a new user
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'emailaddress' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create the user
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'emailaddress' => $request->emailaddress,
            'password' => Hash::make($request->password),
            'role' => (int)$request->role,  
            'status' => 1, 
        ]);

        return redirect()->route('users')->with('success', 'Successfully Added', 200);
    }

    // Show details of a user 
    public function details($id)
    {
        $userDetails = User::find($id);
        $roles = map_options(Role::class, 'role_id', 'description');
        //dd($userDetails);
        if ($userDetails) {
            return view('pages.users.editUser', compact('userDetails', 'roles'));
        }

        return redirect()->back()->with('error', 'User doesn\'t exist');
    }

     // Edit user details
     public function edit(Request $request, $id)
     {
         $user = User::find($id);
 
         if (!$user) {
             return redirect()->back()->with('error', 'User doesn\'t exist');
         }
 
         $request->validate([
             'firstname' => 'nullable|string|max:255',
             'lastname' => 'nullable|string|max:255',
             'username' => 'nullable|string|max:255|unique:users,username,' . $id,
             'emailaddress' => 'nullable|email|unique:users,emailaddress,' . $id,
             'role' => 'nullable|integer',
         ]);
 
         $user->update([
             'firstname' => $request->firstname,
             'lastname' => $request->lastname,
             'username' => $request->username,
             'emailaddress' => $request->emailaddress,
             'role' => $request->role,
         ]);
 
         return redirect()->route('users')->with('success', 'User updated successfully');
     }

    // disabled user acct
    public function disable($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User doesn\'t exist');
        }

        $user->update([
            'status' => 2,
        ]);

        return redirect()->route('users')->with('success', 'User account successfully disabled.');
    }
}
