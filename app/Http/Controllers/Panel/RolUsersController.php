<?php

namespace App\Http\Controllers\Panel;

// use App\Http\Requests\CreateRolUsersRequest;
use App\Http\Requests\UpdateRolUsersRequest;
use App\Repositories\RolUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\UsersApp;
use App\Models\TpRol;
use App\Classes\MenuClass;
use App\Models\Menu;
use App\User;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class RolUsersController extends AppBaseController
{
    /** @var  RolUsersRepository */
    private $rolUsersRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(RolUsersRepository $rolUsersRepo)
    {
        $this->rolUsersRepository = $rolUsersRepo->with('getUsers','getTpRol');
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
     * Display a listing of the RolUsers.
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

        $valor = $this->validPermisoMenu(20);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolUsers = $this->rolUsersRepository->all();

        return view('panel.rol_users.index')
            ->with('rolUsers', $rolUsers)
            ->with('main',     $main);

    }

    /**
     * Show the form for creating a new RolUsers.
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $tpUsersAps = User ::orderBy('email', 'ASC')       ->pluck('email', 'id');
      $tpRols     = TpRol::WHERE  ('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

        return view('panel.rol_users.create')
        ->with('tpUsersAps', $tpUsersAps)
        ->with('tpRols',     $tpRols)
        ->with('main',       $main);

    }

    /**
     * Store a newly created RolUsers in storage.
     *
     * @param CreateRolUsersRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store()
    {
        $input = request()->all();

        $rolUsers = RolUsers::create($input);

        Flash::success('Rol Usuarios se ha guardado correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    /**
     * Display the specified RolUsers.
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

        $valor = $this->validPermisoMenu(20);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }


        $rolUsers = $this->rolUsersRepository->find($id);
        // $rolUsers = (new RolUsers)->newQuery()->find($id)->with('getUsers','getTpRol');
        // $rolUsers = $rolUsers->get();

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        return view('panel.rol_users.show')
        ->with('rolUsers', $rolUsers)
        ->with('main',     $main);

    }

    /**
     * Show the form for editing the specified RolUsers.
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

      $valor = $this->validPermisoMenu(20);
      /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $tpUsersAps = User ::orderBy('email', 'ASC')     ->pluck('email', 'id');
      $tpRols     = TpRol::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

      $rolUsers = $this->rolUsersRepository->find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        return view('panel.rol_users.edit')
        ->with('rolUsers',   $rolUsers)
        ->with('tpUsersAps', $tpUsersAps)
        ->with('tpRols',     $tpRols)
        ->with('main',       $main);

    }

    /**
     * Update the specified RolUsers in storage.
     *
     * @param int $id
     * @param UpdateRolUsersRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateRolUsersRequest $request)
    {
        $rolUsers = $this->rolUsersRepository->find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        $rolUsers = $this->rolUsersRepository->update($request->all(), $id);

        Flash::success('Rol Usuarios se actualizó correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    /**
     * Remove the specified RolUsers from storage.
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
        $rolUsers = $this->rolUsersRepository->find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        $this->rolUsersRepository->delete($id);

        Flash::success('Rol Usuarios se eliminó correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getRolUsers(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new RolUsers)->newQuery()->with('getUsers','getTpRol');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = RolUsers::find($id);
          $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }

}
