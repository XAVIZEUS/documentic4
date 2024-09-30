<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table='companies';

    protected $primarykey = 'nit';

    protected $fillable = [
        'nombre'
    ];

    //RELACION UNO A MUCHOS CON REGIONS
    public function regions()
    {
        return $this->hasMany(Region::class, 'nit', 'nit');
    }
}
