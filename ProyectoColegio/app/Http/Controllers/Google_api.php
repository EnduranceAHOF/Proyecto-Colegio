<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller\Api_Google;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Google_api extends Controller {

    public function googlelogin() {
        $gClient = new \Google_Client();
        $gClient->setClientId(getenv("GOOGLE_OAUTH_PUBLIC"));
        $gClient->setClientSecret(getenv("GOOGLE_OAUTH_SECRET"));
        $gClient->setApplicationName(getenv("GOOGLE_OAUTH_NAME"));
        $gClient->setRedirectUri("https://cloupping.com/g-response");
        $gClient->setScopes("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");
        $url = $gClient->createAuthUrl();
        header("Location: $url");
    }

    public function login() {
        if (Session::has('account')) {
            return redirect('home');
        } else {
            $scope = 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile';
            $redirect_uri = "http://" . getenv("APP_URL") . '/g-response';
            $auth_url = "https://accounts.google.com/o/oauth2/v2/auth";
            $auth_url .= "?";
            $auth_url .= "scope=$scope&";
            //$auth_url .= "state=$state&";
            $auth_url .= "redirect_uri=$redirect_uri&";
            $auth_url .= "response_type=code&";
            $auth_url .= "client_id=" . getenv("GOOGLE_OAUTH_PUBLIC");
            return redirect($auth_url);
        }
    }

    public function user_data(Request $request) {
        $url = $_SERVER['REQUEST_URI'];
        $allget = parse_url($url, PHP_URL_QUERY);
        $array = explode('&', $allget);
        $code = urldecode(substr($array[0], 5));
        //CURL
        $curl = curl_init();
        $auth_data = array(
            'code' => $code,
            'client_id' => getenv("GOOGLE_OAUTH_PUBLIC"),
            'client_secret' => getenv("GOOGLE_OAUTH_SECRET"),
            'redirect_uri' => "http://" . getenv("APP_URL") . '/g-response',
            'grant_type' => 'authorization_code',
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
        curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        $result = json_decode($result, true);
        if (isset($result['error'])) {
            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach ($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time() - 1000);
                    setcookie($name, '', time() - 1000, '/');
                }
            }
        }
        $token = $result;
        if (isset($token['error'])) {
            return dd($token);
        }
        $access_token = $token['access_token'];
        $url = "https://www.googleapis.com/oauth2/v2/userinfo?fields=name,email,gender,id,picture,verified_email";
        // Init, execute, close curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        $r = curl_exec($ch);
        curl_close($ch);

        //Decode json
        $returned_items = json_decode($r, true);

        // Get lists
        $google_id = $returned_items['id'];
        $google_email = $returned_items['email'];
        $google_name = $returned_items['name'];
        $google_img = $returned_items['picture'];
        $arr = array(
            'institution' => 'Institución Prueba',
            'public_key' => getenv("APP_PUBLIC_KEY"),
            'method' => 'auth',
            'data' => ['email' => $google_email]);

        $response = Http::withBody(json_encode($arr), 'application/json')->post("https://cloupping.com/api-ins");
        $data = json_decode($response->body(), true);
        session::put(['account' => $data]);
        if ($data == null || $data == "") {
            dd($data);
        } else {
            return redirect('home');
        }
        //dd($response->body());
    }

    public function auth_user(Request $request) {
        $data = $request->all();
        return var_dump($data);
    }

}
