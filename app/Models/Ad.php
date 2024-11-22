<?php

namespace App\Models;

use App\Models\User;
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

     protected $casts = [
        "images" => "array",
    ];
}
