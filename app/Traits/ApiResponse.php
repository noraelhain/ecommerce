<?php 
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse{
    protected function apiResponse($data=null,$message='',$status=true,$code=200){
        $data=is_array($data)?$data:['payload'=>$data];
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ],$code);
    }

    protected function successResponse($data=null,$message='success',$status){
        return $this->apiResponse($data,$message,true,200);
    }

    protected function validationErrorResponse($data,$message='Validation Faild',$status){
        return $this->apiResponse($data,$message,false,422);
    }

    protected function serverErrorReponse($message='Server Error',$status){
        return $this->apiResponse($message,false,500);
    }
}