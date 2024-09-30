<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'description', 'carpeta_padre_id','idUsario'];

    //inversa
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'carpeta_padre_id', 'id');
    }

    //relacion uno a muchos con users inversa
    public function user()
    {
        return $this->belongsTo(User::class, 'idUsario', 'idUsuario');
    }	
}

