<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('client.index',compact('products'));
    }
}
