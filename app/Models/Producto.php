<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "producto";

    protected $fillable = ['codigo','nombre','imagen','descripcion','precio_compra',
                           'precio_venta','modelo_id','undmed_id','categoria_id', 'tipoprod_id'];
    
    protected $hidden = ['created_at','created_by','updated_at', 'updated_by'];

    public static function createRules() {
        return [
            'codigo'       => 'required|min:3|max:25|unique:producto,codigo',
            'nombre'       => 'required|min:3|max:255|unique:producto,codigo,descripcion',
            'modelo_id'    => 'required',
            'categoria_id' => 'required',
            'undmed_id'    => 'required',
            'tipoprod_id'  => 'required',
        ];
    }

    public static function updateRules($id) {
        $producto = self::find($id);
        return [
            'codigo'       => 'required|min:3|max:25|unique:producto,codigo,'.$producto->id,
            'nombre'       => 'required|min:3|max:255|unique:producto,nombre,'.$producto->nombre,
            'modelo_id'    => 'required',
            'categoria_id' => 'required',
            'undmed_id'    => 'required',
            'tipoprod_id'  => 'required',
        ];
    }
                    
    public function getModelo() {
        return $this->belongsTo(Modelo::class);
    }

    public function getUmedida() {
        return $this->belongsTo(UnidadMedida::class);
    }

    public function getCategoria() {
        return $this->belongsTo(Categorias::class);
    }

    public function getTipoProd() {
        return $this->belongsTo(TipoProducto::class);
    }
}
