<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $table = 'roadmaps';

    // Definir la clave primaria
    protected $primaryKey = 'idHruta';

    // Definir los atributos que se pueden asignar en masa
    protected $fillable = [
        'idUsuario',
        'codigo',
        'f_creacion',
        'tipo', //interno o extero
        'estado', //archivado o no
        'referencia',
        'remitente',
        'cargo_remitente',
        'instituto_remitente',
        'idOficina'
    ];

    // Relacion uno a muchos con users inversa, 1 usuario crea una hoja de ruta
    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    // Relacion uno a muchos con trackings
    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'idHruta', 'idHruta');
    }

    public function office(){
        return $this->belongsTo(Office::class, 'idOficina','idOficina');
    }
}
