<?php

namespace App\Interfaces\Cart;

use Illuminate\Http\Request;

interface CartRepositoryInterface{

    public function addToCart(Request $request, $productId);
    public function incrementCartItem(Request $request, $productId);
    public function decrementCartItem(Request $request, $productId);
    public function deleteCartItem(Request $request, $productId);
}
