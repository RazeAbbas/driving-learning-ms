<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lessons';
    protected $guarded = [];

    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function chapters(){
        return $this->hasMany('App\Models\Chapter', 'lesson_id');
    }
}
