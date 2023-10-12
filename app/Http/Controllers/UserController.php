<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function index()
    {

    }

   public function store(RegisterRequest $request)
   {
         $data = $request->validated();
         User::create($data);
         session()->flash('status_message',"Thank you for registering, please login");
         
         return redirect('/login');
   }
}
