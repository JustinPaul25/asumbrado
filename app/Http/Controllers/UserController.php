<?php

namespace App\Http\Controllers;

use App\User;
use App\Types\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserCollection;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = User::query();
        if($request->filled('search')) {
            $users = User::where('name', 'LIKE', '%'.$request->input('search').'%')
            ->orWhere('username', 'LIKE', '%'.$request->input('search').'%');
        }
        if($request->filled('role')) {
            if($request->input('role') == "Administrator") {
                $users = $users->role('Administrator');
            } else if ($request->input('role') == "Mid") {
                $users = $users->role('Mid');
            } else {
                $users = $users->role('Viewonly');
            }
        }
        
        $users = $users->paginate(20);
        return new UserCollection($users);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        if($request->input('role') == 'Administrator') {
            $user->assignRole(RoleType::ADMINISTRATOR);
        }else if($request->input('role') == 'Mid') {
            $user->assignRole(RoleType::MID);
        } else {
            $user->assignRole(RoleType::VIEWONLY);
        }

        return $user;
    }

    public function update(User $user, Request $request)
    {

        $user->update([
            'name' => $request->input('name'),
            'username' => $request->input('username')
        ]);

        $user->removeRole($user->roles[0]->name);

        if($request->input('role') == 'Administrator') {
            $user->assignRole(RoleType::ADMINISTRATOR);
        }else if($request->input('role') == 'Mid') {
            $user->assignRole(RoleType::MID);
        } else {
            $user->assignRole(RoleType::VIEWONLY);
        }

        return response()->json('updated successfully');
    }

    public function destroy(User $user)
    {
        return response()->json(
            $user->delete()
        );
    }
}
