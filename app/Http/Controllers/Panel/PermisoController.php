<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreatePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use App\Repositories\PermisoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Permiso;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class PermisoController extends AppBaseController
{
    /** @var  PermisoRepository */
    private $permisoRepository;


    /** @desc: Constructor de variables globales  **/
    public function __construct(PermisoRepository $permisoRepo)
    {
        $this->permisoRepository = $permisoRepo;
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
     * Display a listing of the Permiso.
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

        $valor = $this->validPermisoMenu(22);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $permisos = $this->permisoRepository->all();

        return view('panel.permisos.index')
            ->with('permisos', $permisos)
            ->with('main',     $main);
    }

    /**
     * Show the form for creating a new Permiso.
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        return view('panel.permisos.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created Permiso in storage.
     *
     * @param CreatePermisoRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreatePermisoRequest $request)
    {
        $input = $request->all();
        $input{'permiso'} = mb_strtoupper($input{'permiso'});

        $permiso = $this->permisoRepository->create($input);

        Flash::success('Permiso guardado con éxito.');

        return redirect(route('permisos.index'));
    }

    /**
     * Display the specified Permiso.
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

        $valor = $this->validPermisoMenu(22);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso not found');

            return redirect(route('permisos.index'));
        }

        return view('panel.permisos.show')
        ->with('permiso', $permiso)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified Permiso.
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

        $valor = $this->validPermisoMenu(22);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        return view('panel.permisos.edit')
        ->with('permiso', $permiso)
        ->with('main',    $main);
    }

    /**
     * Update the specified Permiso in storage.
     *
     * @param int $id
     * @param UpdatePermisoRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
     public function update($id, UpdatePermisoRequest $request)
    {
        $permiso = $this->permisoRepository->find($id);

        $input = $request->all();
        $input{'permiso'} = mb_strtoupper($input{'permiso'});

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        $permiso = $this->permisoRepository->update($input, $id);

        Flash::success('Permiso actualizado con éxito.');

        return redirect(route('permisos.index'));
    }

    /**
     * Remove the specified Permiso from storage.
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
        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        $this->permisoRepository->delete($id);

        Flash::success('Permiso eliminado con éxito.');

        return redirect(route('permisos.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getPermisos(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Permiso)->newQuery()->with('getPermisos');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
        {
          $id    = request()->id;
          $statusUpd = Permiso::find($id);
          $statusUpd ->status_system  = ($statusUpd ->status_system == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }
}
