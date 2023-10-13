<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $query = Gallery::query();
        $galleries = $query
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('home', compact('galleries'));
    }

    public function gallery($id)
    {
        $query = Gallery::query();
        $query = $query->where('id', $id);
        $final = $query->with(array('images' => function($q){
            $q->orderBy('order_number', 'ASC');
        }))->get();

        return view('pages.images', ['gallery' => $final]);

    }
}
