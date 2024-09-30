<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $table = 'works';
    protected $primaryKey = 'idCargo';

    protected $fillable = [
        'nombre',
    ];

    //Relacion uno a muchos users
    public function users(){
        return $this->hasMany(User::class, 'idCargo', 'idCargo');
    }
}