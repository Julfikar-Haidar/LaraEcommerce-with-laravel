<?php

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



Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/contact', 'Frontend\PagesController@contact')->name('contact');

/*
Product Routes
All the routes for our product for frontend
*/
Route::group(['prefix' => 'products','namespace'=>'Frontend'], function(){

  Route::get('/', 'ProductsController@index')->name('products');
  Route::get('/{slug}', 'ProductsController@show')->name('products.show');
  Route::get('/search', 'PagesController@search')->name('search');

  //Category Routes
  Route::get('/categories', 'CategoriesController@index')->name('categories.index');
  Route::get('/category/{slug}', 'CategoriesController@show')->name('categories.show');
});



// User Routes
Route::get('user/token/{token}', 'Frontend\VerificationController@verify')->name('user.verification');



// Admin Routes
Route::group(['prefix' => 'admin','namespace'=>'Backend'], function(){
  Route::get('/', 'PagesController@index')->name('admin.index');


// Product Routes
  Route::group(['prefix' => '/products'], function(){
    Route::get('/', 'ProductsController@index')->name('admin.products');
    Route::get('/create', 'ProductsController@create')->name('admin.product.create');
    Route::get('/edit/{id}', 'ProductsController@edit')->name('admin.product.edit');

    Route::post('/store', 'ProductsController@store')->name('admin.product.store');

    Route::post('/product/edit/{id}', 'ProductsController@update')->name('admin.product.update');
    Route::post('/product/delete/{id}', 'ProductsController@delete')->name('admin.product.delete');

  });


  // Category Routes
  Route::group(['prefix' => '/categories'], function(){
    Route::get('/', 'CategoriesController@index')->name('admin.categories');
    Route::get('/create', 'CategoriesController@create')->name('admin.category.create');
    Route::get('/edit/{id}', 'CategoriesController@edit')->name('admin.category.edit');

    Route::post('/store', 'CategoriesController@store')->name('admin.category.store');

    Route::post('/category/edit/{id}', 'CategoriesController@update')->name('admin.category.update');
    Route::post('/category/delete/{id}', 'CategoriesController@delete')->name('admin.category.delete');
  });

   // Brand Routes
  Route::group(['prefix' => '/brands'], function(){
    Route::get('/', 'BrandsController@index')->name('admin.brands');
    Route::get('/create', 'BrandsController@create')->name('admin.brand.create');
    Route::get('/edit/{id}', 'BrandsController@edit')->name('admin.brand.edit');

    Route::post('/store', 'BrandsController@store')->name('admin.brand.store');

    Route::post('/brand/edit/{id}', 'BrandsController@update')->name('admin.brand.update');
    Route::post('/brand/delete/{id}', 'BrandsController@delete')->name('admin.brand.delete');
  });

 // Division Routes
  Route::group(['prefix' => '/divisions'], function(){
    Route::get('/', 'DivisionsController@index')->name('admin.divisions');
    Route::get('/create', 'DivisionsController@create')->name('admin.division.create');
    Route::get('/edit/{id}', 'DivisionsController@edit')->name('admin.division.edit');

    Route::post('/store', 'DivisionsController@store')->name('admin.division.store');

    Route::post('/division/edit/{id}', 'DivisionsController@update')->name('admin.division.update');
    Route::post('/division/delete/{id}', 'DivisionsController@delete')->name('admin.division.delete');
  });

  // District Routes
  Route::group(['prefix' => '/districts'], function(){
    Route::get('/', 'DistrictsController@index')->name('admin.districts');
    Route::get('/create', 'DistrictsController@create')->name('admin.district.create');
    Route::get('/edit/{id}', 'DistrictsController@edit')->name('admin.district.edit');

    Route::post('/store', 'DistrictsController@store')->name('admin.district.store');

    Route::post('/district/edit/{id}', 'DistrictsController@update')->name('admin.district.update');
    Route::post('/district/delete/{id}', 'DistrictsController@delete')->name('admin.district.delete');
  });


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
