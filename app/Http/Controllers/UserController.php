<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function profile($id = null)
    {
        if (!$id) {
            abort(400, 'Please provide a valid Id');
        }

        $user = User::find($id);
        if (!$user) {
            abort(403, 'User Not Found');
        }
        $order = Order::where('user_id', $user->id)->count('user_id');
        return view('user.profile', compact('user', 'order'));
    }
    public function editProfile($id = null)
    {
        if (!$id) {
            abort(400, 'Please provide a valid Id');
        }
        $user = User::find($id);

        if (!$user) {
            abort(403, 'User Not Found');
        }

        return view('user.editUserData', compact('user'));
    }
    public function updateProfile(Request $request, $id = null)
    {
        if (!$id) {
            abort(400, 'Please provide a valid Id');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

        ]);

        $user = User::find($id);
        if (!$user) {
            abort(403, 'User Not Found');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('userProfile', $user->id)->with('success', __('messages.userData'));
    }
    public function adminProfile($id = null)
    {
        if (!$id) {
            abort(400, 'Please provide a valid Id');
        }

        $user = User::find($id);
        if (!$user) {
            abort(403, 'User Not Found');
        }
        $order = Order::where('user_id', $user->id)->count('user_id');
        return view('admin.profile.profile', compact('user', 'order'));
    }
    public function editAdminProfile($id = null)
    {
        if (!$id) {
            abort(400, 'Please provide a valid Id');
        }
        $user = User::find($id);

        if (!$user) {
            abort(403, 'User Not Found');
        }

        return view('admin.profile.editUserData', compact('user'));
    }
    public function updateAdminProfile(Request $request, $id = null)
    {
        if (!$id) {
            abort(400, 'Please provide a valid Id');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

        ]);

        $user = User::find($id);
        if (!$user) {
            abort(403, 'User Not Found');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('adminProfile', $user->id)->with('success', __('messages.userData'));
    }
}
