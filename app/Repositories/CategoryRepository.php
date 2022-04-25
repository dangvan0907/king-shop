<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function search($dataSearch)
    {
        $parent_id = $dataSearch['parent_id'];
        $name = $dataSearch['name'];
        return $this->model->withName($name)->withParentId($parent_id)->latest("id")->paginate(5);
    }

    public function getParent()
    {
        return $this->model->withParent()->latest('id')->paginate(5);
    }

    public function getChildren()
    {
        return $this->model->withChildren()->latest('id')->paginate(1100000);
    }
}
