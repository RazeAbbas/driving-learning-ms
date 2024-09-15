<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'questions';
    protected $guarded = [];

    public function assessment(){
        return $this->belongsTo('App\Models\Assessment', 'assessment_id');
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer', 'question_id');
    }
}
