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

    public function updateCategory(Request $request, $id){
        $category=Category::find($id);

        // validotor 

        // update 

        // response 
    }

    
}
