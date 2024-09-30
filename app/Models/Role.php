<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'idRol';

    protected $fillable = [
        'nombre',
    ];

    //Relacion muchos a muchos con users
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'Rol_id', 'Usuario_id');
    }
}
