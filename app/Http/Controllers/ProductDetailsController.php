<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetailsController extends Controller
{
    public function getProductDetails(Request $request)
    {
        $userid = $request->input('userid', '');

        if ($request->isMethod('post') && $request->has('name')) {
            $prodname = $request->input('name');

            $product = Product::select(
                'products.*',
                DB::raw('IF(c.userid IS NOT NULL, 1, 0) as is_added_to_cart'),
                DB::raw('IF(w.userid IS NOT NULL, 1, 0) as is_added_to_wishlist')
            )
                ->leftJoin('cart_items as c', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'c.prod_no')
                        ->where('c.userid', '=', $userid);
                })
                ->leftJoin('wishlists as w', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'w.prod_no')
                        ->where('w.userid', '=', $userid);
                })
                ->whereIn('products.status', ['Available', 'Not Available'])
                ->where('products.prod_name', $prodname)
                ->get();

            if ($product->isNotEmpty()) {
                $prod['prod'] = $product->toArray();
                $category = $prod['prod'][0]['category'];
                $prodno = $prod['prod'][0]['prod_no'];

                $relatedProducts = Product::select(
                    'products.*',
                    DB::raw('IF(c.userid IS NOT NULL, 1, 0) as is_added_to_cart'),
                    DB::raw('IF(w.userid IS NOT NULL, 1, 0) as is_added_to_wishlist')
                )
                    ->leftJoin('cart_items as c', function ($join) use ($userid) {
                        $join->on('products.prod_no', '=', 'c.prod_no')
                            ->where('c.userid', '=', $userid);
                    })
                    ->leftJoin('wishlists as w', function ($join) use ($userid) {
                        $join->on('products.prod_no', '=', 'w.prod_no')
                            ->where('w.userid', '=', $userid);
                    })
                    ->whereIn('products.status', ['Available', 'Not Available'])
                    ->where('products.category', $category)
                    ->where('products.prod_no', '<>', $prodno)
                    ->orderBy('products.prod_price', 'ASC')
                    ->limit(6)
                    ->get();

                if ($relatedProducts->isNotEmpty()) {
                    $prod['prod_related'] = $relatedProducts->toArray();
                }

                $addons = Addons::all();
                if ($addons->isNotEmpty()) {
                    $prod['addons'] = $addons->toArray();
                }

                return response()->json($prod);
            }
        }

        // Handle case when the product is not found
        return response()->json(['error' => 'Product not found']);
    }

    public function getAddons(Request $request)
    {
        $addons = Addons::all();
        if ($addons->isNotEmpty()) {
            $prod['addons'] = $addons->toArray();
        }
        return response()->json($prod);
    }
}
