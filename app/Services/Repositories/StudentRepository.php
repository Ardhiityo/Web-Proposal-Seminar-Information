<?php

namespace App\Services\Repositories;

use App\Models\Student;
use App\Services\Interfaces\StudentInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudentRepository implements StudentInterface
{
    public function getAllStudents()
    {
        return Student::with(['studyPrograms' => fn(Builder $query) => $query->select('id', 'name')])
            ->select('study_program_id', 'id', 'name', 'nim')
            ->get();
    }
    public function getStudentById($id) {}
    public function createStudent(array $data) {}
    public function updateStudent($id, array $data) {}
    public function deleteStudent($id) {}
}
