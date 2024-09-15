<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'type',
        'value',
        'valid_from',
        'valid_until',
        'max_uses',
        'is_corporate',
        'email',
        'course_id',
        'used',
        'corporate_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    /**
     * Get the coupon type (fixed or percentage).
     *
     * @return string
     */
    public function getTypeAttribute($value)
    {
        return [
            'fixed' => 'Fixed Amount',
            'percentage' => 'Percentage',
        ][$value] ?? null;
    }

    /**
     * Get the raw coupon type.
     *
     * @return string
     */


    public function getTypeRawAttribute()
    {
        return $this->attributes['type'] ?? null;
    }

    /**
     * Scope a query to only include valid coupons.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid($query)
    {
        $now = now();

        return $query->where(function ($query) use ($now) {
            $query->whereNull('valid_from')
                ->orWhereDate('valid_from', '<=', $now);
        })->where(function ($query) use ($now) {
            $query->whereNull('valid_until')
                ->orWhereDate('valid_until', '>=', $now);
        });
    }

    /**
     * Scope a query to only include coupons that have remaining uses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasRemainingUses($query)
    {
        return $query->where('max_uses', '>', 'used');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'App\Models\Coupon', 'id', 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'App\Models\Coupon', 'id', 'user_id');
    }

    public function gapAnalysis()
    {
        return $this->belongsToMany(GapAnalysis::class, 'App\Models\Coupon', 'id', 'gap_analysis_id');
    }
}
