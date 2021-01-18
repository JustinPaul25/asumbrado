<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('id', auth()->id())->first();

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return view('password');
    }
}
