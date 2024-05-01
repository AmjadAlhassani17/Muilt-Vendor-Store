<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AuthenticateMultiUsername {
    
    public function authenticateUsing($request)
    {
        $username = $request->post(Config::get('fortify.username'));
        $password = $request->post('password');
        
        $user = Admin::where('username', '=', $username)
                    ->Orwhere('email', '=', $username)
                    ->Orwhere('phone_number', '=', $username)->first();
        
        if($user && Hash::check($password, $user->password))
        {
            return $user;
        }

        return false;
    }
}