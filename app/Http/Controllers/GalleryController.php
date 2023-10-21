<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Gallery;
use App\Models\UserComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function view($id)
    {
        $query = Gallery::query();
        $query = $query->where('id', $id);
        $final = $query->with(array('images' => function ($q) {
            $q->orderBy('order_number', 'ASC');
        }))->get();

        $comments = UserComment::with('comments')
            ->with('user')
            ->where('gallery_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.view-images', ['gallery' => $final, 'comments' => $comments]);
    }

    public function edit($id)
    {
        $query = Gallery::query();
        $query = $query->where('id', $id);
        $final = $query->with(array('images' => function ($q) {
            $q->orderBy('order_number', 'ASC');
        }))->get();

        return view('pages.edit-images', ['gallery' => $final]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        $gallery = Gallery::find($request->id);
        if ($gallery->name !== $request->gallery_name) {
            $gallery->name =  $request->gallery_name;
            $gallery->save();
        }

        if ($gallery->gallery_image !== $request->gallery_image) {
            $gallery->main_image = $request->gallery_image;
            $gallery->save();
        }

        if (!empty($request->elementsToBeDeleted)) {
            $images_ids = json_decode($request->elementsToBeDeleted);
            $db_images = Image::whereIn('id', $images_ids)->delete();
        }

        // logic to change gallery positions;
        if (isset($request->image_id)) {
            $image_ids = $request->image_id;
            $image_positions = $request->position;

            $img_pos = array_combine($image_ids, $image_positions);

            $images_to_sort = Image::whereIn('id', $image_ids)->get();

            foreach ($images_to_sort as &$image) {
                $key = $image->id;
                $value = $img_pos[$key];
                $image->order_number = $value;
                $image->save();
            }
        }

        if (isset($request->image_new[0])) {
            $length = count($request->image_new);
            for ($i = 0; $i < $length; $i++) {
                $newImage = new Image();
                $newImage->gallery_id = $request->id;
                $newImage->image = $request->image_new[$i];
                $newImage->order_number = $request->position_new[$i];
                $newImage->save();
            }
        }

        DB::commit();

        return redirect()->back();
    }


    public function create(Request $request)
    {
        if (!empty($request->gallery_name) && !empty($request->gallery_url)) {

            $gallery = new Gallery();
            $user_id = Auth::user()->id;

            $gallery->user_id = $user_id;
            $gallery->name = $request->gallery_name;
            $gallery->main_image = $request->gallery_url;
            $gallery->save();

            session()->flash('status_message', "Gallery created successfully");

            return redirect()->back();
        }

        session()->flash('status_message', "Gallery not create fields are empty.");
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $gallery = Gallery::find($request->id);
        $gallery->delete();

        return redirect()->back();
    }
}
