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
        $gets = $request->input();
        $message = null;
        if(session::has('message')){
            $message = session::get('message');
            //dd($message);
        }
        if($this->valSession()){
            $this->periods();
            switch ($path) {
                case "home":
                    return view('home');
                    break;
                case "adm_periods":
                    if($this->isAdmin()){
                        $periodo = $this->periods();
                        return view('adm_periods')->with("periods",$periodo)->with("message",$message);
                    }else{
                        return redirect('');
                    }
                case "adm_users":
                    if($this->isAdmin()){
                        $staff = $this->staff();
                        return view('adm_users')->with("staff",$staff);
                    }else{
                        return redirect('');
                    }
                case "adm_courses":
                    if($this->isAdmin()){
                        $grades = $this->grades();
                        return view('adm_courses')->with("grades",$grades);
                    }else{
                        return redirect('');
                    }
                case "adm_students":
                    if($this->isAdmin()){
                        $students = $this->students();
                        return view('adm_students')->with("students",$students)->with("message",$message);
                    }else{
                        return redirect('');
                    }
                case "adm_teachers":
                    if($this->isAdmin()){
                        //$students = $this->students();
                        //->with("students",$students)->
                        return view('adm_teachers')->with("message",$message);
                    }else{
                        return redirect('');
                    }
                case "adm_subject":
                    if($this->isAdmin()){
                        $subject = $this->subject_list();
                        $subject_current = $this->subject_current_list();                        
                        return view('adm_subject')->with("subject_list",$subject)->with("subject_current_list",$subject_current)->with("message",$message);
                    }else{
                        return redirect('');
                    }
                default:
                return view('not_found')->with("path",$path);
            }
        }else{
            return redirect('/logout');
        }
    }
    private function valSession(){
        if (Session::has('account')){
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'val_session_staff',
                'data' => ['dni' => Session::get('account')['dni']]);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            $status = $response->json()['status'];
            if($status == false){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }      
    }
    private function isAdmin(){
        if(Session::get('account')['is_admin']=='YES'){
            return true;
        }else{
            return false;
        }
    }
    private function periods(){
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_periods'
        );

        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        if($data["active_period"] != ''){
            Session::put(['period' => $data["active_period"]] );
        }
        else{
            Session::put(['period' => null] );
        }
        return $data;       
    }
    private function staff(){
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_staff'
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        return $data;       
    }
    private function grades(){
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_grades'
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        //dd($data);
        return $data;       
    }
    private function students(){
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_students'
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        //dd($data);
        return $data;       
    }
    private function subject_list(){
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_all_matters'
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        //dd($data);
        return $data;       
    }
    private function subject_current_list(){
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'list_matters_in'
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        //dd($data);
        return $data;
    }
    
}

