<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Images.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);
        $image = $request->file('image');
        if (!$image) {
            return redirect()->route('images.create')
                             ->with('danger', __('No image was recieved'));
        }

        $imageName = time() . "-" . $image->getClientOriginalName();
        $image->storeAs('images', $imageName);

        $newImage = new Image();

        $description = $request->input('description') ? 
                            $request->input('description') :
                            '';
        $newImage->description = $description;
        $newImage->mimetype = $image->getMimetype();
        $newImage->user_id = $request->user()->id;
        $newImage->path = $imageName;
        
        $newImage->save();

        return redirect()
            ->route('images.show', $newImage->id)
            ->with('success', __('You have successfully upload image.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return view('Images.show', [
            'image' => $image,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function get(Image $image) {
        $file = Storage::disk('images')->get($image->path);
        $response = new Response($file, 200);
        return $response->header('Content-Type', $image->mimetype);
    }

    public function comment(Request $request, Image $image) {
        $this->validate($request, [
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'image_id' => $image->id,
            'content' => $request->input('comment'),
        ]);

        return redirect()
            ->route('images.show', $image->id)
            ->with('success', __('Comment uploaded successfully.'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Image $image)
    {
        $like = Like::where([
            'user_id' => Auth::user()->id,
            'image_id' => $image->id,
        ]);

        if ($like->count() > 0) {
            $like->delete();
        } else {
            $like = Like::create([
                'user_id' => Auth::user()->id,
                'image_id' => $image->id,
            ]);
        }

        return response()->json(['likes' => $image->likes->count()]);
    }
}
