<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\Models\UsersApp;
use App\Models\RolUsers;
use App\Models\Menu;
use Flash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      if (auth()->user()->name == 'USUARIO EXTERNO'){
        $rolUser = RolUsers::where('id_user', auth()->user()->id)->first();

        return view('externo.home_app', compact('main', 'rolUser'));
      }
      else{
        return view('home', compact('main'));
      }

    }
}
