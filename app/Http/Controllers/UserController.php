<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        session()->flash('status_message', "Thank you for registering, please login");

        return redirect('/');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function logOn(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $query = Gallery::query();
            $galleries = $query
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            session()->put('user_id', $user->id);
            return redirect('/')->with(compact('user', 'galleries'));
        }
        return redirect()->back()->withErrors('invalid credentials');
    }

    public function logOff()
    {

        Auth::logout();
        session()->flush();
        return redirect('/');
    }

    public function profile($id)
    {
        $user = Auth::user();
        return view('pages.change-password', compact('user'));
    }

    public function update(UpdateRequest $request)
    {
        // dd($request);
        $id = Auth::user()->id;
        $user = User::find($id);
        $valid = $request->validated();
        if ($valid) {
            foreach ($valid as $key => $value) {
                if ($value === null || $value === '') {
                    unset($valid[$key]);
                }
            }
            $user->update($valid);
            session()->flash('status_message', "Profile updated successfully");
            return redirect()->back();
        }
    }
}
