<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $primaryKey = 'idRegion';
    protected $keyType = 'string';

    // Permite la asignación masiva
    protected $fillable = ['departamento', 'ubicacion', 'nit'];


    //Relacion uno a muchos inversa companies
    public function companies()
    {
        return $this->belongsTo(Company::class, 'nit', 'nit');
    }

    //Relacion uno a muchos users
    public function users()
    {
        return $this->hasMany(User::class, 'idRegion', 'idRegion');
    }
}
