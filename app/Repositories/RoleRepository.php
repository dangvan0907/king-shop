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
        $display_name = $dataSearch['display_name'];
        return $this->model->withName($display_name)->latest('id')->paginate(5);
    }

    public function getRoleWithOutSuperAdmin()
    {
        return $this->model->getRoleWithOutSuperAdmin()->get();
    }
}
