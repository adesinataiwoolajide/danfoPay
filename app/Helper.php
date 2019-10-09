<?php
    function balances($user_id){
        return \DB::table('balances')->where([
            "user_id" => $user_id
        ])->first();
    }
    function customers($email){
        return \DB::table('customers')->where([
            "email" => $email
        ])->get();
    }

    function usersList($user_id){
        return \DB::table('users')->where([
            "user_id" => $user_id
        ])->get();
    }
    function opera($vehicle_id){
        return \DB::table('vehicle_operators')->where([
            "vehicle_id" => $vehicle_id
        ])->get();
    }
?>
