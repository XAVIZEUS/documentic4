<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make_document extends Model
{
    use HasFactory;

    protected $table = 'make_documents';

    // Definir la clave primaria
    protected $primaryKey = 'cite';

    // Definir los atributos que se pueden asignar en masa
    protected $fillable = [
        'idUsuario',
        'idTipo',
        'nombre',
        'depto',
        'fecha',
        'sr',
        'destinatario',
        'cargoDest',
        'referencia',
        'contenido',
        'remitente',
        'cargo',
        'descripcion',
        'mosca',
        'estado',
        'url_ruta',
    ];

    //relacion inversa de usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    public function type(){
        return $this->belongsTo(Type::class, 'idTipo', 'idTipo');
    }
}
