<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'idCliente';

    protected $fillable = [
        'nombre',
        'cargo',
        'institucion',
        'telefono',
        'ciudad',
        'direccion',
    ];
}
