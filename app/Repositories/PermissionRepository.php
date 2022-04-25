<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    public function getPermissions()
    {
        return $this->model->all();
    }

    public function search($name)
    {
        return $this->model->withName($name)->latest('id')->paginate(20);
    }
}
