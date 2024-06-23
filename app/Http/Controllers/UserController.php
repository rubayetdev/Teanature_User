<?php

namespace App\Http\Controllers;

use App\Models\Customer_Info;
use App\Models\DepoInfo;
use App\Models\Order;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $id = \request('id');
        $ip = request()->ip();
        $user = Customer_Info::find($id);
        $category = DB::table('categories')->where('status','Active')->inRandomOrder()->take(3)->get();
        $product = DB::table('products')->inRandomOrder()->take(3)->get();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.welcome',['id' => $id,'info'=>$user,
            'category'=>$category,'product'=>$product,'count'=>$count]);
    }

    public function login(Request $request)
    {

        return view('login');
    }

    public function product()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $category = DB::table('categories')->where('status','Active')->get();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.product',['id' => $id,'info'=>$user,'category'=>$category,'count'=>$count]);
    }

    public function store()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $product = DB::table('products')->get();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.store',['id' => $id,'info'=>$user,'product'=>$product,'count'=>$count]);
    }

    public function contact()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.contact',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function testimonial()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.testimonial',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function blog()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.blog',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function about(){
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.about',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function feature()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.feature',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function page()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        return view('user.404',['id' => $id,'info'=>$user]);
    }

    public function single_product()
    {
        $id = \request('id');

        $prod_id = \request('prod_id');
        $user = Customer_Info::find($id);
        $product = DB::table('products')->find($prod_id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.single-product',['id' => $id,'info'=>$user,'product'=>$product,'count'=>$count]);
    }

    public function cart(Request $request)
    {
        $ip = $request->ip();
        $user = Auth::user();

        if ($user) {
            $order = Order::where('user_ip_address', $ip)
                ->where('user_id', $user->id)
                ->where('order_status', 'Pending')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select('orders.*', 'products.*', 'orders.price as total_price', 'orders.id as orders_id')
                ->get();

            $count = Order::where('user_ip_address', $ip)
                ->where('user_id', $user->id)
                ->where('order_status', 'Pending')
                ->count();
        } else {
            $cart = Session::get('cart', []);
            $order = collect($cart)->map(function ($item) {
                $product = DB::table('products')->find($item['product_id']);
                return (object) array_merge((array) $item, (array) $product);
            });
            $count = count($cart);
        }

        return view('user.cart', ['info' => $user, 'order' => $order, 'count' => $count]);
    }



    public function order_history()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $product = DB::table('orders')->where('user_id',$user->id)
            ->whereIn('order_status',['Processing','Shipping','Delivered'])
            ->join('products','orders.product_id','=','products.id')
            ->select('orders.*','products.*','orders.price as total_price')
        ->get();
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.order-history',['id' => $id,'info'=>$user,'product'=>$product,'count'=>$count]);
    }

    public function my_profile()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.my-profile',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function account_settings()
    {
        $id = \request('id');
        $user = Customer_Info::find($id);
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.account-settings',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function upload_user_data(Request $request)
    {
        $img = $request->file('profile_picture');
        if($img) {
            $originalname = $img->getClientOriginalName();
            $path = $img->storeAs('public/users/user_pic', $originalname);
            $path = str_replace('public/', '', $path);
           $path2 = $img->storeAs('users/user_pic', $originalname, 'shared');

            Customer_Info::where('id',$request->input('id'))->update([
                'image' => $path
            ]);
        }

        Customer_Info::where('id',$request->input('id'))->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'address'=>$request->input('address'),
            'distric'=>$request->input('city')
        ]);


        User::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect()->back();
    }


    public function create_order(Request $request)
    {
        $product = DB::table('products')->find($request->input('product_id'));
        $ipAddress = $request->ip();
        $quantity = (int) $request->input('quantity');
        $role = $request->input('role');

        // Calculate the total price
        $price = $role == 'depo' ? $product->cartoonprice * $quantity : $product->price * $quantity;

        $cartItem = [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $quantity,
            'price' => $price,
            'role' => $role
        ];

        if (Auth::check()) {
            $user = Auth::user();
            // Check if the product is already in the user's cart
            $existingOrder = Order::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->where('order_status', 'Pending')
                ->first();

            if ($existingOrder) {
                // Update quantity and price of existing order
                $existingOrder->quantity += $quantity;
                $existingOrder->price += $price;
                $existingOrder->save();
            } else {
                // Create a new order for the user
                Order::create([
                    'user_id' => $user->id,
                    'user_ip_address' => $ipAddress,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'order_status' => 'Pending',
                    'roles' => $role
                ]);
            }
        } else {
            $cart = Session::get('cart', []);

            // Check if the product is already in the cart
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
                $cart[$product->id]['price'] += $price;
            } else {
                $cart[$product->id] = $cartItem;
            }

            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }


    public function checkout()
    {
        if (!Auth::check()) {
            // Redirect user to login page with intended redirect URL
            return redirect()->route('login', ['redirect' => route('checkout')]);
        }

        // Retrieve id from request
        $id = request('id');

        // Find customer info by id
        $user = Customer_Info::find($id);

        // Check if customer info was found
        if (!$user) {
            // Handle case where customer info is not found
            abort(404); // or any other appropriate action, e.g., redirect back
        }
        $product = Order::where('user_id',$user->id)->where('order_status','Pending')
            ->join('products','orders.product_id','=','products.id')
            ->select('orders.*','products.*','orders.price as total_price')
            ->get();
        $ip = request()->ip();
        $count = DB::table('orders')
            ->where('user_ip_address',$ip)
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('user.checkout',['id' => $id,'info'=>$user,'product'=>$product,'count'=>$count]);
    }

    public function invoice()
    {
        $invoice = \request('id');

        $role = DB::table('orders')->where('invoice_id',$invoice)->first();

        $now = Carbon::now('Asia/Dhaka');
        if ($role->roles == 'users') {
            $infos = DB::table('orders')->where('invoice_id',$invoice)
                ->join('products','orders.product_id','=','products.id')
                ->select('orders.*','orders.price as total_price','products.*','products.price as price')
                ->get();
        }
        else
            $infos = DB::table('orders')->where('invoice_id',$invoice)
                ->join('products','orders.product_id','=','products.id')
                ->select('orders.*','orders.price as total_price','products.*','products.cartoonprice as price')
                ->get();

        if ($role->roles == 'users') {
            $customer = DB::table('orders')->where('invoice_id', $invoice)
                ->join('customer__infos', 'orders.user_id', '=', 'customer__infos.id')
                ->select('orders.*', 'customer__infos.*')
                ->first();
        }
        else
            $customer = DB::table('orders')->where('invoice_id', $invoice)
                ->join('depo_infos', 'orders.user_id', '=', 'depo_infos.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'depo_infos.*')
                ->first();
//        dd($customer);


        if ($role->roles == 'users') {
            $shippingDhaka = DB::table('shipping_charges')->where('roles', 'users')->where('places', 'Dhaka')->first();
            $shippingOther = DB::table('shipping_charges')->where('roles', 'users')->where('places', '!=', 'Dhaka')->first();
        }
        else {
            $shippingDhaka = DB::table('shipping_charges')->where('roles', 'depo')->where('places', 'Dhaka')->first();
            $shippingOther = DB::table('shipping_charges')->where('roles', 'depo')->where('places', '!=', 'Dhaka')->first();
        }

        return view('user.invoice',['infos'=>$infos,'customer'=>$customer,
            'shippingDhaka'=>$shippingDhaka,'shippingOther'=>$shippingOther,'date'=>$now,'roles'=>$role]);
    }

    public function update_cart(Request $request)
    {
        $product = DB::table('products')->where('id',$request->input('prod'))->first();
        if ($request->input('role')=='depo')
            Order::where('id',$request->input('id'))->update([

                'quantity' => $request->input('quantity'),
                'price' => $product->cartoonprice * $request->input('quantity'),

            ]);
        else
            Order::where('id',$request->input('id'))->update([

                'quantity' => $request->input('quantity'),
                'price' => $product->price * $request->input('quantity'),

            ]);

        return redirect()->back();
    }

    public function deleteCart(Request $request)
    {
        Order::where('id',$request->input('id'))->delete();

        return redirect()->back();
    }
}
