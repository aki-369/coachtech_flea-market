<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // プロフィール編集フォームの表示
    public function showEditForm()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // プロフィール変更処理
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('mypage')->with('success', 'Profile updated successfully');
    }
}
