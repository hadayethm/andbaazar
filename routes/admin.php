<?php



Route::get('andbaazaradmin/login','AuthController@adminlogin');
Route::post('andbaazaradmin/login','AuthController@adminloginprocess')->name('loginproces');
Route::get('/andbaazaradmin-logout','AuthController@adminLogout');


Route::middleware(['auth','admin'])->prefix('andbaazaradmin')->group(function (){
    // Route::prefix('andbaazaradmin')->group(function () {
    Route::get('dashboard','AdminHomeController@dashboard');
    Route::get('products/category-tree-view',['uses'=>'CategoriesController@manageCategory']);
    Route::get('categories/update/{id}/edit','CategoriesController@edit');
    Route::put('categories/update/{id}','CategoriesController@update');
    Route::resource('categories','CategoriesController');
    Route::get('/category/attribute/{slug}/attribute','CatAttributeController@attribute');
    Route::put('/category/attribute','CatAttributeController@attributeset');
    // Route::get('/category/attribute/{slug}/attribute','CatAttributeController@attribute');
    Route::resource('/category','CatAttributeController');
    Route::get('products/subcategory-tree-view',['uses'=>'CategoriesController@manageSubCategory']);
    Route::put('/add-category','CategoriesController@addCategory')->name('add.category');
    // Route::post('/add-category',['as'=>'add.category','uses'=>'CategoriesController@addCategory']);
    Route::resource('products/category','CategoriesController');
    Route::resource('/child','ChildrenController');
    Route::resource('/paymentmethod','PaymentMethodsController');
    Route::resource('/shippingmethod','ShippingMethodsController');
    Route::resource('promotion','PromotionsController');
    Route::resource('/promotionhead','PromotionHeadsController');
    Route::resource('/promotionplan','PromotionPlansController');
    Route::resource('/coupon-codes','Admin\CouponCodeController');
    Route::resource('/currency','CurrenciesController');
    Route::resource('/courier','CouriersController');
    //Route::get('/seller','SellersController@index');
    Route::post('/reject-name','RejectListController@other');
    Route::resource('/reject','RejectListController');

    //    For Merchants
    //    ============================
    Route::get('/merchants','Admin\MerchantController@active_merchants');
    Route::get('/merchants/active','Admin\MerchantController@active_merchants');
    Route::get('/merchants/pending','Admin\MerchantController@pending_merchants');
    Route::get('/merchants/rejected','Admin\MerchantController@rejected_merchants');
    //    =============================

    //    For Agents
    //    ==============================
    Route::get('/agents','Admin\AgentController@active_agents');
    Route::get('/agents/active','Admin\AgentController@active_agents');
    Route::get('/agents/pending','Admin\AgentController@pending_agents');
    Route::get('/agents/rejected','Admin\AgentController@rejected_agents');
    //    ==============================

    //    For Customers
    //    ==============================
    Route::get('/customers','Admin\CustomerController@active_customers');
    Route::get('/customers/active','Admin\CustomerController@active_customers');
    Route::get('/customers/pending','Admin\CustomerController@pending_customers');
    Route::get('/customers/rejected','Admin\CustomerController@rejected_customers');
    Route::post('/customers/approve-customer/{id}','Admin\CustomerController@approve_customer');
    Route::post('/customers/reject-customer/{id}','Admin\CustomerController@reject_customer');
    Route::post('/customers/delete-customer/{id}','Admin\CustomerController@destroy');
    //    ==============================

    //    For Order Tracking Stage
    //    ==============================
    Route::post('/update-tracking-stages-order','Admin\OrderTrackingStageController@updateTrackingStageOrder');
    Route::resource('/order-tracking-stages','Admin\OrderTrackingStageController');
    //    ==============================

    //    For CMS
    //    ==============================
    Route::resource('/cms/sliders','Admin\KrishiBazarSliderController');
    //    ==============================

    Route::get('/newsfeed','NewsfeedController@feedlist');

    Route::resource('products/size','SizesController');
    Route::resource('products/tag','TagsController');
    Route::resource('products/color','ColorsController');
    Route::resource('products/brand','BrandController');

    Route::get('e-commerce/products/','ProductsController@productList');
    Route::get('products/AllProduct','ProductsController@productTableList');

    // SME Product list start //

    Route::get('sme/products/','SmeProductController@smeproductList');

    // SME Product list start //

    //Auctionproduct list start

    Route::get('auction/products/','AuctionproductController@auctionProductList');
    Route::get('color-image/{color_slug}','ProductsController@colorWiseImage');
    Route::resource('/shop','ShopsController');
    Route::get('category_setup','CategorySetupController@index');


    //    Krishi Product  Start //

    Route::resource('krishi/products/category','Admin\KrishiProductCategoryController');
    Route::get('krishi/products/active','Admin\KrishiProductController@activeProducts');
    Route::get('krishi/products/upcoming','Admin\KrishiProductController@upcomingProducts');
    Route::get('krishi/products/pending','Admin\KrishiProductController@pendingProducts');
    Route::get('krishi/products/rejected','Admin\KrishiProductController@rejectedProducts');
    Route::get('krishi/products/{productSlug}','Admin\KrishiProductController@show');
    Route::get('krishi/approve-product/{productId}','Admin\KrishiProductController@approveProduct');
    Route::get('krishi/reject-product/{productId}','Admin\KrishiProductController@rejectProduct');
    Route::delete('krishi/product/{productId}','Admin\KrishiProductController@destroy');
    Route::get('krishi/products','Admin\KrishiProductController@activeProducts');


    // Attribute import Start//

    Route::get('import-attribute', 'ExportImportController@importExportView');
    Route::post('attribute-import','ExportImportController@import')->name('attributestore');

    Route::get('export', 'ExportImportController@export')->name('export');

    // Attribute import End//

    // Inventory import Start//

    Route::get('import-inventory', 'InvExportImportController@importExportView');
    Route::post('inventory-import','InvExportImportController@import')->name('inventorystore');

    Route::get('inventory/export', 'InvExportImportController@export')->name('invexport');

    // Inventory import End//

    // Village import Start//

    Route::get('import-village', 'VillageExportImportController@importExportView');
    Route::post('village-import','VillageExportImportController@import')->name('villagestore');

    Route::get('village/export', 'VillageExportImportController@export')->name('villageexport');

    // Village import End//

});

// Category import
Route::get('categoryImport', 'CategoryExportImportController@CategoryImportView');
Route::get('catExport', 'CategoryExportImportController@export')->name('catexport');
Route::post('catImport', 'CategoryExportImportController@import')->name('catimport');

