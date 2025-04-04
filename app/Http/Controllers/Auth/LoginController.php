<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login'); // This will load the login view
    }
    public function login(Request $request)
    {
        // Validate the login input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the user by username
  
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            logger("User not found with username: {$request->username}");
            return back()->withErrors(['login_error' => 'Invalid username or password.'])->withInput();
        }
        
        if (!Hash::check($request->password, $user->password)) {
            logger("Password mismatch for username: {$user->username}, Input: {$request->password}, Hashed: {$user->password}");
            return back()->withErrors(['login_error' => 'Invalid username or password.'])->withInput();
        }
        
        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Store user data in session
            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->username === 'admin', // Check if user is admin
            ]);

            // Redirect based on username
            if ($user->username === 'admin') {
                return redirect()->route('admin'); // Redirect to the admin dashboard
            } else {
                return redirect()->route('welcome'); // Redirect to the welcome page
            }
        }

        // If authentication fails
        return back()->withErrors([
            'login_error' => 'Invalid username or password.',
        ])->withInput();
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        session()->flush(); // Clear the session
        return redirect()->route('login'); // Redirect to the login page
    }
}


