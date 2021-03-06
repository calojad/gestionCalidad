<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcesosRequest;
use App\Http\Requests\UpdateProcesosRequest;
use App\Models\Actividad;
use App\Models\Indicador;
use App\Models\ProcesoRecurso;
use App\Models\Recurso;
use App\Repositories\ProcesosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProcesosController extends AppBaseController
{
    /** @var  ProcesosRepository */
    private $procesosRepository;

    public function __construct(ProcesosRepository $procesosRepo)
    {
        $this->procesosRepository = $procesosRepo;
    }

    /**
     * Display a listing of the Procesos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->procesosRepository->pushCriteria(new RequestCriteria($request));
        if(Auth::user()->role == 2)
            $procesos = $this->procesosRepository->findWhere(['organizacion_id'=>Auth::user()->organizacion_id]);
        else
            $procesos = $this->procesosRepository->all();

        return view('procesos.index')
            ->with('procesos', $procesos);
    }

    /**
     * Show the form for creating a new Procesos.
     *
     * @return Response
     */
    public function create()
    {
        return view('procesos.create');
    }

    /**
     * Store a newly created Procesos in storage.
     *
     * @param CreateProcesosRequest $request
     *
     * @return Response
     */
    public function store(CreateProcesosRequest $request)
    {
        $input = $request->all();

        $procesos = $this->procesosRepository->create($input);

        Flash::success('Procesos saved successfully.');

        return redirect(route('procesos.index'));
    }

    /**
     * Display the specified Procesos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $procesos = $this->procesosRepository->findWithoutFail($id);
        $indicadors = Indicador::where('proceso_id',$procesos->id)->get();
        $procesoRecursos = ProcesoRecurso::where('proceso_id',$procesos->id)->get();
        $actividads = Actividad::where('proceso_id',$procesos->id)->get();
        if (empty($procesos)) {
            Flash::error('Procesos not found');

            return redirect(route('procesos.index'));
        }

        return view('procesos.show',compact('procesos','indicadors','procesoRecursos','actividads'));//->with('procesos', $procesos);
    }

    /**
     * Show the form for editing the specified Procesos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $procesos = $this->procesosRepository->findWithoutFail($id);

        if (empty($procesos)) {
            Flash::error('Procesos not found');

            return redirect(route('procesos.index'));
        }

        return view('procesos.edit')->with('procesos', $procesos);
    }

    /**
     * Update the specified Procesos in storage.
     *
     * @param  int              $id
     * @param UpdateProcesosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProcesosRequest $request)
    {
        $procesos = $this->procesosRepository->findWithoutFail($id);

        if (empty($procesos)) {
            Flash::error('Procesos not found');

            return redirect(route('procesos.index'));
        }

        $procesos = $this->procesosRepository->update($request->all(), $id);

        Flash::success('Procesos updated successfully.');

        return redirect(route('procesos.index'));
    }

    /**
     * Remove the specified Procesos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $procesos = $this->procesosRepository->findWithoutFail($id);

        if (empty($procesos)) {
            Flash::error('Procesos not found');

            return redirect(route('procesos.index'));
        }

        $this->procesosRepository->delete($id);

        Flash::success('Procesos deleted successfully.');

        return redirect(route('procesos.index'));
    }
}
