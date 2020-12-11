<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class App_Controller extends Controller {

    
    public function logout() {
        Session::forget('account');
        return redirect('');
    }

}
