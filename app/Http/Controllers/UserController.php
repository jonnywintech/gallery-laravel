<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        if ($data) {
            $user = User::create($data);
            Mail::to($user->email, 'godamit')->send(new VerificationMail($user));
            session()->flash('status_message', "Thank you for registering, check your email for verification instructions");

            return redirect('/');
        }
        session()->flash('status_message', "Invalid Data");

        return redirect('/register');
    }

    public function validateEmail($id)
    {
        $user = User::findOrFail($id);

        $user->is_verified = true;

        $user->remember_token =  Str::random(10);

        $user->email_verified_at = now();

        $user->save();

        return redirect('/login');
    }

    public function verification()
    {

        return view('pages.verify-email');
    }

    public function resendEmail()
    {
        $user = Auth::user();
        Mail::to($user->email, 'godamit')->send(new VerificationMail($user));
            session()->flash('status_message', "Email sent again, check your email for verification instructions");
        return redirect()->back();
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
