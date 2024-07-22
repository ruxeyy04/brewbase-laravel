<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Wishlist;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        $cart = [];

        if ($request->has('userid') && $request->isMethod('get')) {
            $userid = $request->input('userid');

            $query = CartItem::selectRaw('COUNT(*) AS cartCount, SUM((cart_items.quantity * products.prod_price) + (cart_items.quantity * addons.addons_price)) AS totalAmount, SUM(cart_items.quantity * addons.addons_price) AS totalAddons, SUM(cart_items.quantity * products.prod_price) AS totalProduct')
                ->join('products', 'cart_items.prod_no', '=', 'products.prod_no')
                ->leftJoin('addons', 'cart_items.addonsID', '=', 'addons.addonsID')
                ->where('cart_items.userid', $userid)
                ->first();

            if ($query) {
                $cart['cartCount'] = $query->cartCount;
                $cart['totalAmount'] = $query->totalAmount;
                $cart['totalAddons'] = $query->totalAddons;
                $cart['totalProduct'] = $query->totalProduct;
            }

            $result = CartItem::selectRaw('
                cart_items.cart_id,
                products.prod_no,
                products.category,
                products.prod_name,
                products.prod_description,
                products.prod_date,
                products.prod_price,
                products.prod_img,
                addons.addonsID,
                addons.addons_name,
                addons.addons_price,
                addons.addons_img,
                cart_items.quantity,
                cart_items.created_at,
                ((cart_items.quantity * products.prod_price) + (cart_items.quantity * addons.addons_price)) AS total_price
            ')
                ->join('products', 'cart_items.prod_no', '=', 'products.prod_no')
                ->leftJoin('addons', 'cart_items.addonsID', '=', 'addons.addonsID')
                ->where('cart_items.userid', $userid)
                ->get();

            if ($result) {
                $cart['cart'] = $result->toArray();
                return response()->json($cart);
            }
        }

        return response()->json(['error' => 'Invalid request.']);
    }

    public function deleteCartItem(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('delcartItem')) {
            $cartid = $request->input('delcartItem');
            $cartItem = CartItem::find($cartid);

            if ($cartItem) {
                $cartItem->delete();

                $cart['status'] = true;
                $cart['message'] = 'Removed from Cart';
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Error';
        return response()->json($cart);
    }

    public function addToCart(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('cart')) {
            $prodid = $request->input('product_id');
            $userid = $request->input('userid');
            $addonsID = $request->input('addons');
            $quantity = $request->input('quant');

            $cartItem = new CartItem();
            $cartItem->prod_no = $prodid;
            $cartItem->userid = $userid;
            $cartItem->quantity = $quantity;
            $cartItem->addonsID = $addonsID;

            if ($cartItem->save()) {
                $cart['status'] = true;
                $cart['message'] = 'Added to Cart';
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Invalid request';
        return response()->json($cart);
    }
    public function removeFromCart(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('delcart')) {
            $prodid = $request->input('product_id');
            $userid = $request->input('userid');

            $cartItem = CartItem::where('prod_no', $prodid)
                ->where('userid', $userid)
                ->first();

            if ($cartItem) {
                // Delete the cart item
                $cartItem->delete();

                $cart['status'] = true;
                $cart['message'] = 'Removed from Cart';
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Error';
        return response()->json($cart);
    }
    public function updateCartItemQuantity(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('crtQuant')) {
            $cartid = $request->input('cartid');
            $quant = $request->input('crtQuant');

            $cartItem = CartItem::find($cartid);

            if ($cartItem) {
                $cartItem->quantity = $quant;
                $cartItem->save();

                $cart['status'] = true;
                $cart['message'] = "{$cartid} Cart Item quantity is Updated";
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Error';
        return response()->json($cart);
    }
    public function addToWishlist(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('wishlist')) {
            $prodid = $request->input('product_id');
            $userid = $request->input('userid');

            $wishlistItem = new Wishlist();
            $wishlistItem->prod_no = $prodid;
            $wishlistItem->userid = $userid;

            if ($wishlistItem->save()) {
                $cart['status'] = true;
                $cart['message'] = 'Added to Wishlist';
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Invalid request';
        return response()->json($cart);
    }
    public function removeFromWishlist(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('delwishlist')) {
            $prodid = $request->input('product_id');
            $userid = $request->input('userid');

            $wishlistItem = Wishlist::where('prod_no', $prodid)
                ->where('userid', $userid)
                ->first();

            if ($wishlistItem) {
                // Delete the wishlist item
                $wishlistItem->delete();

                $cart['status'] = true;
                $cart['message'] = 'Removed from Wishlist';
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Error';
        return response()->json($cart);
    }
    public function updateCartItemAddons(Request $request)
    {
        $cart = [];

        if ($request->isMethod('post') && $request->has('addonsID')) {
            $addonsID = $request->input('addonsID');
            $cartid = $request->input('cartID');

            $cartItem = CartItem::find($cartid);

            if ($cartItem) {
                // Update the cart item add-ons
                $cartItem->addonsID = $addonsID;
                $cartItem->save();

                $cart['status'] = true;
                $cart['message'] = "{$cartid} Cart Item add-ons is Updated {$addonsID}";
                return response()->json($cart);
            }
        }

        $cart['status'] = false;
        $cart['message'] = 'Error';
        return response()->json($cart);
    }
}
