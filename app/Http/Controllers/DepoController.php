<?php

namespace App\Http\Controllers;

use App\Models\Customer_Info;
use App\Models\DepoInfo;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepoController extends Controller
{
    public function login()
    {
        return view('depo.login');
    }

    public function depoHome(){
        $id = \request('id');
        $user = DepoInfo::find($id);
        $category = DB::table('categories')->where('status','Active')->inRandomOrder()->take(3)->get();
        $product = DB::table('products')->inRandomOrder()->take(3)->get();
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.welcome',['id'=>$id,'info'=>$user,
            'category'=>$category,'product'=>$product,'count'=>$count,'mar'=>$mar,
            'contact'=>$contact]);
    }

    public function product()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $category = DB::table('categories')->where('status','Active')->get();
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.product',['id' => $id,'info'=>$user,'count'=>$count,'category'=>$category,
            'mar'=>$mar, 'contact'=>$contact]);
    }

    public function store()
    {

        $id = \request('id');
        $user = DepoInfo::find($id);
        $product = DB::table('products')->get();
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.store',['id' => $id,'info'=>$user,'count'=>$count,'product'=>$product,
            'mar'=>$mar, 'contact'=>$contact]);
    }

    public function contact()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.contact',['id' => $id,'info'=>$user,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function testimonial()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        $testimonials = DB::table('testimonials')->get();
        return view('depo.testimonial',['id' => $id,'info'=>$user,'testimonials'=>$testimonials,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function blogList()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        $blogs = DB::table('blogs')->get();
        return view('depo.blog-list',['id' => $id,'info'=>$user,'blogs'=>$blogs,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }
    public function blog()
    {
        $id = \request('id');
        $blog = \request('blog');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        $blogs = DB::table('blogs')->where('id',$blog)->first();
        return view('depo.blog',['id' => $id,'info'=>$user,'count'=>$count,'blogs'=>$blogs,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function about(){
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        $about = DB::table('abouts')->first();
        return view('depo.about',['id' => $id,'info'=>$user,'count'=>$count,
            'mar'=>$mar, 'contact'=>$contact,'about'=>$about]);
    }

    public function feature()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('depo.feature',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function page()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        return view('depo.404',['id' => $id,'info'=>$user,'count'=>$count]);
    }

    public function single_product()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $prod_id = \request('prod_id');
        $product = DB::table('products')->find($prod_id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.single-product',['id' => $id,'info'=>$user,'product'=>$product,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function cart(Request $request)
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $ip = $request->ip();
        $order = Order::where('user_ip_address',$ip)->where('user_id',$user->id)->where('order_status','Pending')
            ->join('products','orders.product_id','=','products.id')
            ->select('orders.*','products.*','orders.price as total_price','orders.id as orders_id')->get();
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.cart',['id' => $id,'info'=>$user,'order'=>$order,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function order_history()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $product = DB::table('orders')->where('user_id',$user->id)
            ->whereIn('order_status',['Processing','Shipping','Delivered'])
            ->join('products','orders.product_id','=','products.id')
            ->select('orders.*','products.*','orders.price as total_price')
            ->get();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.order-history',['id' => $id,'info'=>$user,'count'=>$count,'product'=>$product,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function my_profile()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $profile = User::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.my-profile',['id' => $profile,'info'=>$user,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function account_settings()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $profile = User::find($id);
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.account-settings',['id' => $profile,'info'=>$user,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }

    public function upload_depo_data(Request $request)
    {
        $img = $request->file('profile_picture');
        if($img) {
            $originalname = $img->getClientOriginalName();
            $path = $img->storeAs('public/depo/user_pic', $originalname);
            $path = str_replace('public/', '', $path);
            $path2 = $img->storeAs('depo/user_pic', $originalname, 'shared');

            DepoInfo::where('id',$request->input('id'))->update([
                'pic' => $path
            ]);
        }

        DepoInfo::where('id',$request->input('id'))->update([
            'owner_name'=>$request->input('ownername'),
            'address'=>$request->input('address'),
            'city'=>$request->input('city'),
            'mobile'=>$request->input('phone')
        ]);


            User::where('id', $request->input('id'))->update([
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ]);

        return redirect()->back();
    }

    public function checkout()
    {
        $id = \request('id');
        $user = DepoInfo::find($id);
        $users = User::find($id);
        $product = Order::where('user_id',$user->id)->where('order_status','Pending')->
        join('products','orders.product_id','=','products.id')
            ->select('orders.*','products.*','orders.price as total_price')
            ->get();
        $count = DB::table('orders')
            ->where('roles','depo')
            ->where('user_id',$user->id)
            ->where('order_status','Pending')->count();
        $mar = DB::table('marqueetexts')->first();
        $contact = DB::table('contacts')->first();
        return view('depo.checkout',['id' => $id,'info'=>$user,'product'=>$product,'users'=>$users,'count'=>$count,'mar'=>$mar, 'contact'=>$contact]);
    }
}
