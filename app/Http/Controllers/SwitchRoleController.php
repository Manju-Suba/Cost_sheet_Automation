<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class SwitchRoleController extends Controller
{
    public function __invoke(Role $role)
    {
        dd($role);
        abort_unless(auth()->user()->hasRole($role), 404);

        auth()->user()->update(['current_role_id' => $role->id]);

        return to_route('dash'); // Replace this with your own home route
    }
      public function switchRole($newRole)
    {
        $user = auth()->user();
        $user->role = $newRole;
        $user->save();

        // Optionally, refresh the user's session
        auth()->setUser($user);

        return redirect()->route('dash'); // Redirect to the dashboard or another destination
    }

}
