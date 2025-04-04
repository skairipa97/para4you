<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('register'); // Registration form view
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // Log the incoming request data
        \Log::info('Request Data:', $request->all());
    
        // Validate form inputs
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'tel' => 'required|string|max:15',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required|in:male,female,secret',
            'privacyPolicy' => 'accepted',
        ], [
            'privacyPolicy.accepted' => 'You must agree to the Privacy Policy to register.',
        ]);
    
        // Log any validation errors
        if ($validator->fails()) {
            \Log::error('Validation Errors:', $validator->errors()->all());
            return back()->withErrors($validator)->withInput();
        }
    
        // Special check for "admin" username
        if ($request->username === 'admin') {
            return back()->withErrors(['username' => 'The username "admin" is reserved.'])->withInput();
        }
    
        // Try creating the user
        try {
            User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'tel' => $request->tel,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error during user creation:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'There was an issue creating your account. Please try again.'])->withInput();
        }
    
        // Log the successful user creation
        \Log::info('User successfully created:', ['username' => $request->username]);
        \Log::info('Hashed Password:', ['password' => Hash::make($request->password)]);

    
        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
}