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
?>
