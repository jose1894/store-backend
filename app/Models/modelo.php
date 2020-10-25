<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo extends Model
{
    use HasFactory;

    public function marca(){ //$marca->modelo->description
        return $this->belongsTo(Marca::class); //Pertenece a una marca.
    }
}
