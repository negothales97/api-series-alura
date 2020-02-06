<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = false;
    protected $fillable = ['temporada', 'numero', 'assistido','serie_id'];
    protected $appends = ['links'];

    public function user()
    {
        return $this->belongsTo('App\Models\Serie');
    }

    public function getAssistidoAttribute($assistido) : bool
    {
        return $assistido;
    }

    public function getLinksAttribute() : array{
        return [
            'serie' => '/api-series/public/api/series/' . $this->serie_id . '/'
        ];
    }
}
