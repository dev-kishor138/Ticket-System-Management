<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // Retrieve user by email
        // $user = User::where('email', $request->email)->latest()->first();

        // // Check if user exists and verify the password using Hash::check
        // if ($user && Hash::check($request->password, $user->password)) {
        //     // Redirect based on the user's role
        //     if ($user->role === 'admin') {
        //         return redirect('/admin/dashboard');
        //     } else {
        //         return redirect('/user/dashboard');
        //     }
        // } else {
        //     return response()->json(['error' => 'Invalid credentials'], 404);
        // }
    }
}
