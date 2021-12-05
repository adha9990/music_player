<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Http\Requests\StoreVideoRequest;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Jobs\ConvertVideoForStreaming;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VideoResource::collection(Video::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $validated = $request->validated();
        $title = $validated['title'];
        $description = $validated['description'];
        $file = $validated['file'];

        $original_name = $file->getClientOriginalName();

        $video = Video::create([
            'title'         => $title,
            'description'   => $description,
            'original_name' => $original_name,
        ]);

        $video->save();

        $file->storeAs('/public/videos/' . $video->id, 'original.mp4');

        ConvertVideoForStreaming::dispatch($video);

        return new VideoResource($video);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $video->update($request->validated());

        return new VideoResource($video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return response()->noContent();
    }

    public function getPlayurl(Request $request, $id)
    {
        $q = $request->q ?? 360;
        $path = storage_path("app/public/videos/{$id}/{$q}.mp4");
        return response()->file($path);
    }
}