<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use getID3;
use getid3_writetags;

class Id3EditorController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function updateTags(Request $request)
    {
        /*$validated = $request->validate([
            'url' => 'required',
            'title' => 'required',
            'artist' => 'required',
        ]);*/


        $info = pathinfo($request->url);
        if($contents = file_get_contents($request->url)){

            $file = public_path('tmp/' . $info['basename']);
            file_put_contents($file, $contents);

            $uploaded_file = new UploadedFile($file, $info['basename']);

           /* $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put($name, $contents);*/

            $getID3 = new getID3;

           // $ThisFileInfo = $getID3->analyze($uploaded_file);

            $TaggingFormat = 'UTF-8';
            $getID3->setOption(array('encoding' => $TaggingFormat));
            $tagwriter = new getid3_writetags;
            $tagwriter->filename = $uploaded_file;
            $tagwriter->tagformats = array('id3v2.3');
            $tagwriter->overwrite_tags = true;
            $tagwriter->tag_encoding = $TaggingFormat;
            $tagwriter->remove_other_tags = true;
    
            // populate data array
            $TagData = array(
                'title' => array($request->title),
                'artist' => array($request->artist)
            );

            $tagwriter->tag_data = $TagData;

            if ($tagwriter->WriteTags()) {
                return redirect()->back()->with(['message' => 'Successfully wrote tags']);
            } else {
                dd($tagwriter->errors ); 
                return redirect()->back()->with(['message' => 'The program failed. Please try again.']);
            }
        }

    }
}