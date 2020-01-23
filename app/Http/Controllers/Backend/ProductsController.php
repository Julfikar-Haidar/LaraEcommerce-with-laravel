<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Product_image;
use Image;

class ProductsController extends Controller
{
  public function index()
  {
    $products = Product::orderBy('id', 'desc')->get();
    return view('backend.pages.product.index')->with('products', $products);
  }

  public function create()
  {
    return view('backend.pages.product.create');
  }

  public function edit($id)
  {
    $product = Product::find($id);
    return view('backend.pages.product.edit')->with('product', $product);
  }


  public function store(Request $request)
  {

    $request->validate([
      'title'         => 'required|max:150',
      'description'     => 'required',
      'brand_id'             => 'required',
      'category_id'             => 'required',
      'price'             => 'required|numeric',
      'quantity'             => 'required|numeric',
    ]);



    $product = new Product;

    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;

    $product->slug = str::slug($request->title);
    $product->category_id =$request->category_id;
    $product->brand_id = $request->brand_id;
    $product->admin_id = 1;
    $product->save();

    //ProductImage Model insert image

    // if ($request->hasFile('product_image')) {
    //   //insert that image
    //   $image = $request->file('product_image');
    //   $img = time() . '.'. $image->getClientOriginalExtension();
    //   $location = public_path('images/products/' .$img);
    //   Image::make($image)->save($location);
    //
    //   $product_image = new ProductImage;
    //   $product_image->product_id = $product->id;
    //   $product_image->image = $img;
    //   $product_image->save();
    // }
    if (count($request->product_image) > 0) {
      foreach ($request->product_image as $image) {

        //insert that image
        //$image = $request->file('product_image');
        $img = time() . '.'. $image->getClientOriginalExtension();
        $location = public_path('images/products/' .$img);
        Image::make($image)->save($location);

        $product_image = new Product_image;
        $product_image->product_id = $product->id;
        $product_image->image = $img;
        $product_image->save();

      }
    }
  session()->flash('success','A new product has added successfully !!');
    return redirect()->route('admin.product.create');
  }


  public function update(Request $request, $id)
  {

    $request->validate([
      'title'         => 'required|max:150',
      'description'     => 'required',
      'brand_id'             => 'required',
      'category_id'             => 'required',
      'quantity'             => 'required|numeric',
    ]);

    $product = Product::find($id);

    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category_id =$request->category_id;
    $product->brand_id = $request->brand_id;

    $product->save();

    return redirect()->route('admin.products');
  }

  public function delete($id)
  {
    $product = Product::find($id);
    if (!is_null($product)) {
      $product->delete();
    }
    session()->flash('success', 'Product has deleted successfully !!');
    return back();

  }
}
