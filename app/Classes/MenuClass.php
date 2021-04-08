<?php

namespace App\Classes;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Auth;
use View;

class MenuClass{


  public  function getMenu (){
    if(auth()->user()){
      $id = auth()->user()->id;
      $strMenu = '';
      $strMenu .= '';
      $strMenu .= $this->cargarMenu(''.$id, '0', '');
      $strMenu .='';
      return $strMenu;
    }
  }
  public  function getUrl (){
    if(auth()->user()){
      $url = request()->path();
      $url = explode("/",$url);
      $url = $url[0];

      $valor=  Menu::where('users.id', '=', auth()->user()->id)
      ->where('menus.path', 'like', '/'.$url.'%')
      ->join('rol_menus', 'menu.id',                 '=',   'rol_menus.id_menu')
      ->join('tp_rols',   'tp_rols.id',              '=',   'rol_menus.id_tp_rol')
      ->join('rol_users',  'rol_users.id_tp_rol',      '=',   'tp_rols.id')
      ->join('users',     'users.id',                '=',   'rol_users.id_user')
      ->first();

      if($valor != null){
        return true;
      }else{
        return false;
      }

    }
  }

  private function cargarMenu   ($id_user, $id_seccion){
    $strMenu   = '';
    $Menu = $this->getMenuByUser($id_user, $id_seccion);
    foreach ($Menu as $menu) {
      $name       = $menu->menu;
      $url        = $menu->path;
      $icon       = $menu->icon;

      $SubMenu = $this->getMenuByUser($id_user,  $menu->id);

      if ($SubMenu && $url == null){
        $strMenu .= '<a class="nav-link collapsed" href="'.$url.
        '" data-toggle="collapse" data-target="#collapse'.$name.
        '" aria-expanded="false" aria-controls="collapse'.$name.
        '"><div class="nav-link-icon"><i class="fas '.$icon.'"></i></div>'.$name.
        '<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a><div class="collapse" id="collapse'.$name.
        '" data-parent="#accordionSidenav"><nav class="sidenav-menu-nested nav accordion" id="accordionSidenav'.$name.'1">';
                 $strMenu .= $this->cargarMenu($id_user, $menu->id);
                 $strMenu .= '</nav></div>';
         }
         else{

          if($url === 'https://comunidad.winrides.com/' || $url === 'https://comunidad.winrides.com/course/index.php?categoryid=6/'){
            $strMenu .= '<a class="nav-link" target="_blank" href="'.$url.
           '"><div class="nav-link-icon"><i class="fas '.$icon.'"></i></div>'.$name.'</a>';
          }
          else{
            $strMenu .= '<a class="nav-link" href="'.$url.
            '"><div class="nav-link-icon"><i class="fas '.$icon.'"></i></div>'.$name.'</a>';
          }
           
         }
    }
    return $strMenu;
  }

  private function getMenuByUser($id_user, $id_seccion){


    return Menu::where('users.id', '=', $id_user)
    ->where('section',             '=', $id_seccion)
    ->where('menus.status_user',   '=', 'TRUE')
    ->join('rol_menus',  'menus.id',             '=',   'rol_menus.id_menu')
    ->join('tp_rols',    'tp_rols.id',           '=',   'rol_menus.id_tp_rol')
    ->join('rol_users',  'rol_users.id_tp_rol',   '=',   'tp_rols.id')
    ->join('users',      'users.id',             '=',   'rol_users.id_user')
    ->select('menus.id', 'menus.section', 'menus.path', 'menus.menu', 'menus.icon')
    ->orderby('menus.orden', 'asc')
    ->orderby('menus.menu', 'asc')
    ->get();

  }

}
