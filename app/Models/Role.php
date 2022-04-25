<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name'
    ];

    public function scopeWithName($query, $display_name)
    {
        return $display_name ? $query->where('display_name', 'LIKE', "%{$display_name}%") : null;
    }

    public function scopeGetRoleWithOutSuperAdmin($query)
    {
        return $query->where('name', '!=', 'super-admin');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id')
            ->withTimestamps();
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')
            ->withTimestamps();
    }


    public function assignPermissions($permissionIds)
    {
        return $this->permissions()->attach($permissionIds);
    }

    public function syncPermissions($permissionIds)
    {
        return $this->permissions()->sync($permissionIds);
    }

//    public function detachPermissions(){
//        return $this->permissions()->detach();
//    }
}
