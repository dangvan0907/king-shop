<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\RoleRepository;

class CartService
{
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

   public function getList()
   {
        return $this->cartRepository->getList();
   }

   public function findById($id){
        return $this->cartRepository->find($id);
   }
}
