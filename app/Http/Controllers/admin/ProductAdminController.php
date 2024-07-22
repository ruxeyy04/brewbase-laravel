<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductAdminController extends Controller
{
    public function homepage() {
        return view('admin.products');
    }
    public function getProductData()
    {
        if (request()->isMethod('get')) {
            // Query to fetch product data
            $productData = DB::table('products')
                ->select(
                    'prod_no',
                    'prod_name',
                    'prod_img',
                    'category',
                    'prod_description',
                    'status',
                    DB::raw('DATE_FORMAT(prod_date, "%M %d, %Y") as formatted_date'),
                    DB::raw('CONCAT("₱ ", prod_price) as formatted_price')
                )
                ->whereIn('status', ['Available', 'Not Available'])
                ->get();

            // Create an array to hold the table rows
            $tableRows = [];

            // Fetch each row from the result and add it to the tableRows array
            foreach ($productData as $row) {
                $productNo = $row->prod_no;
                $productName = $row->prod_name;
                $prodimg = $row->prod_img;
                $category = $row->category;
                $description = $row->prod_description;
                $status = $row->status;
                $date = $row->formatted_date;
                $price = $row->formatted_price;
                $setText = $status === 'Available' ? 'Set to Not Available' : 'Set to Available';
                $setColor = $status === 'Available' ? 'text-info' : 'text-success';

                // Limit the description to 50 characters
                if (strlen($description) > 50) {
                    $description = substr($description, 0, 50) . '...';
                }

                $tableRows[] = [
                    $productNo,
                    '<div class="admin-image-preview">
                        <div class="item_image mr-3" style="width: 70px;">
                            <img src="/../productimg/' . $prodimg . '" alt="product_image">
                        </div>
                        <h3 class="item_title">' . $productName . '</h3>
                    </div>',
                    $category,
                    $description,
                    $status,
                    $date,
                    $price,
                    '<button class="btn1 btn-outline-info dropdown-toggle product-btn" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item updateProd" href="#!" data-prodid="' . $productNo . '">Update</a>
                            <a class="dropdown-item ' . $setColor . ' setProd" href="#!" data-prodid="' . $productNo . '" data-status="' . $status . '">' . $setText . '</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger delProd" href="#!" data-prodid="' . $productNo . '">Delete</a>
                        </div>'
                ];
            }

            // Return the table rows as JSON
            return response()->json(['data' => $tableRows]);
        }
    }
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post') && $request->has('addProd')) {
            $prodName = $request->input('prodName');
            $category = $request->input('category');
            $prodesc = $request->input('prodesc');
            $prodPrice = $request->input('prodPrice');
            $prodDate = $request->input('prodDate');
            $status = $request->input('status');

            // Check if all inputs and file are provided
            if (!empty($prodName) && !empty($category) && !empty($prodesc) && !empty($prodPrice) && !empty($prodDate) && !empty($status) && $request->hasFile('prodpic')) {
                $file = $request->file('prodpic');

                // File details
                $fileName = $file->getClientOriginalName();
                $img_ex = pathinfo($fileName, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $newFilename = uniqid("product-", true) . '.' . $img_ex_lc;
                $fileDestination = public_path('productimg') . '/' . $newFilename;

                // Move the uploaded file to the destination
                $file->move(public_path('productimg'), $newFilename);

                // Insert data into the database
                DB::table('products')->insert([
                    'category' => $category,
                    'prod_name' => $prodName,
                    'prod_description' => $prodesc,
                    'prod_date' => $prodDate,
                    'prod_price' => $prodPrice,
                    'prod_img' => $newFilename,
                    'status' => $status,
                ]);

                $response = [
                    'status' => 'success',
                    'message' => 'Product Added Successfully',
                    'title' => 'Success'
                ];

                return response()->json($response);
            } else {
                $response = [
                    'status' => 'error',
                    'message' => $request->hasFile('prodpic') ? 'Fill in the missing fields' : 'The Product Photo is Required',
                    'title' => 'Error'
                ];

                return response()->json($response);
            }
        }
    }
    public function updateViewProduct(Request $request)
    {
        if ($request->isMethod('post') && $request->has('updateProd')) {
            $prodID = $request->input('updateProd');

            try {
                $product = Product::where('prod_no', $prodID)->first();

                if ($product) {
                    return response()->json(['prod' => $product]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Product not found',
                        'title' => 'Error'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to retrieve product information: ' . $e->getMessage(),
                    'title' => 'Error'
                ]);
            }
        }
    }
    public function updateProduct(Request $request)
    {
        if ($request->isMethod('post') && $request->has('update_Prod')) {
            $prodid = $request->input('update_Prod');
            $prodName = $request->input('prodName');
            $category = $request->input('category');
            $prodesc = $request->input('prodesc');
            $prodPrice = $request->input('prodPrice');
            $prodDate = $request->input('prodDate');
            $status = $request->input('status');

            try {
                $product = Product::find($prodid);

                // Check if the product exists
                if (!$product) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Product not found',
                        'title' => 'Error'
                    ]);
                }

                if ($request->hasFile('prodpic')) {
                    $file = $request->file('prodpic');

                    $fileName = $file->getClientOriginalName();
                    $img_ex = pathinfo($fileName, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $newFilename = uniqid("product-", true) . '.' . $img_ex_lc;
                    $fileDestination = public_path('productimg') . '/' . $newFilename;

                    $file->move(public_path('productimg'), $newFilename);

                    $oldFilePath = public_path('productimg') . '/' . $product->prod_img;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }

                    $product->prod_img = $newFilename;
                }

                $product->category = $category;
                $product->prod_name = $prodName;
                $product->prod_description = $prodesc;
                $product->prod_date = $prodDate;
                $product->prod_price = $prodPrice;
                $product->status = $status;

                // Save the changes
                $product->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Product Updated Successfully',
                    'title' => 'Success'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update product: ' . $e->getMessage(),
                    'title' => 'Error'
                ]);
            }
        }
    }
    public function updateProductStatus(Request $request)
    {
        if ($request->isMethod('post') && $request->has('status_prod')) {
            $stat = $request->input('status_prod');
            $prodid = $request->input('prodid');

            try {
                $product = Product::find($prodid);

                // Check if the product exists
                if (!$product) {
                    return response()->json([
                        'status' => 'error',
                        'title' => 'Error',
                        'message' => 'Product not found'
                    ]);
                }

                // Update the status based on the provided value
                $product->status = ($stat === 'Available') ? 'Not Available' : 'Available';
                $product->save();

                $response = array(
                    'status' => 'success',
                    'title' => 'Success',
                    'icon' => 'info',
                    'message' => 'Product is set to ' . $product->status
                );

                return response()->json($response);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Failed to Update',
                    'message' => 'There is an error to set the product. Please Try Again.'
                ]);
            }
        }
    }
    public function deleteProduct(Request $request)
    {
        if ($request->isMethod('post') && $request->has('delProd')) {
            $prodid = $request->input('delProd');

            try {
                $product = Product::find($prodid);

                // Check if the product exists
                if (!$product) {
                    return response()->json([
                        'status' => 'error',
                        'title' => 'Error',
                        'message' => 'Product not found'
                    ]);
                }

                // Update the status to 'Deleted'
                $product->status = 'Deleted';
                $product->save();

                $response = array(
                    'status' => 'success',
                    'title' => 'Success',
                    'icon' => 'info',
                    'message' => 'Product is Successfully Deleted'
                );

                return response()->json($response);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Failed to Update',
                    'message' => 'Product is Failed to Delete'
                ]);
            }
        }
    }


}
