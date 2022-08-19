<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];


    public function Centros(){
        return $this->hasMany(Centro::class, 'id_categoria', 'id');
    }

}
