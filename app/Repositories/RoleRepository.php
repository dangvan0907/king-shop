<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{

    public function model()
    {
        return Role::class;
    }

    public function search($dataSearch)
    {
        $name = $dataSearch['name'];
        return $this->model->withName($name)->latest('id')->paginate(5);
    }

    public function getRoleWithOutSuperAdmin()
    {
        return $this->model->getRoleWithOutSuperAdmin()->get();
    }
}

