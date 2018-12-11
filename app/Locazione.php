<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locazione extends Model
{
    protected $table = 'locazioni';

    protected $fillable = [
        'user_id',
        'regione',
        'indirizzo',
        'citta',
        'provincia',
        'lat',
        'lon'
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ups()
    {
        return $this->hasMany(Ups::class);
    }

    public static function laratablesCustomAction($locazione)
    {
        return view('locazioni.index_action', compact('locazione'))->render();
    }

    public function laratablesIndirizzo()
    {
        return str_limit($this->indirizzo, 40);
    }
  
}
