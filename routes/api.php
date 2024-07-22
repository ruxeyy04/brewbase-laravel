<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserinfoController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\admin\ProductAdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products', [ProductController::class, 'getProduct']);
Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/checkUser', [RegistrationController::class, 'checkUser']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/userinfo', [UserinfoController::class, 'profile']);

Route::get('/cart', [CartController::class, 'getCart']);
Route::post('/cart/delete', [CartController::class, 'deleteCartItem']);
Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::post('/cart/remove', [CartController::class, 'removeFromCart']);
Route::post('/cart/update-quantity', [CartController::class, 'updateCartItemQuantity']);
Route::post('/cart/update-addons', [CartController::class, 'updateCartItemAddons']);

Route::post('/wishlist/add', [CartController::class, 'addToWishlist']);
Route::post('/wishlist/remove', [CartController::class, 'removeFromWishlist']);
Route::get('/wishlist', [WishlistController::class, 'getWishlist']);
Route::post('/wishlist/delete-item', [WishlistController::class, 'deleteWishlistItem']);
Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveWishlistToCart']);

Route::post('/product-details', [ProductDetailsController::class, 'getProductDetails']);
Route::post('/addons', [ProductDetailsController::class, 'getAddons']);

Route::post('/userprofile/get-info', [UserProfileController::class, 'getUserInfo']);
Route::post('/userprofile/change-password', [UserProfileController::class, 'changePassword']);
Route::post('/userprofile/update-account', [UserProfileController::class, 'updateAccount']);
Route::post('/userprofile/update-profile', [UserProfileController::class, 'updateProfile']);

Route::prefix('delivery-address')->group(function () {
    Route::post('/get-addresses', [DeliveryAddressController::class, 'getAddresses']);
    Route::post('/add-delivery-address', [DeliveryAddressController::class, 'addDeliveryAddress']);
    Route::post('/get-address-for-edit', [DeliveryAddressController::class, 'getAddressForEdit']);
    Route::post('/update-delivery-address', [DeliveryAddressController::class, 'updateDeliveryAddress']);
    Route::post('/set-as-default', [DeliveryAddressController::class, 'setAsDefault']);
    Route::post('/delete-delivery-address', [DeliveryAddressController::class, 'deleteDeliveryAddress']);
});

Route::post('/checkout/cod', [CheckoutController::class, 'processCOD']);
Route::post('/checkout/direct-bank', [CheckoutController::class, 'processDirectBank']);


Route::get('/orders', [OrderController::class, 'getUserOrders']);
Route::post('/orders/confirm', [OrderController::class, 'confirmOrder']);
Route::post('/orders/cancel', [OrderController::class, 'cancelOrder']);

Route::get('/orderdetails', [OrderDetailController::class, 'getOrderDetails']);

// admin

Route::get('/admin/getRevenueData', [AdminController::class, 'getRevenueData']);
Route::get('/admin/getOrderData', [AdminController::class, 'getOrderData']);

Route::get('/admin/customerlist', [AdminController::class, 'customerList']);
Route::post('/admin/userprofile', [AdminController::class, 'userProfile']);

Route::get('/admin/getProductData', [ProductAdminController::class, 'getProductData']);
Route::post('/admin/addProduct', [ProductAdminController::class, 'addProduct']);
Route::post('/admin/updateViewProduct', [ProductAdminController::class, 'updateViewProduct']);
Route::post('/admin/updateProduct', [ProductAdminController::class, 'updateProduct']);
Route::post('/admin/updateProductStatus', [ProductAdminController::class, 'updateProductStatus']);
Route::post('/admin/deleteProduct', [ProductAdminController::class, 'deleteProduct']);

Route::get('/admin/getOrders', [AdminController::class, 'getOrders']);
Route::get('/admin/getOrderDetail', [AdminController::class, 'getOrderDetail']);
Route::post('/admin/updateOrderStatus', [AdminController::class, 'updateOrderStatus']);

Route::get('/admin/getTransactions', [AdminController::class, 'getTransactions']);

Route::get('/admin/getUserProfiles', [AdminController::class, 'getUserProfiles']);
Route::post('/admin/setRole', [AdminController::class, 'setRole']);