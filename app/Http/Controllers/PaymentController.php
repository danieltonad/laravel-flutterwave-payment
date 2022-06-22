<?php


namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use VoguePay\VoguePay;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    //
    // public

    public static function makePayment($user_id,$email){
        $tx_ref = time();
        $amount =  1500;
        $currency = env('FLW_CURRENCY');
        $redirect_url = env('APP_URL') . '/payment/verify';
        $customer = [
            "email" => "$email"
        ];
        $endpoint = env('FLW_ENDPOINT');
        // curl FLW ENDPOINT
        $post = (object) Http::withHeaders([
            'Authorization' => 'Bearer '.env('FLW_API_KEY')
        ])->post($endpoint, [
            'tx_ref' => $tx_ref,
            'amount' => $amount,
            'currency' => $currency,
            'redirect_url' => $redirect_url,
            'customer' => $customer,
        ])->json();

        // track transaction
        PaymentStatus::create([
            "id" => $tx_ref,
            "status" => PENDING,
            "user_id" => $user_id
        ]);

        if($post->status == "success"){
            return redirect(to: $post->data['link']);
        }
        else{
            return redirect(to:'/dashboard');
        }
    }
}
