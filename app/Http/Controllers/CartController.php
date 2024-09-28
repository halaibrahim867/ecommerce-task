<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use App\Repository\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function addToCart(Request $request, $productId)
    {
        return $this->cartRepository->addToCart($request,$productId);

    }

    public function incrementCartItem(Request $request, $productId)
    {
        return $this->cartRepository->incrementCartItem($request,$productId);

    }

    public function decrementCartItem(Request $request, $productId)
    {
        return $this->cartRepository->decrementCartItem($request,$productId);
    }


    public function deleteCartItem(Request $request, $productId)
    {
        return $this->cartRepository->deleteCartItem($request,$productId);

    }


}
