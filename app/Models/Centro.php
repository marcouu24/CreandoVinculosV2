<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;


    protected $table = 'centros';
    public $timestamps = false;
    
    protected $fillable = [
        'id_categoria',
        'nombre',
        'direccion',
        'sector',
        'representante',
        'correo',
        'horario',
        'latitud',
        'longitud',

    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }
}
