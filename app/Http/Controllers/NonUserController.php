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
        $text = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.welcome',[
            'category'=>$category,'product'=>$product,'text'=>$text,'contact'=>$contact]);
    }

    public function login(Request $request)
    {
        $redirect = $request->input('redirect');
        return view('non-user.login',['redirect'=>$redirect]);
    }

    public function product()
    {
        $category = DB::table('categories')->where('status','Active')->get();
        $text = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.product',['category'=>$category,'text'=>$text,'contact'=>$contact]);
    }

    public function store()
    {
        $product = DB::table('products')->get();
        $text = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.store',['product'=>$product,'text'=>$text,'contact'=>$contact]);
    }

    public function contact()
    {
        $text = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.contact',['text'=>$text,'contact'=>$contact]);
    }

    public function testimonial()
    {
        $text = DB::table('marqueetexts')->first();
        $testimonials = DB::table('testimonials')->get();
        $contact = DB::table('contacts')->first();
        return view('non-user.testimonial',['text'=>$text,'testimonials'=>$testimonials,'contact'=>$contact]);
    }

    public function blog()
    {
        $id = \request('id');
        $blogs = DB::table('blogs')->where('id',$id)->first();
        $text = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.blog',['text'=>$text,'blogs'=>$blogs,'contact'=>$contact]);
    }

    public function blogList()
    {
        $text = DB::table('marqueetexts')->first();
        $blogs = DB::table('blogs')->get();
        $contact = DB::table('contacts')->first();
        return view('non-user.blog-list',['text'=>$text,'blogs'=>$blogs,'contact'=>$contact]);
    }

    public function about(){
        $text = DB::table('marqueetexts')->first();
        $about = DB::table('abouts')->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.about',['text'=>$text,'about'=>$about,'contact'=>$contact]);
    }

    public function feature()
    {
        $text = DB::table('marqueetexts')->first();
        return view('non-user.feature',['text'=>$text]);
    }

    public function page()
    {
       return view('non-user.404');
    }

    public function single_product()
    {
        $text = DB::table('marqueetexts')->first();
        $prod = \request('id');
        $products = DB::table('products')->where('id',$prod)->first();
        $contact = DB::table('contacts')->first();
        return view('non-user.single-product',['products'=>$products,'text'=>$text,'contact'=>$contact]);
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
        $text = DB::table('marqueetexts')->first();
        $cart = Session::get('cart', []);
        $contact = DB::table('contacts')->first();
        return view('non-user.cartview', ['cart'=>$cart,'text'=>$text,'contact'=>$contact]);
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
