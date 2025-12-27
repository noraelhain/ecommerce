<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return response()->json([
            'status'=>true,
            'message'=> 'success',
            'data' => $categories
        ]);
    }

    public function show($id){
        $category=Category::find($id);

        return response()->json([
            'status'=>true,
            'message'=> 'success',
            'data' => $category
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['required','string'],
            'is_active' => ['required','boolean'],
            'type'=>['nullable'],
        ]);

        $category=Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_active' => $request->is_active,
            'type'=>$request->type,
            'user_id'=>auth()->id()
        ]);
     
        return response()->json([
            'status'=>true,
            'message'=>'created successfly',
            'data'=>$category
        ],201);

    }

    public function search($keyword){

        return Category::where('name','LIKE',"%{$keyword}%")->orderBy('created_at')->get();

    }

    public function updateCategory(Request $request, $id){
        

        // validotor 
            $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['required','string'],
            'is_active' => ['required','boolean'],
            'type'=>['nullable'],
        ]);

        //check user id 
        $category=Category::where('id',$id)
        ->where('user_id',auth()->id())
        ->first();

        if (!$category){
                return response()->json([
            'status'=>false,
            'message'=>'not found category id',
        ]);
        }

        // update 
        $category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_active' => $request->is_active,
            'type'=>$request->type,
            'user_id'=>auth()->id()

        ]);
        // response 
        return response()->json([
            'status'=>true,
            'message'=>'updated successfly',
            'data' => $category,
        ]);
    }

    public function destroy($id){
       //check user id 
        $category=Category::where('id',$id)
        ->where('user_id',auth()->id())
        ->first();

       if (!$category){
                return response()->json([
            'status'=>false,
            'message'=>'not found category id',
        ]);
        }

        $category->delete();
            return response()->json([
            'status'=>true,
            'message'=>'deleted successfly',
        ]);

    }

    public function toggleActive(Category $category){

        $category->is_active=!$category->is_active;

        $category->save();

        return response()->json([
            'status'=>true,
            'message'=>'category status updated',
            'category'=>$category
        ]);

    }

    public function userCategories($userId){
        $categories=Category::where('user_id',$userId)->get();

            return response()->json([
            'status'=>true,
            'message'=>'successfly',
            'data' => $categories,
        ]);
    }

}
