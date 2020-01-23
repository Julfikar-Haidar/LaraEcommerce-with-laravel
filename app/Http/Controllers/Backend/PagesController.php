<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Product_image;
use Image;

class PagesController extends Controller
{
    public function index()
    {
        return view('backend.pages.index');
    }

}
