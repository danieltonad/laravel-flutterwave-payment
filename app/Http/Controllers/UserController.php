<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\PaymentStatus;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    // create user
    public function createUser(RegisterUserRequest $request)
    {

        // create user 

        // 
        $user = User::create([
            "fullname" => $request->fullname,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "user_type" => $request->user_type == "admin" ? ADMIN : FREE_USER
        ]);

        $errors = new MessageBag();
        $errors->add("login", "$request->user_type registration successfull !!");
        // 
        return redirect(to: '/login')->withErrors($errors);
    }


    public function loginUser(LoginUserRequest $request)
    {
        // error bag
        $errors = new MessageBag();

        $user = User::where('username', "$request->username")->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // user session
                $request->session()->put('username', $request->username);

                return redirect(to: '/dashboard');
            } else {
                $errors->add("login", "Invalid User Credentials");

                return redirect(to: '/login')->withErrors($errors);
            }
        } else {
            // invalid user
            $errors->add("login", "Invalid Username");

            return redirect(to: '/login')->withErrors($errors);
        }
    }



    // dashboard
    public function dashboard()
    {
        $user = AuthCheck(session('username'));
        if ($user)
            return view('dashboard')->with([
                "user" => $user,
                "user_list"=> User::where('user_type','<>',ADMIN)->orderBy('created_at',"DESC")->get()
            ]);
        else
            return redirect(to: '/logout');
    }

    // logout
    public function logout()
    {
        session()->flush();
        return redirect(to: '/login');
    }

    // upgrade Plan
    public function upgradePlan()
    {
        $user = AuthCheck(session('username'));
        if ($user) {
            return PaymentController::makePayment($user->id, $user->email);
            // return "Plan upgrade";
        } else
            return redirect(to: '/logout');
    }

    // verify payment
    public function verifyPayment(Request $request)
    {
        $user = AuthCheck(session('username'));
        if ($user) {

            $status = $request->query('status');
            $tx_ref = $request->query('tx_ref');



            if (paymentStatus($tx_ref) === PENDING) {
                if ($status == "cancelled") {
                    PaymentStatus::where('id', $tx_ref)->update(['status' => CANCELLED]);
                    $message = "PAYMENT CANCELLED !!";
                } else {
                    $trans = PaymentStatus::where('id', $tx_ref)->update(['status' => SUCCESS]);

                    // update user type
                    $user_id = PaymentStatus::where('id', $tx_ref)->value('user_id');

                    User::where('id', $user_id)->update(["user_type" => PAID_USER]);

                    // message
                    $message = "PAYMENT SUCCESSFULL";
                }
            } else {
                // cancel tweaked link payment
                PaymentStatus::where('id', $tx_ref)->update(['status' => CANCELLED]);
                $message = "PAYMENT EXPIRED !!";
            }


            return view('verify_payment')->with([
                "user" => $user,
                "message" => $message,
            ]);
        } else
            return redirect(to: '/logout');
    }
}
