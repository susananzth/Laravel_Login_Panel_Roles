<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateTpTokenRequest;
use App\Http\Requests\UpdateTpTokenRequest;
use App\Repositories\TpTokenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Tptoken;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;

class TpTokenController extends AppBaseController
{
    /** @var  TpTokenRepository */
    private $tpTokenRepository;

    public function __construct(TpTokenRepository $tpTokenRepo)
    {
        $this->tpTokenRepository = $tpTokenRepo;
    }

    public function validPermisoMenu($id_menu) {

      $roles = RolUsers::where('id_user', auth()->user()->id)->get();
      foreach ($roles as $key) {
        if($key->id_tp_rol == 1){
          return true;
        }
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
     * Display a listing of the TpToken.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $valor = $this->validPermisoMenu(18);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpTokens = $this->tpTokenRepository->all();

        return view('panel.tp_tokens.index')
        ->with('tpTokens', $tpTokens)
        ->with('main',     $main);
    }

    /**
     * Show the form for creating a new TpToken.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      return view('panel.tp_tokens.create')
      ->with('main',   $main);
    }

    /**
     * Store a newly created TpToken in storage.
     *
     * @param CreateTpTokenRequest $request
     *
     * @return Response
     */
    public function store(CreateTpTokenRequest $request)
    {
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $tpToken = $this->tpTokenRepository->create($input);

        return redirect(route('token.index'))
        ->with('status', 'El tipo de token se ha guardado correctamente.');
    }

    /**
     * Display the specified TpToken.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(18);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

        $tpToken = $this->tpTokenRepository->find($id);

        if (empty($tpToken)) {
            Flash::error('Token no encontrado');

            return redirect(route('token.index'));
        }

        return view('panel.tp_tokens.show')
        ->with('tpToken', $tpToken)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified TpToken.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(18);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

        $tpToken = $this->tpTokenRepository->find($id);

        if (empty($tpToken)) {
            Flash::error('Token no encontrado');

            return redirect(route('token.index'));
        }

        return view('panel.tp_tokens.edit')
        ->with('tpToken', $tpToken)
        ->with('main',    $main);

    }

    /**
     * Update the specified TpToken in storage.
     *
     * @param int $id
     * @param UpdateTpTokenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTpTokenRequest $request)
    {
        $tpToken = $this->tpTokenRepository->find($id);

        if (empty($tpToken)) {
            Flash::error('Token no encontrado');

            return redirect(route('token.index'));
        }

        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});


        $tpToken = $this->tpTokenRepository->update($input, $id);

        return redirect(route('token.index'))
        ->with('status', 'El tipo de token se ha actualizado correctamente.');
    }

    /**
     * Remove the specified TpToken from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tpToken = $this->tpTokenRepository->find($id);

        if (empty($tpToken)) {
            Flash::error('Token no encontrado');

            return redirect(route('token.index'));
        }

        $this->tpTokenRepository->delete($id);

        Flash::success('Token eliminado con éxito.');

        return redirect(route('token.index'));
    }
    public function getTpToken(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Tptoken)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = Tptoken::find($id);
          $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }
}
