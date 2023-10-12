<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
   public function index()
   {
    $query = Gallery::query();
    $galleries = $query->orderBy('created_at', 'DESC')->paginate(10);
    return view('home', compact('galleries'));
   }
}
