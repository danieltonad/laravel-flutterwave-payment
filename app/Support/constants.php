<?php
// User Type

use App\Models\PaymentStatus;
use App\Models\User;
use Faker\Provider\ar_EG\Payment;

// user type
define("ADMIN",0);
define("FREE_USER",1);
define("PAID_USER",2);


// transaction 
define("PENDING","pending");
define("SUCCESS","success");
define("CANCELLED","cancelled");


// user type blade view
function userType($type){
    switch ($type) {
        case ADMIN:
            return "Admin";
            break;
        case FREE_USER:
            return "Free User";
            break;
        case PAID_USER:
            return "Paid User";
            break;
        
        default:
            # code...
            break;
    };
}

// custom auth
function AuthCheck($user){
return User::where('username',"$user")->first();
}

// payment status
function paymentStatus($id){
    return PaymentStatus::where('id',"$id")->value('status');
}
