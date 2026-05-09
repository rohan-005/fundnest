<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'title',
        'description',
        'amount',
        'deadline',
        'eligibility',
        'available_slots',
        'is_active',
        'category_id',
    ];

    protected $casts = [
        'deadline'  => 'date',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeNotExpired($query)
    {
        return $query->where('deadline', '>=', now());
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function isExpired(): bool
    {
        return $this->deadline && $this->deadline->isPast();
    }

    public function daysUntilDeadline(): int
    {
        return max(0, now()->diffInDays($this->deadline, false));
    }
}