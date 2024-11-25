<?php

namespace App\Models;

use App\Models\User;
use App\Models\Adtype;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;

      // relationship with categories
      public function category()
      {
          return $this->belongsTo(Category::class);
      }
 
 
      public function user()
     {
         return $this->belongsTo(User::class);
     }



     public function country()
     {
         return $this->belongsTo(Country::class);
     }



     public function type(){
        return $this->belongsTo(Adtype::class);
     }


     
     protected $casts = [
        "images" => "array",
    ];
}
