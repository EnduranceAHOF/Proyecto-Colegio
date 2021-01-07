<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class App_Controller extends Controller {
    public function logout() {
        //if(Session::has('account')){
            $token = Session::get('account')['token'];
            $response = Http::get("https://accounts.google.com/o/oauth2/revoke?token=$token");
            Session::forget('account');
            Session::forget('periodo');

            sleep(1);
            return redirect('/');
        //}
    }
    public function change_period(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'change_period',
                'data' => ['period' => $gets["year"]]);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            //$data = json_decode($response->body(), true);
            return back();
        }
        else{
            return redirect('/');
        }
    }
    public function add_new_period(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'add_period',
                'data' => ['period' => $gets["year"]]);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            if($response->status() == 400){
                return redirect('adm_periods')->with('message', 'Este periodo ya existe!');
            }
            //$data = json_decode($response->body(), true);
            return back();
        }
        else{
            return redirect('/');
        }
    }
    public function change_staff_status(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'change_staff_status',
                'data' => ['dni' => $gets["dni"]]);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            //$data = json_decode($response->body(), true);
            //dd($arr);
            return back();
        }
        else{
            return redirect('/');
        }
    }
    public function change_staff_admin(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'change_staff_admin',
                'data' => ['dni' => $gets["dni"]]);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            //$data = json_decode($response->body(), true);
            //dd($arr);
            return back();
        }
        else{
            return redirect('/');
        }
    }
    public function add_user(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'add_staff',
                'data' => ['dni' => $gets["dni"],'full_name' => $gets['full_name'],'email' => $gets['email'],'birth_date' => $gets['birth_date']]
            );
            //dd($arr);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            return back();
        }
        else{
            return ('/');
        }
    }    
    public function add_course(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'add_grade',
                'data' => ['grade_id' => $gets["grade_id"],'section' => $gets["letter"]]
            );
            //dd($arr);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            return back();
        }
        else{
            return ('/');
        }
    }    
    public function del_course(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'del_grade',
                'data' => ['id' => $gets["id"]]
            );
            //dd($arr);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            return back();
        }
        else{
            return ('/');
        }
    }    
        

    public function add_student(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'add_student',
                'data' => ['dni' => $gets["dni_stu"],'grade_name' => $gets["grade_name"],'letter' => $gets["letter"],'full_name' => $gets["full_name_stu"],'year' => $gets["year_stu"]]
            );
            dd($arr);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            return back();
        }
        else{
            return ('/');
        }
    }    
    public function del_student(){
        //
    }
    
}
