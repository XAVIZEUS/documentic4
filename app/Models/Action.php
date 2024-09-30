<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    
    protected $table = 'actions';

    // Definir la clave primaria
    protected $primaryKey = 'idAccion';

    // Definir los atributos que se pueden asignar en masa
    protected $fillable = [
        'nombre',
    ];

    // Relacion uno a muchos con trackings inversa
    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'idAccion', 'idAccion');
    }
}
