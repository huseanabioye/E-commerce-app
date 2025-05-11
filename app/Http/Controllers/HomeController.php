<?php

namespace App\Http\Controllers;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;
use App\Models\cart;
use App\Models\Order;

use Stripe\Stripe;
use Stripe\Charge;


use Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype','user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status','Delivered')->get()->count();
        return view('admin.index',compact('user', 'product', 'order','delivered'));
    }

    public function home()
    {
        $product = Product::all();
        //  $product->name;

        if(Auth::id()){


        $user = Auth::user();

        $userid = $user->id;

        $count = cart::where('user_id', $userid)->count();
        }
        else {
            $count = '';
        }

        return view('home.index', compact('product','count'));
    }

    public function login_home()
    {
        $product = Product::all();

        if(Auth::id()){


            $user = Auth::user();

            $userid = $user->id;

            $count = cart::where('user_id', $userid)->count();
            }
            else {
                $count = '';
            }
        //  $product->name;
        return view('home.index', compact('product', 'count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        if(Auth::id()){


            $user = Auth::user();

            $userid = $user->id;

            $count = cart::where('user_id', $userid)->count();
            }
            else {
                $count = '';
            }
        return view('home.product_details',compact('data','count'));
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

    public function myCart()
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = cart::where('user_id',$userid)->count();

            $cart = cart::where('user_id',$userid)->get();
        }
        return view('home.myCart',compact('count', 'cart'));
    }

    public function delete_cart($id)
    {
        $data = cart::find($id);

        $data->delete();

        return redirect()->back();

    }

    public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;

        $cart = cart::where('user_id', $userid)->get();


        foreach($cart as $carts){

            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;

            $order->save();


        }

        $cart_remove = cart::where('user_id',$userid)->get();

        foreach ($cart_remove as  $remove) {


            $data = cart::find($remove->id);

            $data->delete();
        }

        return redirect()->back();


        }

        public function myOrders()
        {

            $user = Auth::user()->id;

            $count = cart::where('user_id',$user)->get()->count();

            $order = Order::where('user_id',$user)->get();
            return view('home.order', compact('count', 'order'));
        }


        public function stripe($value){
            return view('home.stripe',compact('value'));
        }


        public function stripePost(Request $request,$value)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    Charge::create([
        "amount" => $value * 100, // $100 in cents
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Test Payment from complete"
    ]);

        $name = Auth::user()->name;
        $address = Auth::user()->address;
        $phone = Auth::user()->phone;
        $userid = Auth::user()->id;

        $cart = cart::where('user_id', $userid)->get();


        foreach($cart as $carts){

            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->payment_status = "paid";
            $order->product_id = $carts->product_id;

            $order->save();

    // Session::flash('success', "Payment successful");

    // return back();

}


$cart_remove = cart::where('user_id',$userid)->get();

foreach ($cart_remove as  $remove) {


    $data = cart::find($remove->id);

    $data->delete();
}

return redirect('/myCart');
}
}


        // public function stripePost(Request $request)
        // {
        //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //     Stripe\Charge::create([

        //         "amount" =>100 *100,
        //         "currency" => "usd",
        //         "source" => $request->stripeToken,
        //         "description"=> "Test Payment from complete"


        //     ]);

        //     Session::flash('success ', "Payment successful");

        //     return back();
        // }


