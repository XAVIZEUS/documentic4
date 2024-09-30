<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';

    // Definir la clave primaria
    protected $primaryKey = 'idSeguimiento';

    // Definir los atributos que se pueden asignar en masa
    protected $fillable = [
        'derivado_por',
        'derivado_a',
        'f_derivacion',
        'f_recepcion',
        'estado',
        'tipo',
        'proveido',
        'observacion',
        'idHruta',
        'idAccion',
        
    ];

    // Definir la relación con el modelo User para derivado_por
    public function derivador()
    {
        return $this->belongsTo(User::class, 'derivado_por', 'idUsuario');
    }

    // Definir la relación con el modelo User para derivado_a
    public function derivadoA()
    {
        return $this->belongsTo(User::class, 'derivado_a', 'idUsuario');
    }

    // Relacion uno a muchos con roadmaps inversa
    public function roadmaps()
    {
        return $this->belongsTo(Roadmap::class, 'idHruta', 'idHruta');
    }

    // Relacion uno a muchos con actions
    public function actions()
    {
        return $this->belongsTo(Action::class, 'idAccion', 'idAccion');
    }

    // Relacion uno a muchos con documents
    public function documents()
    {
        return $this->hasMany(Document::class, 'idSeguimiento', 'idSeguimiento');
    }

    
}
