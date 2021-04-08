<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Session;
use Auth;
use Flash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){

      $credentials = $this->validate(request(), [
        'email'    => 'required|string',
        'password'    => 'required|string',
      ],
      [
        'email.required'  => 'Este campo es obligatorio',
        'password.required'  => 'Este campo es obligatorio',
      ]);
      if(Auth::attempt($credentials)){
        if (auth()->user()->name == 'USUARIO EXTERNO'){
          Auth::logout();
          Flash::error('Acceso restringido.');
          return back()
          ->withErrors(['email' => 'Acceso restringido.'])
          ->withInput(request(['email']));
        }

          return redirect()->route('home');
      }
      Flash::error('Error usuario o contraseña no válidos.');

        return back()
        ->withErrors(['password' => 'Error usuario o contraseña no válidos.'])
        ->withInput(request(['email']));

    }

    public function logout() {
      $datosSessionAnt = Session::where('token', auth()->user()->email)->orderby('created_at','DESC')->first();
      if($datosSessionAnt){
        $datosSession =[
        'd_fin' => date('Y-m-d'),
        'h_fin' => date('H:i:s'),
        'id_status_session' => 2
        ];

        $datosSessionAnt->update($datosSession);
      }

      Auth::logout();
      return redirect('/');
    }
}
