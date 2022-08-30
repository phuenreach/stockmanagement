<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FolderController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $data['folders'] = Folder::where('name','like','%'.$search.'%')
        ->orderByDesc('id')->paginate(10);

        return view('backends.folder.index',$data);
    }
    public function create(Request $request)
    {
        $data['id']= $request->id;
        if($request->id){
            $data['folder'] = Folder::findOrFail($request->id);
        }

        return view('backends.folder.create',$data);
    }

    public function save(Request $request)
    {
        if(!$request->id)
            Folder::create(['name'=>$request->name]);
        else
            Folder::findOrFail($request->id)->update(['name' => $request->name]);


        Session::flash('success', 'save success');
        return redirect()->route('folder.list');
    }

}
