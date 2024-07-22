<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function getProduct(Request $request)
    {
        $response = ['cat' => [], 'prod' => [], 'new' => []];
        $userid = $request->cookie('user_id', '');

        if ($request->has('search')) {
            $value = trim($request->input('search'));
            $categories = Product::whereIn('status', ['Available', 'Not Available'])
                ->whereRaw("CONCAT(prod_name, category) LIKE '%$value%'")
                ->groupBy('category')
                ->pluck('category');
            $products = Product::select(
                'products.prod_no AS number',
                'products.category',
                'products.prod_name as prodname',
                'products.prod_description as description',
                'products.prod_date as date',
                'products.prod_price as price',
                'products.prod_img as image',
                'products.status',
                DB::raw('IFNULL(c.userid, 0) as is_added_to_cart'),
                DB::raw('IF(w.userid IS NOT NULL, 1, 0) as is_added_to_wishlist')
            )
                ->leftJoin('cart_items as c', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'c.prod_no')
                        ->where('c.userid', $userid);
                })
                ->leftJoin('wishlists as w', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'w.prod_no')
                        ->where('w.userid', $userid);
                })
                ->whereIn('status', ['Available', 'Not Available'])
                ->whereRaw("CONCAT(prod_name, category) LIKE '%$value%'")
                ->get();
        } elseif ($request->has('filterprice')) {
            $minPrice = $request->input('min');
            $maxPrice = $request->input('max');
            $categories = Product::whereIn('status', ['Available', 'Not Available'])
                ->whereBetween('prod_price', [$minPrice, $maxPrice])
                ->groupBy('category')
                ->pluck('category');
            $products = Product::select(
                'products.prod_no AS number',
                'products.category',
                'products.prod_name as prodname',
                'products.prod_description as description',
                'products.prod_date as date',
                'products.prod_price as price',
                'products.prod_img as image',
                'products.status',
                DB::raw('IFNULL(c.userid, 0) as is_added_to_cart'),
                DB::raw('IF(w.userid IS NOT NULL, 1, 0) as is_added_to_wishlist')
            )
                ->leftJoin('cart_items as c', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'c.prod_no')
                        ->where('c.userid', $userid);
                })
                ->leftJoin('wishlists as w', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'w.prod_no')
                        ->where('w.userid', $userid);
                })
                ->whereIn('status', ['Available', 'Not Available'])
                ->whereBetween('prod_price', [$minPrice, $maxPrice])
                ->orderBy('prod_price', 'ASC')
                ->get();
        } else {
            $categories = Product::whereIn('status', ['Available', 'Not Available'])
                ->groupBy('category')
                ->pluck('category');

            $products = Product::select(
                'products.prod_no AS number',
                'products.category',
                'products.prod_name as prodname',
                'products.prod_description as description',
                'products.prod_date as date',
                'products.prod_price as price',
                'products.prod_img as image',
                'products.status',
                DB::raw('IFNULL(c.userid, 0) as is_added_to_cart'),
                DB::raw('IF(w.userid IS NOT NULL, 1, 0) as is_added_to_wishlist')
            )
                ->leftJoin('cart_items as c', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'c.prod_no')
                        ->where('c.userid', $userid);
                })
                ->leftJoin('wishlists as w', function ($join) use ($userid) {
                    $join->on('products.prod_no', '=', 'w.prod_no')
                        ->where('w.userid', $userid);
                })
                ->whereIn('products.status', ['Available', 'Not Available'])
                ->orderBy('products.prod_no', 'ASC')
                ->get();
        }

        $response['cat'] = $categories->toArray();
        $response['prod'] = $products->toArray();

        // Additional SQL query and response for the "new" section
        $newProducts = Product::select(
            'products.prod_no AS number',
            'products.category',
            'products.prod_name as prodname',
            'products.prod_description as description',
            'products.prod_date as date',
            'products.prod_price as price',
            'products.prod_img as image',
            'products.status',
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
            ->orderBy('prod_price', 'ASC')
            ->limit(12)
            ->get();

        $response['new'] = $newProducts->toArray();
        $response['prod'] = array_map(function ($row) {
            return [
                'number' => $row['number'],
                'category' => $row['category'],
                'prodname' => $row['prodname'],
                'description' => $row['description'],
                'date' => $row['date'],
                'price' => $row['price'],
                'image' => $row['image'],
                'status' => $row['status'],
                'is_added_to_cart' => ($row['is_added_to_cart'] != 0),
                'is_added_to_wishlist' => ($row['is_added_to_wishlist'] != 0),
            ];
        }, $response['prod']);


        return response()->json($response);
    }
    public function getNewProducts()
    {
        
        $userid = request()->cookie('userid');
        // Additional SQL query and response for the "new" section
        $newProducts = Product::select(
            'products.prod_no AS number',
            'products.category',
            'products.prod_name as prodname',
            'products.prod_description as description',
            'products.prod_date as date',
            'products.prod_price as price',
            'products.prod_img as image',
            'products.status',
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
            ->orderBy('prod_price', 'ASC')
            ->limit(6)
            ->get();

            return ['new' => $newProducts->toArray()]; 
    }

    public function showWelcomePage()
    {
        $newProducts = $this->getNewProducts();
        return view('welcome', compact('newProducts'));
        // return view('welcome');
    }

}
