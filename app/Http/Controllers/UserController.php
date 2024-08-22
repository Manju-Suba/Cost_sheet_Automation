<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function switchRole(Request $request, $newRole)
    {
        $user = auth()->user();

        if ($user->hasRole($newRole)) {
            // User already has the selected role
            return redirect()->route('dash');
        }

        $user->role = $newRole;
        $user->save();

        // Optionally, refresh the user's session
        auth()->setUser($user);

        return redirect()->route('dash'); // Redirect to the user dashboard or another destination
    }
}
