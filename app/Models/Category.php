<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   /**
    * Summary of proected Fillable array
    */

   protected $fillable=[
    'name',
    'description',
    'is_active',
    'type',
   ];

   public function casts(){

    return [
    'is_acticve' => 'boolean'
    ];
   }

   // crud operations

   //create 
   // Model::creat(['name', '])
   // Mode::update([])
   //Model::delete();
   //Model::find($id);
   //Model::get();
   //Model::first();
   // Model::all();
   // Model::where('is_active',true)->get()

   // relationships
   // one to one
   // manage => category
   public function manager(){
    return $this->has(User::class);
   }

   // one to many

   // public function products(){
   //  return $this->hasMany(Product::class);
   // }

}
