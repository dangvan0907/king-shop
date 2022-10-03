<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $carts = $this->cartService->getList();
        return view('admin.cart.index', compact('carts'));
    }

    public function show($id)
    {
        $cart = $this->cartService->findById($id);
        return view('admin.cart.show', compact('cart'));
    }
}
