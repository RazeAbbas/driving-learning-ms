<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentResult extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'assessment_results';
    protected $guarded = [];

    public function assessment_result_details(){
        return $this->hasMany('App\Models\AssessmentResultDetail', 'assessment_result_id');
    }

    public function assessment(){
        return $this->belongsTo('App\Models\Assessment', 'assessment_id');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
