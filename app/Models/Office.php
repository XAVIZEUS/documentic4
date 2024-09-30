<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';
    protected $primaryKey = 'idOficina';
    protected $keyType = 'string';

    protected $fillable = [
        'nombre',
    ];

    //Relacion uno a mucho hacia users
    public function users()
    {
        return $this->hasMany(User::class, 'idOficina', 'idOficina');
    }

    public function roadmaps(){
        return $this->hasOne(Office::class, 'idOficina','idOficina');
    }
}
