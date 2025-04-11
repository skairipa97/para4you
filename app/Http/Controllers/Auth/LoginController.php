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
  

        $user->save();

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

    /**
     * Update the user profile.
     */
    public function updateProfile(Request $request)
    {
        // Validate the profile update input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'current_password' => 'required|string',
        ]);

        // Only validate password if a new one is provided
        if ($request->filled('new_password')) {
            $request->validate([
                'new_password' => 'required|string|min:8',
                'new_password_confirmation' => 'required|same:new_password',
            ]);
        }

        // Get the logged-in user
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('login')->withErrors(['auth_error' => 'User not found.']);
        }

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if a new one is provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        // Update session data
        session([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}


