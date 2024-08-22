<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            $user = User::where('email',$email)->first();
            $value = $request->session()->get('role');
            Auth::login($user);
            return redirect('/dash');
        }else{
            return back()->withErrors(['Invalid credentials!']);
        }
    }
    // public function switchRole($newRole)
    // {
    //     $user = auth()->user();
    //     $user->role = $newRole;
    //     $user->save();

    //     // Optionally, refresh the user's session
    //     auth()->setUser($user);

    //     return redirect()->route('dash'); // Redirect to the dashboard or another destination
    // }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function loginpage(){
        return redirect('/');
    }
}
