<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class App_Controller extends Controller {
    public function logout() {
            $token = Session::get('account')['token'];
            $response = Http::get("https://accounts.google.com/o/oauth2/revoke?token=$token");
            Session::forget('account');
            Session::forget('periodo');
            sleep(1);
            return redirect('/');
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
                'data' => [               
                    "dni" => $gets["rut"],
                    "names" => $gets["nombres"],
                    "last_f" => $gets["apellido_p"],
                    "last_m" => $gets["apellido_m"],
                    "sex" => $gets["ddlgenero"],
                    "born_date" => $gets["fecha_nac"],
                    "nationality" => $gets["nacionalidad"],
                    "ethnic" => $gets["ddletina"],
                    ]
            );
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            if($response->status()==400){
                return redirect('adm_students')->with('message', 'Este estudiante ya existe!');
            }            
            return back();
        }
        else{
            return ('/');
        }
    }    
    public function del_student(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'del_student',
                'data' => [               
                    "dni" => $gets["dni"],
                    ]
            );
            dd($arr);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            return back();
        }
        else{
            return ('/');
        }
    }
    public function get_info(Request $request){
        $gets = $request->input();
        $rut = $gets["rut"];
        $response = Http::get('https://scc.cloupping.com/get_info/?rut='.$rut);
        return $response->body();
    }
    public function modal_student(Request $request){
        $gets = $request->input();
        $arr = array(
            'institution' => getenv("APP_NAME"),
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'select_student',
            'data' => [               
                "id" => $gets["id"],
                ]
        );
        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        return view("modals/modal_students")->with("stu",$data[0]);
    }
    public function edit_student(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'edit_student',
                'data' => [
                    "id" => $gets["id"],               
                    "dni" => $gets["rut"],
                    "names" => $gets["nombres"],
                    "last_f" => $gets["apellido_p"],
                    "last_m" => $gets["apellido_m"],
                    "sex" => $gets["ddlgenero"],
                    "born_date" => $gets["fecha_nac"],
                    "nationality" => $gets["nacionalidad"],
                    "ethnic" => $gets["ddletina"],
                    ]
            );
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            if($response->status()==400){
                return redirect('adm_students')->with('message', 'Este estudiante ya existe!');
            }            
            return back();
        }
        else{
            return ('/');
        }
    }
    public function add_subject(Request $request){
        if(Session::get('account')['is_admin']=='YES'){
            $gets = $request->input();
            $arr = array(
                'institution' => getenv("APP_NAME"),
                'public_key' => getenv("APP_PUBLIC_KEY"),
                'method' => 'add_matter',
                'data' => ['id' => $gets["idMateria"]]
            );
            //dd($arr);
            $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
            $data = json_decode($response->body(), true);
            if($response->status()==400){
                return redirect('adm_subject')->with('message', 'Esta asignatura ya existe!');
            }  
            //dd($data);
            return back();
        }
        else{
            return ('/');
        }
    }   
}
