<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\Ups;
use App\User;
use App\Locazione;
use Validator;
use Auth;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Requests\UpsRequest;

class UpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ups = Ups::latest()->paginate(10);
        return view('ups.index', compact('ups'));
    }

    public function getUpsList()
    {
        return Laratables::recordsOf(Ups::class, function($query)
        {
            return $query->with('locazione');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locazioni = Locazione::latest()->with('user')->get();
        return view('ups.create', compact('locazioni'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsRequest $request, Ups $ups)
    {
        try {

            $ups->locazione_id = $request->locazione;
            $ups->numero_serie = $request->numero_serie;
            $ups->ip_address = $request->ip_address;
            $ups->modello = $request->modello;
            $ups->stato = $request->stato;
            $ups->save();

            flash()->success('Ups creato!');

        } catch (\Exception $e) {

            flash()->error('Impossibile salvare!');

        }

        return redirect('ups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ups $ups)
    {
        if($request->ajax()) {
            $ups_view = view('ups.show', compact('ups'))->render();
            return response()->json(['viewinfo' => $ups_view]);
        } else {
            return redirect('ups');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInfo(Request $request, Ups $ups)
    {
        if($request->ajax()) {
            $ups_view = view('ups.getinfo', compact('ups'))->render();
            return response()->json(['viewinfo' => $ups_view]);
        } else {
            if($ups) return view('ups.infopin', compact('ups'));
            else return redirect('ups');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ups $ups)
    {
        $locazioni = Locazione::latest()->with('user')->get();
        if($request->ajax()) {
            $ups_view = view('ups.edit', compact('ups', 'locazioni'))->render();
            return response()->json(['viewinfo' => $ups_view]);
        } else {
            return redirect('locazioni');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpsRequest $request)
    {
        try {

            $ups = Ups::find($request->segment(2));
            $ups->locazione_id = $request->locazione;
            $ups->numero_serie = $request->numero_serie;
            $ups->ip_address = $request->ip_address;
            $ups->modello = $request->modello;
            $ups->stato = ($request->stato == '') ? -1 : $request->stato;
            $ups->save();

            return response()->json(['viewinfo' => 'Salvato!']);

        } catch (\Exception $e) {

            return response()->json(['viewinfo' => 'Error']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $ups = Ups::findOrFail($id);
            $ups->delete();

            return response()->json(['viewinfo' =>'Ups cancellato con successo!']);

        } catch (\Exception $e) {

            return response()->json(['viewinfo' =>'Impossibile cancellare Ups']);

        }

        return redirect('ups');
    }

    /**
     * Refresh Map.
     */
    public function refreshmap($keyp)
    {
        $urlParam = [
            'keyp' => $keyp
        ];
		$validator = Validator::make($urlParam, [
            'keyp' => 'required'
        ]);

		if ($validator->fails() && $keyp != '(K.e223ef£74H0') {
				return -1;
        }

        broadcast(new \App\Events\UpsStatusUpdated());
        return 'ok';
    }

}
