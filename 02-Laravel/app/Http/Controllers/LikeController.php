<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Image;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $imageId)
    {
        $image = Image::find($imageId);
        if (!$image) {
            return abort(404);
        }

        $like = Like::where([
            'user_id' => Auth::user()->id,
            'image_id' => $imageId,
        ]);

        if ($like->count() > 0) {
            $like->delete();
        } else {
            $like = Like::create([
                'user_id' => Auth::user()->id,
                'image_id' => $imageId,
            ]);
        }

        #return new Response(null, 204);
    }
}
