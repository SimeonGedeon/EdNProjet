<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enseignement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titre',
        'categorie',
        'contenu',
        'image_path',
        'hashtags',
        'est_publie',
        'date_publication',
        'user_id'
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
