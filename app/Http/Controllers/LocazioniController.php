<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\Locazione;
use App\User;
use Auth;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Requests\LocazioneRequest;


class LocazioniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->getRoleNames();
        if($role[0] == 'cliente') {
            $locazioni = Locazione::where('user_id', Auth::id())->latest()->paginate(10);
        } else {
            $locazioni = Locazione::latest()->paginate(10);
        }
        return view('locazioni.index',compact('locazioni'));
    }

    public function getLocazioniList()
    {
        $role = Auth::user()->getRoleNames();
        if($role[0] == 'cliente') {
            return Laratables::recordsOf(Locazione::class, function($query)
            {
                return $query->where('user_id', Auth::id())->with('user');
            });
        } else {
            return Laratables::recordsOf(Locazione::class, function($query)
            {
                return $query->with('user');
            });
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clienti = User::role('cliente')->latest()->get();
        return view('locazioni.create', compact('clienti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocazioneRequest $request, Locazione $locazione)
    {
        try {

            $locazione->user_id = $request->cliente;
            $locazione->regione = $request->regione;
            $locazione->provincia = $request->provincia;
            $locazione->citta = $request->citta;
            $locazione->indirizzo = $request->indirizzo;
            $locazione->lat = str_replace(',', '.', $request->lat);
            $locazione->lon = str_replace(',', '.', $request->lon);                         
            $locazione->save();

            flash()->success('Locazione creata!');

        } catch (\Exception $e) {

            flash()->error('Impossibile salvare!');

        }

        return redirect('locazioni');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Locazione $locazioni)
    {
        if($request->ajax()) {
            $locazione_view = view('locazioni.show', compact('locazioni'))->render();
            return response()->json(['viewinfo' => $locazione_view]);
        } else {
            return redirect('locazioni');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Locazione $locazioni)
    {
        $clienti = User::role('cliente')->latest()->get();
        if($request->ajax()) {
            $locazione_view = view('locazioni.edit', compact('locazioni', 'clienti'))->render();
            return response()->json(['viewinfo' => $locazione_view]);
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
    public function update(LocazioneRequest $request)
    {
        try {

            $locazione = Locazione::find($request->segment(2));
            $locazione->user_id = $request->cliente;
            $locazione->regione = $request->regione;
            $locazione->provincia = $request->provincia;
            $locazione->citta = $request->citta;
            $locazione->indirizzo = $request->indirizzo;
            $locazione->lat = str_replace(',', '.', $request->lat);
            $locazione->lon = str_replace(',', '.', $request->lon); 

            $locazione->save();

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

            $locazione = Locazione::findOrFail($id);
            $locazione->delete();

            return response()->json(['viewinfo' =>'Locazione cancellato con successo!']);

        } catch (\Exception $e) {

            return response()->json(['viewinfo' =>'Impossibile cancellare la locazione']);

        }

        return redirect('locazioni');
    }
}
