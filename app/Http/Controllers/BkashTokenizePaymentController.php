<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use App\Mail\InvoiceMail;
class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }

    public function insertPayment(Request $request)
    {

        $userid = $request->input('id');
        $shipping = $request->input('address');
        $projectid = $request->input('city');
        $projectname = $request->input('zip');
        $service = $request->input('paymentMethod');
        $amount = $request->input('total');
//        $order = $request->input('paymentCOD');
        $invoice = rand(1000,9999);

        $request->session()->put('id', $userid);
//        $request->session()->put('project_id', $projectid);
        $request->session()->put('invoice',$invoice);

        if ($service == 'COD') {
          $order = Order::where('user_id', $userid)->where('order_status', 'Pending')->update([
                'invoice_id' => $invoice,
                'order_status' => 'Processing',
                'payment_method' => 'COD',
                'shipping_address' => $shipping,
                'shipping_city' => $projectid,
                'zip_code' => $projectname,
            ]);

            if ($order) {
                $updatedOrder = Order::where('user_id', $userid)
                    ->where('invoice_id', $invoice)
                    ->first();

//                dd($updatedOrder);
                // Fetch all admin email addresses from the `admins` table
                $adminEmails = DB::table('admins')->pluck('email')->toArray();

                //dd($updatedOrder->user->email);


                $userEmail = User::where('id',$updatedOrder->user_id)->first();


                // Merge user email with admin emails
                $recipients = array_merge([$userEmail->email], $adminEmails);

                // Send email to all recipients
                foreach ($recipients as $email) {
                    Mail::to($email)->send(new InvoiceMail($updatedOrder));
                }
            }

            return redirect()->route('invoice',['id'=>$invoice]);
        }

        elseif ($service == 'Bkash') {

            Order::where('user_id', $userid)->where('order_status', 'Pending')->update([
                'invoice_id' => $invoice,


                'shipping_address' => $shipping,
                'shipping_city' => $projectid,
                'zip_code' => $projectname,
            ]);


            return redirect()->route('bkash-create-payment',
                ['amounts' => $amount]
            );
        }
    }

    public function createPayment(Request $request)
    {


        $amount = $request->query('amounts', 0);


//            dd($userid);


 //      dd($amount);

        // Call the insertPayment function with the request



        // Or you can use it in the request payload
        $inv = uniqid();

        $request['intent'] = 'sale';
        $request['mode'] = '0011';  //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $amount; // Use the amount received from the request
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont.. default param is 1

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response


        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }


    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        $userid = $request->session()->get('id');
        $projectid = $request->session()->get('invoice');
//        $order = $request->session()->get('order_id');
//        $userid = $request->query('userid',0);
        //$projectid = $request->input('projectid');
//        dd($projectid);
        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */

               $order = Order::where('order_status','Pending')->where('user_id',$userid)->where('invoice_id',$projectid)->update([
                    'transaction_id'=>$response['trxID'],
                    'payment_method'=>'bKash',
                    'order_status' => 'Processing',
                ]);
                if ($order) {
                    $updatedOrder = Order::where('user_id', $userid)
                        ->where('invoice_id', $projectid)
                        ->first();

                    // Fetch all admin email addresses from the `admins` table
                    $adminEmails = DB::table('admins')->pluck('email')->toArray();

                    // Fetch the user's email
                    $userEmail = User::where('id',$updatedOrder->user_id)->first();

                    // Merge user email with admin emails
                    $recipients = array_merge([$userEmail], $adminEmails);

                    // Send email to all recipients
                    foreach ($recipients as $email) {
                        Mail::to($email)->send(new InvoiceMail($updatedOrder));
                    }
                }
                return redirect()->route('invoice',['id'=>$projectid]);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
