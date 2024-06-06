<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $table = "cursos";
    protected $fillable = array("*");

    public function estudiantes(){
        return $this ->belongsToMany(Estudiantes::class, "curso_estudiante");
    }
}
