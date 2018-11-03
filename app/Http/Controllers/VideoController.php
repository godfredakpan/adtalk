<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Video;
use App\Http\Resources\Video as VideoResource;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Videos
        $video = Video::paginate(15);
        // Return collection of Videos as a resource
        return VideoResource::collection($video);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        $video = $request->isMethod('put') ? video::findOrFail($request->video_id) : new video;
        $video->video_id = $request->input('video_id');
        $video->file_name = $request->input('file_name');
        $video->survey_description = $request->input('survey_description');
        if($video->save()) {
            return new VideoResource($video);
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($video_id)
    {
        // Get Video
        $video = Video::findOrFail($video_id);
        // Return single Video as a resource
        return new VideoResource($video);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($video_id)
    {
        // Get Video
        $video = Video::findOrFail($video_id);
        if($video->delete()) {
            return new VideoResource($video);
        }    
    }
}