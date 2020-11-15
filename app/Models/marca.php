<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public static function createRules() {
        return [
                'descripcion' =>'required|min:3|max:50|unique:marcas,descripcion',
            ];
    }

    public static function updateRules($id) {
        return [
            'descripcion' =>'sometimes|required|min:3|max:50|unique:marcas,descripcion,'.$id,
        ];
    }

    protected $table='marcas';

    protected $fillable = ['descripcion'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function getModelos() {
        return $this->hasMany(Modelo::class); 
    }
}
