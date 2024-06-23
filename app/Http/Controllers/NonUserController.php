<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NonUserController extends Controller
{
    public function index()
    {
        $category = DB::table('categories')->where('status','Active')->inRandomOrder()->take(3)->get();
        $product = DB::table('products')->inRandomOrder()->take(3)->get();
        return view('non-user.welcome',[
            'category'=>$category,'product'=>$product]);
    }

    public function login(Request $request)
    {
        $redirect = $request->input('redirect');
        return view('non-user.login',['redirect'=>$redirect]);
    }

    public function product()
    {
        $category = DB::table('categories')->where('status','Active')->get();
        return view('non-user.product',['category'=>$category]);
    }

    public function store()
    {
        $product = DB::table('products')->get();
        return view('non-user.store',['product'=>$product]);
    }

    public function contact()
    {
        return view('non-user.contact');
    }

    public function testimonial()
    {
        return view('non-user.testimonial');
    }

    public function blog()
    {
        return view('non-user.blog');
    }

    public function about(){
        return view('non-user.about');
    }

    public function feature()
    {
        return view('non-user.feature');
    }

    public function page()
    {
       return view('non-user.404');
    }

    public function single_product()
    {
        $prod = \request('id');
        $products = DB::table('products')->where('id',$prod)->first();
        return view('non-user.single-product',['products'=>$products]);
    }

    public function create_orders(Request $request)
    {
        $product = DB::table('products')->find($request->input('product_id'));

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $quantity = (int) $request->input('quantity', 1);
        $price = $product->price * $quantity;

        $cart = Session::get('cart', []);

        $cartItem = [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $quantity,
            'price' => $price,
            'role' => 'users'
        ];

//        dd($cartItem);
        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
            $cart[$product->id]['price'] += $price;
        } else {
            $cart[$product->id] = $cartItem;
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        return view('non-user.cartview', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart', []);
        $product_id = $request->input('product_id');

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

}
