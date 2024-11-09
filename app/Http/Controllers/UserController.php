<?php

namespace App\Http\Controllers;

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

        return view('show.users', compact('users'));
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
            'status' => 'required|string',
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
            'status' => (int)$request->status, 
        ]);

        return redirect()->route('users')->with('success', 'Successfully Added', 200);
    }

    // Show details of a user 
    public function details($id)
    {
        $userDetails = User::find($id);

        if ($userDetails) {
            return view('user.details', compact('userDetails'));
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
             'firstname' => 'required|string|max:255',
             'lastname' => 'required|string|max:255',
             'username' => 'required|string|max:255|unique:users,username,' . $id,
             'emailaddress' => 'required|email|unique:users,emailaddress,' . $id,
             'role' => 'required|integer',
             'status' => 'required|integer',
         ]);
 
         $user->update([
             'firstname' => $request->firstname,
             'lastname' => $request->lastname,
             'username' => $request->username,
             'emailaddress' => $request->emailaddress,
             'role' => $request->role,
             'status' => $request->status,
         ]);
 
         return redirect()->route('users')->with('success', 'User updated successfully');
     }

    // Delete a user
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User doesn\'t exist');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
}
