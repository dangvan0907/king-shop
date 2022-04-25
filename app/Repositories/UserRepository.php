<?php

namespace App\Repositories;

use App\Models\User;

class MyUserRepository
{
    public function model()
    {
        return User::class;
    }

//    public function search($dataSearch)
//    {
//        $roleId = $dataSearch['role_id'];
//        $email = $dataSearch['email'];
//        return $this->model->withEmail($email)->withRoleId($roleId)->latest('id')->paginate(5);
//    }
}
