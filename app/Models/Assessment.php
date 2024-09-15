<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'assessments';
    protected $guarded = [];

    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }
    public function questions(){
        return $this->hasMany('App\Models\Question', 'assessment_id');
    }
}