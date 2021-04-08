<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateTokenUsersAppRequest;
use App\Http\Requests\UpdateTokenUsersAppRequest;
use App\Repositories\TokenUsersAppRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\TpToken;
use App\Models\TokenUsersApp;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class TokenUsersAppController extends AppBaseController
{
    /** @var  TokenUsersAppRepository */
    private $tokenUsersAppRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(TokenUsersAppRepository $tokenUsersAppRepo)
    {
        $this->tokenUsersAppRepository = $tokenUsersAppRepo->with('getTpToken');
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
     * Display a listing of the TokenUsersApp.
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

        $valor = $this->validPermisoMenu(17);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tokenUsersApps = $this->tokenUsersAppRepository->all();

        return view('panel.token_users_apps.index')
            ->with('tokenUsersApps', $tokenUsersApps)
            ->with('main',           $main);
    }

    /**
     * Show the form for creating a new TokenUsersApp.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $tpTokens = TpToken::where('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->get();
        return view('panel.token_users_apps.create', compact('tpTokens'))
        ->with('main',    $main);
    }

    /**
     * Store a newly created TokenUsersApp in storage.
     *
     * @param CreateTokenUsersAppRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateTokenUsersAppRequest $request)
    {
        $input = $request->all();

        $tokenUsersApp = $this->tokenUsersAppRepository->create($input);

        return redirect(route('token-usuarios-app.index'))
        ->with('status', 'El token de usuario se ha guardado correctamente.');
    }

    /**
     * Display the specified TokenUsersApp.
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

        $valor = $this->validPermisoMenu(17);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tokenUsersApp = $this->tokenUsersAppRepository->find($id);

        if (empty($tokenUsersApp)) {
            Flash::error('Token Usuarios no encontrada');

            return redirect(route('token-usuarios-app.index'));
        }

        return view('panel.token_users_apps.show')
        ->with('tokenUsersApp', $tokenUsersApp)
        ->with('main',          $main);
    }

    /**
     * Show the form for editing the specified TokenUsersApp.
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

        $valor = $this->validPermisoMenu(17);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tokenUsersApp = $this->tokenUsersAppRepository->find($id);

        $tpTokens = TpToken::where('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->get();

        if (empty($tokenUsersApp)) {
            Flash::error('Token Usuarios no encontrada');

            return view('panel.token_users_apps.index');
        }

        return view('panel.token_users_apps.edit', compact('tpTokens', $tpTokens))
        ->with('tokenUsersApp', $tokenUsersApp)
        ->with('main',          $main);
    }

    /**
     * Update the specified TokenUsersApp in storage.
     *
     * @param int $id
     * @param UpdateTokenUsersAppRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateTokenUsersAppRequest $request)
    {
        $main = new MenuClass();
        $main = $main->getMenu();
        $tokenUsersApp = $this->tokenUsersAppRepository->find($id);

        if (empty($tokenUsersApp)) {
            Flash::error('Token Usuarios no encontrada');

            return  view('panel.token_users_apps.index');
        }

        $tokenUsersApp = $this->tokenUsersAppRepository->update($request->all(), $id);

        return redirect(route('token-usuarios-app.index'))
        ->with('status', 'El token de usuario se ha actualizado correctamente.')
        ->with('main', $main);
    }

    /**
     * Remove the specified TokenUsersApp from storage.
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
        $tokenUsersApp = $this->tokenUsersAppRepository->find($id);

        if (empty($tokenUsersApp)) {
            Flash::error('Token Usuarios no encontrada');

            return redirect(route('token-usuarios-app.index'));
        }

        $this->tokenUsersAppRepository->delete($id);

        Flash::success('Token Usuarios eliminado correctamente.');

        return redirect(route('token-usuarios-app.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getTokenUsersApp(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new TokenUsersApp)->newQuery()->with('getTpToken');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }


    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = TokenUsersApp::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }

}
