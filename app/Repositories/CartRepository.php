<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Role;

class CartRepository extends BaseRepository
{

    public function model()
    {
        return Cart::class;
    }

    public function getList()
    {
        return $this->model->latest('id')->paginate(5);
    }

    public function getRoleWithOutSuperAdmin()
    {
        return $this->model->getRoleWithOutSuperAdmin()->get();
    }
}
