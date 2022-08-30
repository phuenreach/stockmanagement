<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Gallery;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UploadFileController extends Controller
{


    public function gallerypage(){

        $context=[
            'folder' => Folder::get(),
            'gallery' => Gallery::get()
        ];

        return view("systems.gallery", $context);
    }
    public function gallery(Request $request){

        $context=[
            'folder' => Folder::get(),
            'gallery' => Gallery::get()
        ];

        return Response::json($context, 200);
    }

    public function uploadNewImage(Request $request) {

        $images = array();
        $galleryBack = array();
        $galleries_news = $request->file('image');
        // return Response::json(['id',$request->_token],200);

        if ($galleries_news) {

            foreach ($galleries_news as $file) {
                $filename = md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                $destination = public_path('uploads/images');
                $file->move($destination,$filename);

                $images[] = $filename;
            }
            foreach ($images as $image) {
                $gallery = new Gallery();

                $gallery->folder_id = $request->folder_id?$request->folder_id:0 ;
                $gallery->path = $image;
                $gallery->save();
                $galleryBack[] = $gallery;
            }
        }
        return Response::json(['datas'=>$galleryBack],200);

        // return Response::json(['messege'=> 'success'], 200);
    }
    public function removeImage(Request $request)
    {
        $gallerynew = Gallery::find($request->id);
        if($gallerynew)
        {
            if($gallerynew->folder_id == 0){
                Upload::deleteFile('/blog/default',$gallerynew->url);
            }else{
                Upload::deleteFile('/blog/images',$gallerynew->url);
            }
            $gallerynew->delete();
            return Response::json(['success'=>$gallerynew->url], 200);
        }

    }

    public function folderImageList(Request $request)
    {
        if($request->folder_id ==0){
         $folderImage = Gallery::orderByDesc('id')->get();

        }else{
            $folderImage = Gallery::where('folder_id',$request->folder_id)->orderByDesc('id')->get();
        }
        return Response::json(['images'=>$folderImage],200);
    }

    public function newFolder(Request $request)
    {
        $folder = new Folder();
        $folder->name = $request->folder_name;
        $folder->save();
        return Response::json(['id'=>$folder->id,'name'=>$folder->name], 200);
    }




}

