<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'v-1','namespace'=>'Api'],function (){
    Route::post('/registration','UserController@registration');
    Route::post('/login','UserController@login');
    Route::post('/forget-password','UserController@forgetPassword');
    Route::post('/forgot-otp-varify','UserController@forgorOTPVarify');
    Route::post('/user-verify-otp','UserController@sendVerifyOTP');
    Route::post('/user-verify-email-link','UserController@sendEmailVerificationLink');
    Route::post('/verify-otp','UserController@verifyOTP');

    Route::group(['middleware'=>['auth:api','isActive']],function (){
        //   For User Authentication
        Route::get('/profile','UserController@profile');
        Route::post('/profile-update','UserController@userProfileUpdate');
        Route::post('/update-password','UserController@updatePassword');
        Route::post('/reset-password','UserController@resetPassword');
        Route::post('/change-password','UserController@changePassword');
        Route::get('/logout','UserController@logout');

        //Address
        Route::get('address-book','Customer\CustomerAddressController@index');
        Route::delete('delete-address/{id}','Customer\CustomerAddressController@delete');
        Route::post('create-address','Customer\CustomerAddressController@createAddress'); 
        Route::put('update-address/{id}','Customer\CustomerAddressController@updateAddress');
        Route::get('user-address-list','Customer\CustomerAddressController@addressList');

        // Wallet System
        Route::post('add-balance-request','WalletController@AddBalance');
        Route::get('wallet-transactions','WalletController@walletTransaction');

        //billing address
        Route::post('billing-address','Customer\CustomerAddressController@bllingAddress'); 
        Route::get('billing-address-info','Customer\CustomerAddressController@bllingAddressInfo');

        //Shipping address
        Route::post('shipping-address','Customer\CustomerAddressController@shippingAddress');
        Route::get('shipping-address-info','Customer\CustomerAddressController@shippingAddressInfo');
        
        //Payment method
        Route::get('bank-list','BankController@index');
        Route::get('bank-branch-list','BankBranchController@index');
        Route::post('payment-method','MethodPaymentController@store');

        //customer location
        Route::get('division-wise-district','Customer\CustomerAddressController@getDistric');
        Route::get('district-wise-upazila','Customer\CustomerAddressController@getUpazila');
        Route::get('upazila-wise-union','Customer\CustomerAddressController@getUnion'); 

        //place order
        Route::post('krishi-product-place-order','KrishiProduct\KrishiOrderPlaceController@store');
        Route::get('krishi-order-list','KrishiProduct\KrishiOrderPlaceController@index');
        Route::get('krishi-order-details','KrishiProduct\KrishiOrderPlaceController@orderDetails');

        //get Geo Address
        Route::get('divisions','GeoController@getDivisions');
        Route::get('districts','GeoController@getDistricts');
        Route::get('upazilas','GeoController@getUpazilas');
        Route::get('unions','GeoController@getUnions');
        Route::get('villages','GeoController@getVillages');
        Route::get('municipals','GeoController@getMunicipals');
        Route::get('municipal-wards','GeoController@getMunicipalsWards');
    });

    Route::group(['middleware'=>['auth:api']],function (){
        //   For User Authentication

    });

    Route::group(['prefix'=>'krishibazar'],function (){
        Route::group(['prefix'=>'site-info'],function (){
            //   For Website Info
            Route::get('/product-categories','SiteInfoController@productCategories');
            Route::get('/slider-list','SiteInfoController@sliderList');
            Route::get('/rising-star-shops','SiteInfoController@risingStarShops');
            Route::get('/flash-deal-products','SiteInfoController@flashDealProducts');
            Route::get('/best-seller-products','SiteInfoController@bestSellerProducts');
            Route::get('/popular-categories','SiteInfoController@popularCategories');
            Route::get('/new-arrival-products','SiteInfoController@newArrivalProducts');
            Route::get('/upcoming-products','SiteInfoController@upcomingProducts');
            Route::get('/top-rated-products','SiteInfoController@topRatedProducts');
            Route::get('/featured-products','SiteInfoController@featuredProducts');
            Route::get('/category-wise-products/{parent_category}','SiteInfoController@CategoryWiseProducts');
            Route::get('/sub-categories/{parent_slug}','SiteInfoController@getSubCategories');
            Route::get('/parent-categories/{slug}','SiteInfoController@getParentCategories');
            Route::get('/search','SiteInfoController@search');
            Route::get('/shops','SiteInfoController@shops');
            Route::get('/shops-info/{slug}','SiteInfoController@shopInfo');
            Route::get('/shop-product-details/{slug}','SiteInfoController@productDetails');
            Route::get('/shop-products/{slug}','SiteInfoController@shopProducts');
            Route::get('/krishi-bazar-slider','SiteInfoController@sliderList'); 
        });

        //     For product info
        Route::get('/product-details/{slug}','KrishiProductController@product_details');
        Route::get('/product-reviews/{slug}','KrishiProductController@product_reviews');
        Route::get('/related-products/{slug}','KrishiProductController@related_products');

         

    });
});

Route::get('test','SiteInfoController@test');
