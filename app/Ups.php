<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ups extends Model
{
    protected $table = 'ups';

    protected $fillable = [
        'numero_serie',        
        'stato',
        'ip_address'        
    ];
  
    public function locazione()
    {
        return $this->belongsTo(Locazione::class, 'locazione_id');
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