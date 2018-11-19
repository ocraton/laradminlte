<?php

namespace App;

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
}
