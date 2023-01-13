<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $model = User::find(auth()->user()->id);
        $model->name = $request->input('name');
        $model->save();

        return redirect()->route('account')->with('status', 'Update Profile successfully.');
    }
}
