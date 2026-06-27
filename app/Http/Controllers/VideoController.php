<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display video upload form
     */
    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,webm,avi,mov|max:102400', // 100MB max
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $videoData = file_get_contents($file->getRealPath());
            
            $video = Video::create([
                'name' => $file->getClientOriginalName(),
                'filename' => $file->getClientOriginalName(),
                'video_data' => $videoData,
                'file_size' => filesize($file->getRealPath()),
            ]);

            return response()->json([
                'success' => true,
                'video_id' => $video->id,
                'message' => 'Video uploaded successfully'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
    }

    /**
     * Stream video for playback
     */
    public function stream($id)
    {
        $video = Video::findOrFail($id);
        
        return response($video->video_data)
            ->header('Content-Type', 'video/mp4')
            ->header('Content-Length', strlen($video->video_data));
    }

    /**
     * Get video info
     */
    public function info($id)
    {
        $video = Video::findOrFail($id);
        
        return response()->json([
            'id' => $video->id,
            'name' => $video->name,
            'filename' => $video->filename,
            'file_size' => $video->file_size,
        ]);
    }

    /**
     * Delete video
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['success' => true, 'message' => 'Video deleted successfully']);
    }
}
