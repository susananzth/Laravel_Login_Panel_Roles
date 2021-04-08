<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateTpRolRequest;
use App\Http\Requests\UpdateTpRolRequest;
use App\Repositories\TpRolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
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

class TpRolController extends AppBaseController
{
    /** @var  TpRolRepository */
    private $tpRolRepository;
    private $menu;

    /** @desc: Constructor de variables globales  **/
    public function __construct(TpRolRepository $tpRolRepo)
    {
        $this->tpRolRepository = $tpRolRepo;
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
     * Display a listing of the TpRol.
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

        $valor = $this->validPermisoMenu(28);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpRols = $this->tpRolRepository->all();

        return view('panel.tp_rols.index')
            ->with('tpRols', $tpRols)
            ->with('main',   $main);

    }

    /**
     * Show the form for creating a new TpRol.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

        return view('panel.tp_rols.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created TpRol in storage.
     *
     * @param CreateTpRolRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de mostrar los detalles de un usuario especifo **/
    public function store(CreateTpRolRequest $request)
    {
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $validator = Validator::make($input, [

          'descripcion' => 'required|unique:tp_rols',
        ]);

        if ($validator->fails()) {

            return redirect(route('roles.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $tpRol = $this->tpRolRepository->create($input);

        Flash::success('Rol guardado con éxito.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified TpRol.
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

        $valor = $this->validPermisoMenu(28);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpRol = $this->tpRolRepository->find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }

        return view('panel.tp_rols.show')
        ->with('tpRol',  $tpRol)
        ->with('main',   $main);
    }

    /**
     * Show the form for editing the specified TpRol.
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

        $valor = $this->validPermisoMenu(28);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpRol = $this->tpRolRepository->find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }

        return view('panel.tp_rols.edit')
        ->with('tpRol', $tpRol)
        ->with('main',  $main);
    }

    /**
     * Update the specified TpRol in storage.
     *
     * @param int $id
     * @param UpdateTpRolRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateTpRolRequest $request)
    {
        $tpRol = $this->tpRolRepository->find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $validator = Validator::make($input, [

            'descripcion' => 'required|unique:tp_rols,descripcion,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('roles.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $tpRol = $this->tpRolRepository->update($input, $id);

        Flash::success('Rol se actualizó con éxito.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified TpRol from storage.
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
        $tpRol = $this->tpRolRepository->find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }

        $this->tpRolRepository->delete($id);

        Flash::success('Rol eliminado con éxito');

        return redirect(route('roles.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getTpRols(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new TpRol)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = TpRol::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
