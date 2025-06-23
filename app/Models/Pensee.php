<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pensee extends Model
{
    protected $fillable = [
        'titre',
        'verset',
        'contenu',
        'hashtags',
        'image_path',
        'est_publie',
        'exhortation',
        'date_publication'
    ];

    protected $casts = [
        'est_publie' => 'boolean',
        'date_publication' => 'datetime'
    ];

    public function scopePensees($query)
    {
        return $query->where('est_publie', true)
                     ->whereNotNull('date_publication')
                     ->orderBy('date_publication', 'desc');
    }
}