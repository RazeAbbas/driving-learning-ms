<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\OrderItem;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'courses';
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo('App\Models\Categories','cat_id');
    }
    public function coupons()
    {
        return $this->belongsToMany('App\Models\Coupon');
    }
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson', 'course_id');
    }
    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter', 'course_id');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\User','instructor_id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User','created_by');
    }

    public function course_reviews(){
        return $this->hasMany('App\Models\Reviews','course_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function assessment(){
        return $this->belongsTo('App\Models\Assessment','course_id');
    }

}
