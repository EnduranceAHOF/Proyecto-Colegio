<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class View_System extends Controller {
    public function main(request $request) {
        $path = $request->path();
        if($this->valSession()){
            switch ($path) {
                case "home":
                    return view('home');
                    break;
                case "adm_periods":
                    if($this->isAdmin()){
                        $periodo = $this->periods();
                        return view('adm_periods')->with("periods",$periodo);
                    }else{
                        return redirect('');
                    }
                case "adm_users":
                    if($this->isAdmin()){
                        return view('adm_users');
                    }else{
                        return redirect('');
                    }
                case "adm_courses":
                    if($this->isAdmin()){
                        return view('adm_courses');
                    }else{
                        return redirect('');
                    }
                case "adm_students":
                    if($this->isAdmin()){
                        return view('adm_students');
                    }else{
                        return redirect('');
                    }
                default:
                return view('not_found')->with("path",$path);
            }
        }else{
            return redirect('');
        }
        
        
    }
    private function valSession(){
        if (Session::has('account')){
            return true;
        }else{
            return false;
        }
    }
    private function isAdmin(){
        if(Session::get('account')['is_admin']=='YES'){
            return true;
        }
        else{
            return false;
        }
    }
    private function periods(){
        $arr = array(
            'institution' => 'Institución Prueba',
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_periods'
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        return $data;
        
    }
}