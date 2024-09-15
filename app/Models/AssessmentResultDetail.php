<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentResultDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'assessment_result_details';
    protected $guarded = [];

    public function question(){
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

    public function answer(){
        return $this->belongsTo('App\Models\Answer', 'answer_id');
    }
}
