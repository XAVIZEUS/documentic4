<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    //id
    protected $fillable = ['nombre', 'carpeta_padre_id', 'idUsuario'];


    //relaciones a si mismo
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'carpeta_padre_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'carpeta_padre_id');
    }

    //realcion a muchos items
    public function items()
    {
        return $this->hasMany(Item::class, 'carpeta_padre_id','id');
    }

    //relacion a muchos users inversa
    public function user(){
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

}
