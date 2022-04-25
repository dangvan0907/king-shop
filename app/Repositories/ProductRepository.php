<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{

    public function model()
    {
        return Product::class;  // TODO: Implement model() method.
    }

    public function search($dataSearch)
    {
        $categoryId = $dataSearch['category_id'];
        $name = $dataSearch['name'];
        $minPrice = $dataSearch['min_price'];
        $maxPrice = $dataSearch['max_price'];
        return $this->model->withCategoryIds($categoryId)->withName($name)
            ->withMinPrice($minPrice)->withMaxPrice($maxPrice)->latest('id')->paginate(3);
    }
}
