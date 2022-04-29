<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function hasRoles($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }

    public function isSupperAdmin()
    {
        return $this->hasRoles('supper-admin');
    }

    public function hasPermission($permission)
    {
        $role = $this->roles;
        foreach ($role as $item) {
            if ($item->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function scopeWithEmail($query, $email)
    {
        return $email ? $query->where('email', $email) : null;
    }

    public function scopeWithName($query, $name)
    {
        return $name ? $query->where('name', 'LIKE', "%{$name}%") : null;
    }

    public function scopeWithRoleId($query, $roleId)
    {
        return $roleId ? $query->whereHas('roles', fn($q) => $q->where('role_id', $roleId)) : null;
    }

    public function assignRoles($roleIds)
    {
        return $this->roles()->attach($roleIds);
    }

    public function syncRoles($roleIds)
    {
        return $this->roles()->sync($roleIds);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
