<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        // get all  -->  pagenation --> 

        // varieble ==> perPage
        $perPage=$request->query('per_page',15);

        $users = User::paginate($perPage);

        // return data as json 
        return response()->json([
            'status'=>true,
            'message'=> 'fetches users successufly',
            'data' => $users,
            'pagination' => [
                'current_page'=> $users->currentPage(),
                'per_page'=> $users->perPage(),
                'last_page'=>$user->lastPage(),
                'total'=>$users->total(),
                'next_page_url'=>$users->nextPageUrl(),
                'prev_page_url'=>$users->previousPageUrl(),
            ]
        ]);
    }

    public function show($id){
        $user=User::find($id);

        return response()->json([
            'status' =>true,
            'message' => 'success',
            'data' =>$user
        ]);
    }

}
