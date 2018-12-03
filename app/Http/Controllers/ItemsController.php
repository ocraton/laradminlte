<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\Item;
use Auth;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Requests\ItemRequest;



class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $items = Item::latest()->paginate(10);
        return view('items.index',compact('items'));
    }

    public function getItemList() 
    {
        return Laratables::recordsOf(Item::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, Item $item)
    {

        // try {
            
            $item->user_id = Auth::id();
            $item->nome = $request->nome;            
            $item->descrizione = $request->descrizione;
            $item->data_creazione = Carbon\Carbon::parse($request->data_creazione)->format('Y-m-d H:i:s');
            $item->indirizzo = $request->indirizzo;
            $item->citta = $request->citta;
            $item->provincia = $request->provincia;
            $item->cap = $request->cap;
            $item->cellulare = $request->cellulare;
            $item->email = $request->email;
            $item->save();
        
            flash()->success('Item created!');          

        // } catch (\Exception $e) {

        //     flash()->error('Impossibile salvare!');

        // }

        return redirect('items');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Item $item)
    {      
        if($request->ajax()) {
            $items_view = view('items.show', compact('item'))->render();
            return response()->json(['viewinfo' => $items_view]); 
        } else {
            return redirect('items');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item  $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item  $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item  $item)
    {
        //
    }
}
