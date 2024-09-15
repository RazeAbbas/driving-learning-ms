<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'order_items';
    protected $guarded = [];

    public function course(){
        return $this->belongsTo("App\Models\Course","course_id");
    }
    public function analysis(){
        return $this->belongsTo("App\Models\GapAnalysis","analysis_id");
    }
    public function orders(){
        return $this->belongsTo("App\Models\Order","order_id");
    }
    public function user(){
        return $this->belongsTo("App\Models\User", "created_by");
    }
}
