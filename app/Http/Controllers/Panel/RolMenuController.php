<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateRolMenuRequest;
use App\Http\Requests\UpdateRolMenuRequest;
use App\Repositories\RolMenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\TpRol;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class RolMenuController extends AppBaseController
{
    /** @var  RolMenuRepository */
    private $rolMenuRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(RolMenuRepository $rolMenuRepo)
    {
        $this->rolMenuRepository = $rolMenuRepo;
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
     * Display a listing of the RolMenu.
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

        $valor = $this->validPermisoMenu(19);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolMenus = $this->rolMenuRepository->all();

        return view('panel.rol_menus.index')
            ->with('rolMenus', $rolMenus)
            ->with('main',     $main);

    }

    /**
     * Show the form for creating a new RolMenu.
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $rols  = TpRol::WHERE('status',      '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
        $menu  = Menu ::WHERE('status_user', '=', 'TRUE')->orderBy('menu',        'ASC')->pluck('menu',        'id');

        return view('panel.rol_menus.create')
        ->with('rols', $rols)
        ->with('main', $main)
        ->with('menu', $menu);

    }

    /**
     * Store a newly created RolMenu in storage.
     *
     * @param CreateRolMenuRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateRolMenuRequest $request)
    {
        $input = $request->all();
        $input{'note'} = mb_strtoupper($input{'note'});

        $rolMenu = $this->rolMenuRepository->create($input);

        Flash::success('Rol Menú guardado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /**
     * Display the specified RolMenu.
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

        $valor = $this->validPermisoMenu(19);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolMenu = $this->rolMenuRepository->find($id);

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        return view('panel.rol_menus.show')
        ->with('rolMenu', $rolMenu)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified RolMenu.
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

        $valor = $this->validPermisoMenu(19);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolMenu = $this->rolMenuRepository->find($id);

        $rols = TpRol::WHERE('status',      '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
        $menu = Menu ::WHERE('status_user', '=', 'TRUE')->orderBy('menu',        'ASC')->pluck('menu',        'id');

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        return view('panel.rol_menus.edit')
        ->with('rolMenu', $rolMenu)
        ->with('rols',    $rols)
        ->with('main',    $main)
        ->with('menu',    $menu);
    }

    /**
     * Update the specified RolMenu in storage.
     *
     * @param int $id
     * @param UpdateRolMenuRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateRolMenuRequest $request)
    {
        $rolMenu = $this->rolMenuRepository->find($id);

        $input = $request->all();
        $input{'note'} = mb_strtoupper($input{'note'});

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        $rolMenu = $this->rolMenuRepository->update($input, $id);

        Flash::success('Rol Menu actualizado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /**
     * Remove the specified RolMenu from storage.
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
        $rolMenu = $this->rolMenuRepository->find($id);

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        $this->rolMenuRepository->delete($id);

        Flash::success('Rol Menú eliminado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getRolMenu(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new RolMenu)->newQuery()->with('getRol','getMenu');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = RolMenu::find($id);
      $statusUpd ->status_system  = ($statusUpd ->status_system == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
