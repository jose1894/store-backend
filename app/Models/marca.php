<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table='marcas';

    protected $fillable = ['descripcion'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function getModelos() {
        return $this->hasMany(Modelo::class); 
    }
}
