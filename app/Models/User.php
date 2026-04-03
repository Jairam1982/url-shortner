<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_SUPERADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_MEMBER = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isMember()
    {
        return $this->role === self::ROLE_MEMBER;
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function urls()
    {
        return $this->hasMany(Url::class);
    }

     public function getDashboardRoute()
    {
        if ($this->role == self::ROLE_SUPERADMIN) {
            return 'super-admin-dashboard';
        } elseif ($this->role == self::ROLE_ADMIN) {
            return 'admin-dashboard';
        }

        return 'member-dashboard';
    }
}
