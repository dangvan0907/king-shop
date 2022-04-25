<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function search($dataSearch)
    {
        $roleId = $dataSearch['role_idSearch'];
        $email = $dataSearch['emailSearch'];
        $name = $dataSearch['nameSearch'];
        return $this->model->withEmail($email)->withRoleId($roleId)->withName($name)->latest("id")->paginate(5);
    }
}
