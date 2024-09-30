<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    // Definir la clave primaria
    protected $primaryKey = 'idDocumento';

    // Definir los atributos que se pueden asignar en masa
    protected $fillable = [
        'idSeguimiento',
        'nombre',
        'f_creacion',
        'url_ruta',
    ];

    // Relacion uno a muchos con trancking inversa
    public function tracking()
    {
        return $this->belongsTo(Tracking::class, 'idSeguimiento', 'idSeguimiento');
    }
}
