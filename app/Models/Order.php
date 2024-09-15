<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $softDelete = true;
    protected $table = 'orders';
    protected $guarded = [];

    public function orderitems(){
        return $this->hasMany("App\Models\OrderItem","order_id");
    }
    public function course(){
        return $this->belongsToMany('App\Models\Course','App\Models\OrderItem','order_id','course_id');
    }
    public function GapAnalysis(){
        return $this->belongsTo('App\Models\GapAnalysis', 'gap_analysis_id');
    }
    public function analysis_result(){
        return $this->hasMany('App\Models\AnalysisResult', 'analysis_id');
    }
    public function student(){
        return $this->belongsTo('App\Models\User','created_by');
    }
}
