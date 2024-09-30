<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'idRegion', 
        'idOficina', 
        'usuario', 
        'password', 
        'apellidos', 
        'nombres', 
        'ci', 
        'correo',
        'mosca', 
        'cargo', 
        'estado', 
        'celular', 
        'url_foto',
    ];

    //Relacion uno a muchos inversa con regions
    public function region()
    {
        return $this->belongsTo(Region::class, 'idRegion','idRegion');
    }

    //Relacion una a muchos inversa con offices
    public function office()
    {
        return $this->belongsTo(Office::class, 'idOficina', 'idOficina');
    }

    //Relacion muchos a muchos con roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'Usuario_id', 'Rol_id');
    }

    //Relacion una a muchos inversa con jobs
    public function work()
    {
        return $this->belongsTo(Work::class, 'idCargo', 'idCargo');
    }

    // Relacion uno a muchos con make_documents
    public function make_documents()
    {
        return $this->hasMany(Make_document::class, 'idUsuario', 'idUsuario');
    }

    //Relacion uno a muchos coon trackings
    public function roadmaps(){
        return $this->hasMany(Roadmap::class, 'idUsuario', 'idUsuario');
    }

    public function derivadoTrackings()
    {
        return $this->hasMany(Tracking::class, 'derivado_por', 'idUsuario');
    }

    public function derivadoATrackings()
    {
        return $this->hasMany(Tracking::class, 'derivado_a', 'idUsuario');
    }

    // Relacion uno a muchos con items
    public function items()
    {
        return $this->hasMany(Item::class, 'idUsuario', 'idUsuario');
    }	

    //relacion uno  a muchos con folders
    public function folders(){
        return $this->hasMany(Folder::class, 'idUsuario', 'idUsuario');
    }

}
