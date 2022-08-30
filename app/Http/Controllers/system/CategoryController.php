<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Upload;

class CategoryController extends Controller
{

    public function index($id=0){

        $parent_name ="ប្រភេទមុខទំិញ";
        $parent_id =  0;
        if ($id>0){
            $parent=Category::find($id);
            $parent_name =$parent->title;
            $parent_id = $parent->id;

        }
        $context=[
            'data' => Category::where('parent_id',$id)->orderBy('order','ASC')->paginate(10),
            'parent_name'=>$parent_name,
            'parent_id' =>$parent_id,
        ];

        return view('systems.category.list', $context);

    }

    public function create(Request $request ,$id){




        $parent_name ="ប្រភេទមុខទំនិញថ្មី";
        $parent_id =  0;
        if ($id>0){
            $parent=Category::find($id);
            $parent_name =$parent->title;
            $parent_id = $parent->id;

        }
        $context=[
            'data' => Category::where('parent_id',$id)->orderBy('order','ASC')->get(),
            'parent_name'=>$parent_name,
            'parent_id' =>$parent_id,
        ];


        return view('systems.category.index', $context);
    }

    public function store(Request $request){

        // $request->validate([
        //     'title'=> 'required|max:100',
        //     'stug' => 'required|max:50',

        // ]);



        $category = new Category;

        $image = Upload::saveFile('/category', $request->file('icon'), $request->tmp_file);

        $max =Category::where('parent_id',$request->parent_id)->max('order');

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->order = ($max+1);
        $category->status =1;
        $category->parent_id = $request->parent_id;
        $category->icon = $image;
        $category->save();

        return redirect()->back();
    }

    public function order($id, $order, $mode){

        $new_order = $mode== "up"?$order-1:$order+1;

        Category::where('order', $new_order)->update(['order'=>$order]);
        Category::where('id', $id)->update(['order'=>$new_order]);

        return Redirect::route('category.list');

    }

    public function edit($id){
        $parent_name ="ប្រភេទមុខទំនិញថ្មី";
        $parent_id =  0;
        if ($id>0){
            $parent=Category::find($id);
            $parent_name =$parent->title;
            $parent_id = $parent->id;

        }
        $context=[
            'data' => Category::find($id),
            'parent_name'=>$parent_name,
            'parent_id' =>$parent_id,
            'id'=> $id
        ];


        return view('systems.category.edit', $context);

    }

    public function update(Request $request ,$id){

        $filname="";
        if($request->file('icon')){
            $file= $request->file('icon');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('Image'), $filename);

            $filname = $filename;
        }else{
            $filname =$request->tmicon;
        }

        Category::where('id',$id)->update(
            [
                'title'=> $request->title,
                'slug' => $request->slug,
                'icon' => $filname
            ]
        );


        return redirect()->route('category.list');
    }

}
