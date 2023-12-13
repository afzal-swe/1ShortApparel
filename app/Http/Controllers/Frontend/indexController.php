<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\Product;

class indexController extends Controller
{
    //

    public function home_page()
    {
        $category = Categorie::all();
        $product_slider = Product::where('product_slider', 1)->latest()->first();

        return view('frontend.layouts.main', compact('category', 'product_slider'));
        // return view('frontend.layouts.main');
    }
}
