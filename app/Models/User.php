<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'photo',
        'institution',
        'cgpa',
        'achievements',
        'bio',
        'phone',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'permissions'       => 'array',
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

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function savedScholarships()
    {
        return $this->hasMany(SavedScholarship::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin', 'reviewer', 'editor']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) return true;

        return in_array($permission, $this->permissions ?? []);
    }

    public function photoUrl(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1F7A67&color=fff';
    }

    public function hasSaved(int $scholarshipId): bool
    {
        return $this->savedScholarships()->where('scholarship_id', $scholarshipId)->exists();
    }
}
