<?php

namespace App\Http\Controllers;

use App\Library\UddoktaPay;
use App\Models\Order;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;


class UddoktapayController extends Controller {



    public function insertPayment(Request $request)
    {

        $userid = $request->input('id');
        $shipping = $request->input('address');
        $projectid = $request->input('city');
        $projectname = $request->input('zip');
        $service = $request->input('paymentBkash');
        $amount = $request->input('total');
        $order = $request->input('paymentCOD');
        $invoice = rand(1000,9999);

        $request->session()->put('id', $userid);
//        $request->session()->put('project_id', $projectid);
        $request->session()->put('invoice',$invoice);

        if ($order) {
            Order::where('user_id', $userid)->where('order_status', 'Pending')->update([
                'invoice_id' => $invoice,
                'order_status' => 'Processing',
                'payment_method' => 'COD',
                'shipping_address' => $shipping,
                'shipping_city' => $projectid,
                'zip_code' => $projectname,
            ]);

            return redirect()->back();
        }

        elseif ($service) {

            Order::where('user_id', $userid)->where('order_status', 'Pending')->update([
                'invoice_id' => $invoice,


                'shipping_address' => $shipping,
                'shipping_city' => $projectid,
                'zip_code' => $projectname,
            ]);


            return $this->pay($request);
        }
    }

    // public function show() {
    //     $amount = \request('amounts');
    //     return view( 'uddoktapay.payment-form',['amount'=>$amount]);
    // }




    public function pay( Request $request) {

        $apiKey = config('uddoktapay.api_key');
        $apiBaseURL = config('uddoktapay.api_url');
        $uddoktaPay = new UddoktaPay($apiKey, $apiBaseURL);

        // dd($uddoktaPay);
        $amount = $request->total;

//        dd($amount);
        $userid = $request->session()->get('id');
        $invoice = $request->session()->get('invoice');
        $user = User::find($userid); // Assuming you have a User model

        $requestData = [
            'full_name' => $user->name, // Replace with actual user name
            'email' => $user->email, // Replace with actual user email
            'amount' => $amount,
            'metadata' => [
                'invoice_id' => $invoice,
                'user_id' => $userid,
            ],
            'redirect_url' => route('uddoktapay.success'), // add your success route
            'return_type' => 'GET',
            'cancel_url' => route('uddoktapay.cancel'), // add your cancel route
            'webhook_url' => route('uddoktapay.webhook'), // add your ipn route
        ];

            try{

            $paymentUrl = $uddoktaPay->initPayment($requestData);
            return redirect($paymentUrl);

            } catch (\Exception $e)
            {
                dd($e->getMessage());
            }
            // dd($paymentUrl);


    }

    /**
     * Reponse from sever
     *
     * @param Request $request
     * @return void
     */
    public function webhook(Request $request) {
        $headerApi = isset($_SERVER['RT_UDDOKTAPAY_API_KEY']) ? $_SERVER['RT_UDDOKTAPAY_API_KEY'] : null;

        if ($headerApi == null) {
            return response("Api key not found", 403);
        }

        if ($headerApi != config('uddoktapay.api_key')) {
            return response("Unauthorized Action", 403);
        }

        $data = $request->all();
        $invoiceId = $data['metadata']['invoice_id'];
        $transactionId = $data['transaction_id'];
        $paymentMethod = $data['payment_method'];

        // Use the invoice ID to update the order status
        Order::where('invoice_id', $invoiceId)->update([
            'payment_method' => $paymentMethod,
            'order_status' => 'Processing',
            'transaction_id' => $transactionId,
        ]);

        return response('Database Updated', 200);
    }







    public function success(Request $request) {
        $invoiceId = $request->invoice_id; // Retrieve invoice ID from query parameter


        try{
        $apiKey = config('uddoktapay.api_key');
        $apiBaseURL = config('uddoktapay.api_url');
        $uddoktaPay = new UddoktaPay($apiKey, $apiBaseURL);

        $response = $uddoktaPay->verifyPayment($invoiceId);
        } catch (\Exception $e)
        {
            dd($e->getMessage());
        }


        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Update order status based on the invoice ID
            Order::where('invoice_id', $response['metadata']['invoice_id'])->update([
                'payment_method' => $response['payment_method'],
                'order_status' => 'Processing',
                'transaction_id' => $response['transaction_id'],
            ]);
//            dd($response['metadata']['invoice_id']);
            $invoice = $response['metadata']['invoice_id'];
//            dd($invoice);
            return redirect()->route('invoice',['id'=>$invoice]);
        } else {
            return 'Payment verification failed.';
        }
    }



    /**
     * Cancel URL
     *
     * @return void
     */
    public function cancel() {
        return 'Payment is cancelled.';
    }

}
