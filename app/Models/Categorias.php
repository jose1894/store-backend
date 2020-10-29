<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    // Nombre de la tabla en MySQL.
    protected $table='categorias';

    protected $fillable = ['descripcion'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
}
