<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\CartItem;

class WishlistController extends Controller
{
    public function getWishlist(Request $request)
    {
        $wishlists = [];

        if ($request->isMethod('get') && $request->has('userid')) {
            $userid = $request->input('userid');

            $result = Wishlist::select('wishlists.*', 'products.prod_price', 'products.prod_img', 'products.prod_name', 'products.status')
                ->leftJoin('products', 'wishlists.prod_no', '=', 'products.prod_no')
                ->where('wishlists.userid', $userid)
                ->get();

            if ($result->count() > 0) {
                $wishlists['wishlists'] = $result->toArray();
            }
        }

        return response()->json($wishlists);
    }

    public function deleteWishlistItem(Request $request)
    {
        if ($request->isMethod('post') && $request->has('delwishlistItem')) {
            $wishID = $request->input('delwishlistItem');

            $wishlistItem = Wishlist::find($wishID);

            if ($wishlistItem) {
                $wishlistItem->delete();

                $response = ['status' => 'success', 'message' => 'Wishlist Item Deleted Successfully'];
            } else {
                $response = ['status' => 'error', 'message' => 'Wishlist Item failed to delete'];
            }

            return response()->json($response);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }

    public function moveWishlistToCart(Request $request)
    {
        if ($request->isMethod('post') && $request->has('addCart') && $request->has('userid')) {
            $prodno = $request->input('prod_no');
            $wishID = $request->input('addCart');
            $userid = $request->input('userid');

            $productStatus = Product::where('prod_no', $prodno)->value('status');

            if ($productStatus === 'Available') {
                $quant = 1;
                $add = 0;

                $cartItem = new CartItem([
                    'prod_no' => $prodno,
                    'userid' => $userid,
                    'quantity' => $quant,
                    'addonsID' => $add,
                ]);

                if ($cartItem->save()) {
                    Wishlist::where('wishlist_id', $wishID)->delete();

                    $response = ['status' => 'success', 'message' => 'Successfully Added to Cart'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Item from Wishlist failure added to Cart.'];
                }
            } else {
                $response = ['status' => $productStatus, 'message' => 'The products is not available.'];
            }

            return response()->json($response);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request']);
    }
}
