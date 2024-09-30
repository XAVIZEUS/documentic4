<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $primaryKey = 'idTipo';

    protected $fillable = [
        'nombre',
    ];

    //Relacion uno a muchos make_documets
    public function make_documets(){
        return $this->hasMany(Make_document::class, 'idTipo', 'idTipo');
    }
}
