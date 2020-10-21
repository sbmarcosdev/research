<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginADController extends Controller
{
    public function index()
    {
        //session()->flush();
        return view('login.ad');
    }

    public function auth_ad(Request $request)
    {
        
        if (Login::where('nome', $request->email)->first()) {

            $urlChamada = config('services.api_auth_ad.link') . 'auth/v1/login/';
            $client_id = config('services.api_auth_ad.client_id');
            $Authorization = 'Basic ' . base64_encode(config('services.api_auth_ad.client_id') . ':' . config('services.api_auth_ad.secret'));

            $headers = array(
                'client_id' => $client_id,
                'Authorization' => $Authorization,
                'Content-Type' => 'application/json'
            );

            $body = [];
            $body['grant_type'] = "password";
            $body['username'] = str_replace('@embracon.com.br', '', $request->email);
            $body['password'] = $request->senha;

            $response = Http::withHeaders($headers)->post($urlChamada, $body);

            $status = $response->getStatusCode();

            if ($status == 200) {

                $varSessao = [];
                $varSessao['login_admin'] = $body['username'];
                $request->session()->put(['login_admin' => $varSessao]);
                session()->put([
                    'status_campanha' => '',
                    'titulo_status' => ''
                ]);

                return redirect()->intended('campanhas');
            } else {

                //$request->session()->flush();
                $erro = ["erro" => "Senha Inválida"];
                return view('respostas.erro', compact('erro'));
            }
        } else {

            //$request->session()->flush();
            $erro = ["erro" => "Falha no Login. Tente novamente mais tarde ou procure o Administrador"];
            return view('respostas.erro', compact('erro'));
        }
    }
}
