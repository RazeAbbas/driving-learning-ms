<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $softDelete = true;
    protected $table = 'reviews';
    protected $guarded = [];

    public function course(){
        return $this->belongsTo("App\Models\Course","course_id");
    }
    public function user(){
        return $this->belongsTo("App\Models\User","created_by");
    }
}
