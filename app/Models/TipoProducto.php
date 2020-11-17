<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion'];

    public static function createRules() {
        return [
                'descripcion' =>'required|min:3|max:50|unique:tipo_productos,descripcion',
            ];
    }

    public static function updateRules($id) {
        return [
            'descripcion' =>'sometimes|required|min:3|max:50|unique:tipo_productos,descripcion,'.$id,
        ];
    }

    protected $table='tipo_productos';
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
}
