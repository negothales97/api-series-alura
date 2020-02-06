<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];
    protected $perPage = 3;
    protected $appends = ['links'];

    public function episodios()
    {
        return $this->hasMany('App\Models\Episodio');
    }

    public function getLinksAttribute(): array
    {
        return [
            'episodios' => '/api-series/public/api/series/' . $this->id . '/episodios/',
        ];
    }
}
