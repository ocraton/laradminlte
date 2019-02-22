<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ups extends Model
{
    protected $table = 'ups';

    protected $fillable = [
        'numero_serie',        
        'stato',
        'ip_address',
        'modello',
        'alarm_detail'        
    ];
  
    public function locazione()
    {
        return $this->belongsTo(Locazione::class, 'locazione_id');
    }

    public static function laratablesCustomAction($ups)
    {
        return view('ups.index_action', compact('ups'))->render();
    }

}
