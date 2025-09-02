<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'grade_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con su grade (si es estudiante)
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id_grade');
    }

    // Scope para filtrar solo estudiantes
    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    // Relación con notas del estudiante
    public function studentGrades() 
    {
        return $this->hasMany(StudentGrade::class, 'user_id');
    }

    // Relación para profesores: todos los grados que dictan
public function grades()
{
    return $this->belongsToMany(
        Grade::class, 
        'grade_teacher', 
        'teacher_id', 
        'grade_id'
    );
}


}
