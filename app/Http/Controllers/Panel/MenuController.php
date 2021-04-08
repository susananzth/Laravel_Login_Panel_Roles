<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Repositories\MenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;



/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class MenuController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

    /** @funcion: Se encarga de validar que el usuario tenga permiso en el menu  **/
    public function validPermisoMenu($id_menu) {

      $roles = RolUsers::where('id_user', auth()->user()->id)->get();
      foreach ($roles as $key) {
        /** @desc: Rol -> 1 SuperUser , acceso a todos los menu. **/
        if($key->id_tp_rol == 1){
          return true;
        }
        /** Validamos que el rol contenga el menu disponible **/
        else{
          $menu = RolMenu::where('id_tp_rol', $key->id_tp_rol)->where('id_menu', $id_menu)->first();

          if($menu){
            return true;
          }
        }
      }
      return false;

    }

    /**
     * Display a listing of the Menu.
     *
     * @param Request $request
     *
     * @return Response
     */

     /** @funcion: Vista del listado de consultas realizadas.**/
     public function index(Request $request)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $valor = $this->validPermisoMenu(21);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        return view('panel.menus.index')
        ->with('main',   $main);
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
     public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $section = Menu::WHERE('status_user', '=', 'TRUE')->orderBy('menu', 'ASC')->pluck('menu', 'id');
      $section->prepend("Menú Principal", '0');

      return view('panel.menus.create')
      ->with('section', $section)
      ->with('main',    $main);
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param CreateMenuRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
     public function store(CreateMenuRequest $request)
    {
        $input = $request->all();
        $input{'modified_by'} = auth()->user()->id;

        $menu = $this->menuRepository->create($input);

        Flash::success('Menú guardado con éxito.');

        return redirect(route('menus.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de mostrar los detalles de un usuario especifo **/
     public function show($id)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(21);
      /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        return view('panel.menus.show')
        ->with('main',   $main)
        ->with('menu',   $menu);
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */

     /** @desc: Esta funcion se encraga de editar los datos guardados **/
     public function edit($id)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(21);
      /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $section = Menu::WHERE('status_user', '=', 'TRUE')->orderBy('menu', 'ASC')->pluck('menu', 'id');
      $section->prepend("Menú Principal", '0');

      $menu    = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        return view('panel.menus.edit')
        ->with('section', $section)
        ->with('main',    $main)
        ->with('menu',    $menu);
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int $id
     * @param UpdateMenuRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
     public function update($id, UpdateMenuRequest $request)
    {
        $menu  = $this->menuRepository->find($id);

        $input = $request->all();
        $input{'modified_by'} = auth()->user()->id;

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        $menu = $this->menuRepository->update($input, $id);

        Flash::success('Menú actualizado con éxito.');

        return redirect(route('menus.index'));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de eliminar datos guardados **/
     public function destroy($id)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        $this->menuRepository->delete($id);

        Flash::success('Menú actualizado con éxito.');

        return redirect(route('menus.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getMenus(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Menu)->newQuery();

       if($formulario{'menu'})    { $data = $data->where('menu',    $formulario{'menu'   });}
       if($formulario{'section'}) { $data = $data->where('section', $formulario{'section'});}



       $data = $data->get();


       return response()->json([
         'data' => $data,
       ]);
    }

}
