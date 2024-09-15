<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'chapters';
    protected $guarded = [];

    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function lesson(){
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }
}
