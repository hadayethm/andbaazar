<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
route::get('check',function(){
    return response()->json(['amer'=>'ki','ta'=>'jani na']);
});
route::get('checks','CategoriesController@getData');
include('frontend.php');
include('merchant.php');
include('agent.php');
include('admin.php');





