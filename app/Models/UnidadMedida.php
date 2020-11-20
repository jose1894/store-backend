<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $table = "unidad_medida";

    protected $fillable = ['descripcion'];

    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public static function createRules() {
        return [
                'descripcion' =>'required|min:3|max:50|unique:unidad_medida,descripcion',
            ];
    }

    public static function updateRules($id) {
        return [
            'descripcion' =>'sometimes|required|min:3|max:50|unique:unidad_medida,descripcion,'.$id,
        ];
    }
}
