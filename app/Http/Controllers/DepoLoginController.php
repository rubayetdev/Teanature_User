<?php

namespace App\Http\Controllers;

use App\Models\DepoInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepoLoginController extends Controller
{
    public function regis(Request $request)
    {
        $user = User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->input('password')),
            'roles'=>'depo'
        ]);


        DepoInfo::create([
            'id'=> $user->id,
            'mobile'=>$request->input('mobile'),
            'action'=>'Inactive',
        ]);

        return redirect()->route('verify',['id'=>$user->id])->with('success','Registration Successful');
    }

    public function loggin(Request $request)
    {
        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)){
            $user = Auth::user();

            $depo = DepoInfo::where('id',$user->id)->first();

            if ($depo && $depo->action == 'Active') {
                return redirect()->route('depo-welcome', ['id' => $user->id]);
            }
            else{
                return redirect()->back()->with('error','Account is not activate.');
            }

        }
        else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function verify()
    {
        $user = \request('id');
        return view('depo.step-verify',['id'=>$user]);
    }

    public function owner_info(Request $request)
    {
        $nidfront = $request->file('nidfront');
        $nidback = $request->file('nidback');
        if($nidfront && $nidback) {
            $originalname = $nidfront->getClientOriginalName();
            $path = $nidfront->storeAs('public/depo/nid', $originalname);
            $path = str_replace('public/', '', $path);
            $pathshared = $nidfront->storeAs('depo/nid', $originalname, 'shared');

            $originalname2 = $nidback->getClientOriginalName();
            $path2 = $nidback->storeAs('public/depo/nid', $originalname2);
            $path2 = str_replace('public/', '', $path2);
            $path2shared = $nidback->storeAs('depo/nid', $originalname, 'shared');
            DepoInfo::where('id', $request->input('id'))->update([
                'owner_name' => $request->input('owner_name'),
                'trade_lic' => $request->input('lic'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'nid_front'=>$path,
                'nid_back'=>$path2,
            ]);
        }

        return redirect()->route('depo-login')->with('success','Registration Successful');
    }
}
