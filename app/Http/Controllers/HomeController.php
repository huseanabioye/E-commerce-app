<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        $product = Product::all();
        //  $product->name;
        return view('home.index', compact('product'));
    }

    public function login_home()
    {
        $product = Product::all();
        //  $product->name;
        return view('home.index', compact('product'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        return view('home.product_details',compact('data'));
    }

    public function add_cart($id){
        $product_id = $id;
        $user = Auth::user();

        $user_id = $user->id;

        $data = new cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();

        return redirect()->back();
        



    }
}
