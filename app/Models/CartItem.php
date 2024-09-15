<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $guarded = [];
    
    // public function course()
    // {
        //     return $this->belongsTo('App\Models\Course','course_id');
        // }
        public function user()
        {
            return $this->belongsTo('App\Models\User','user_id');
        }
        public function course()
        {
            return $this->belongsTo(Course::class, 'course_id');
        }
    }
    
    
    