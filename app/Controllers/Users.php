<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function dashboard()
    {
        $user = session('user');
        if (! $user) {
            return redirect()->to('/login');
        }
        return view('dashboard', ['user' => $user]);
    }
}


