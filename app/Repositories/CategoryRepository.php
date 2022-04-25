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
        return $this->model->withName($dataSearch['name'])
            ->withParentId($dataSearch['parent_id'])
            ->latest('id')
            ->paginate(5);
    }

    public function getParentCategories()
    {
        return $this->model->withParentCategories()->get();
    }

    public function getCategories()
    {
        return $this->model->all();
    }
}

