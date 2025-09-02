<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Material;

class Grade extends Model
{
    protected $primaryKey = 'id_grade';

    protected $fillable = [
        'name',
        'teacher_id', // si usas un teacher directo
    ];

    // Relación con un teacher principal
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id_user');
    }

    // Relación con varios teachers (tabla pivote grade_teacher)
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'grade_teacher', 'grade_id', 'teacher_id');
    }

    // Relación con estudiantes
    public function students()
    {
        return $this->hasMany(User::class, 'grade_id', 'id_grade')->where('role', 'student');
    }

    // Relación con materiales
    public function materials()
    {
        return $this->hasMany(Material::class, 'grade_id', 'id_grade');
    }

    // Relación con evaluaciones
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'grade_id', 'id_grade');
    }
}
