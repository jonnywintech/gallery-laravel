<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function myGalleries($perPage = 10)
    {
        $user_id = Auth::user()->id;
        $query = Gallery::where('user_id', $user_id);
        $galleries = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('home', compact('galleries'));
    }

    public function viewGallery($id)
    {
        $query = Gallery::query();
        $query = $query->where('id', $id);
        $final = $query->with(array('images' => function($q){
            $q->orderBy('order_number', 'ASC');
        }))->get();

        return view('pages.view-images', ['gallery' => $final]);

    }

    public function editGallery($id)
    {
        $query = Gallery::query();
        $query = $query->where('id', $id);
        $final = $query->with(array('images' => function($q){
            $q->orderBy('order_number', 'ASC');
        }))->get();

        return view('pages.edit-images', ['gallery' => $final]);

    }

    public function updateGallery(Request $request)
    {
        dd($request);
    }

    public function destroy(Request $request)
    {
        $gallery = Gallery::find($request->id);
        $gallery->delete();

        return redirect()->back();
    }
}
