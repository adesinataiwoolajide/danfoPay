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


    function dOwnnerRounds($vehicle_id){
        return \DB::table('rounds')->where([
            "vehicle_id" => $vehicle_id
        ])->get();
    }
    function dOwnnerMoto($vehicle_id){
        return \DB::table('vehicles')->where([
            "vehicle_id" => $vehicle_id
        ])->get();
    }

    function dOwnnerNego($vehicle_id){
        return \DB::table('negotiations')->where([
            "vehicle_id" => $vehicle_id
        ])->get();
    }

    function negoCustomer($customer_id){
        return \DB::table('customers')->where([
            "customer_id" => $customer_id
        ])->get();
    }
    function negoMani($vehicle_id){
        return \DB::table('manifests')->where([
            "vehicle_id" => $vehicle_id
        ])->get();
    }


?>
