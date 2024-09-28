<?php

namespace App\Repository\Cart;

use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartRepository implements CartRepositoryInterface
{

    public function addToCart(Request $request, $productId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message'=>'you should be login'
            ],401);
        }
        $cart = $user->carts()->latest()->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }

        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if (!$cartItem) {
            $cartItem = $cart->cartItems()->create([
                'cart_id'=>$cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        } else {
            //$cartItem->increment('quantity'); or can return message
            return response()->json(['message' => 'Product already added to cart successfully']);
        }
        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function incrementCartItem(Request $request, $productId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'You should be logged in'
            ],401);
        }

        $cart = $user->carts()->latest()->first();

        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if (!$cartItem) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        }

        // Increment the quantity
        $cartItem->increment('quantity');

        return response()->json(['message' => 'Product quantity incremented successfully']);
    }

    public function decrementCartItem(Request $request, $productId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'You should be logged in'
            ],401);
        }

        $cart = $user->carts()->latest()->first();

        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if (!$cartItem) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        }

        // Decrement the quantity if it's greater than 1
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
            return response()->json(['message' => 'Product quantity decremented successfully']);
        } else {
            // Optionally, you can delete the item if quantity reaches 1
            return $this->deleteCartItem($request, $productId);
        }
    }


    public function deleteCartItem(Request $request, $productId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'You should be logged in'
            ],401);
        }

        $cart = $user->carts()->latest()->first();

        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if (!$cartItem) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        }

        // Delete the cart item
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart successfully']);
    }

}
