<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
      'user_id',
      'nome',
      'descrizione',
      'data_creazione',
      'indirizzo',
      'citta',
      'provincia',
      'cap',
      'cellulare',
      'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function laratablesCustomAction($item)
    {
        return view('items.index_action', compact('item'))->render();
    }

    public function laratablesDescrizione()
    {
        return str_limit($this->descrizione, 40);
    }

    public function laratablesDataCreazione()
    {
        return Carbon\Carbon::parse($this->data_creazione)->format('d/m/Y');
    }
    

}
