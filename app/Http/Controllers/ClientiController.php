<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\User;
use Auth;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ClienteRequest;

class ClientiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienti = User::role('cliente')->latest()->paginate(10);
        return view('clienti.index',compact('clienti'));
    }

    public function getClientiList() 
    {
        return Laratables::recordsOf(User::class, function($query)
        {
            return $query->role('cliente');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clienti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request, User $cliente)
    {
        try {

            $cliente->username = $request->username;            
            $cliente->ragione_sociale = $request->ragione_sociale;            
            $cliente->password = Hash::make($request->password);
            $cliente->save();
            $cliente->assignRole('cliente');

            flash()->success('Cliente creato!');          

        } catch (\Exception $e) {

            flash()->error('Impossibile salvare!');

        }

        return redirect('clienti');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User $clienti
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $clienti)
    {      
        if($request->ajax()) {
            $clienti_view = view('clienti.show', compact('clienti'))->render();
            return response()->json(['viewinfo' => $clienti_view]); 
        } else {
            return redirect('clienti');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $clienti)
    {
        if($request->ajax()) {
            $clienti_view = view('clienti.edit', compact('clienti'))->render();
            return response()->json(['viewinfo' => $clienti_view]); 
        } else {
            return redirect('clienti');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request)
    {
        try {
            
            $cliente = User::find($request->segment(2));
            $cliente->ragione_sociale = $request->ragione_sociale;
            $cliente->username = $request->username;
            if($request->password != ''){
                $cliente->password = Hash::make($request->password);
            }                        
            $cliente->save();
            
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

            $cliente = User::findOrFail($id);
            $cliente->delete();

            return response()->json(['viewinfo' =>'Cliente cancellato con successo!']);          

        } catch (\Exception $e) {

            return response()->json(['viewinfo' =>'Impossibile cancellare il cliente']);

        }

        return redirect('clienti');
    }


}
