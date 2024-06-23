<?php

namespace App\Http\Controllers;

use App\Models\Customer_Info;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    public function registration(Request $request)
    {
        $ip = $request->ip();
       $user = User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
           'roles' => 'users'
        ]);

        Customer_Info::create([
            'id'=>$user->id,
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('mobile'),
        ]);

        Auth::login($user);

        // Transfer session cart items to user's cart in the database
        $this->transferSessionCartToUser($user);

        Session::flash('success', 'Registration successful. You can now log in.');
        return redirect()->back();
    }

    public function loggedIn(Request $request)
    {
//        dd($request->all());
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            $user = Auth::user();

            // Transfer session cart items to user's cart in the database
            $this->transferSessionCartToUser($user);
            //dd($request->has('redirect') && $request->input('redirect'));
            if ($request->has('redirect') && $request->input('redirect') === 'checkout') {

                return redirect()->route('checkout', ['id' => $user->id]);
            }

                return redirect()->route('welcome', ['id' => $user->id]);

        } else {
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    protected function transferSessionCartToUser($user)
    {
        // Get cart items from session
        $cart = Session::get('cart', []);

        foreach ($cart as $cartItem) {
            // Check if the product is already in the user's cart
            $existingOrder = Order::where('user_id', $user->id)
                ->where('product_id', $cartItem['product_id'])
                ->where('order_status', 'Pending')
                ->first();

            if ($existingOrder) {
                // Update quantity and price of existing order
                $existingOrder->quantity += $cartItem['quantity'];
                $existingOrder->price += $cartItem['price'];
                $existingOrder->save();
            } else {

              Order::create([
                    'user_id' => $user->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                    'order_status' => 'Pending',
                    'roles' => $cartItem['role'],
                    'user_ip_address' => request()->ip(),
                ]);

            }
        }

        // Clear the session cart
        Session::forget('cart');
    }


    public function logout()
    {
        // Save the current cart to a temporary session key
        $cart = Session::get('cart', []);
        Session::put('temp_cart', $cart);

        // Logout the user
        Auth::logout();

        // Regenerate the session ID to avoid session fixation attacks
        Session::regenerate();

        // Restore the cart from the temporary session key
        Session::put('cart', Session::get('temp_cart', []));
        Session::forget('temp_cart');

        return redirect()->route('home');
    }




}
