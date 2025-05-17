<?php

namespace App\Services\Repositories;

use App\Models\Student;
use App\Services\Interfaces\StudentInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudentRepository implements StudentInterface
{
    public function getAllStudents()
    {
        return Student::with(['studyProgram' => fn(Builder $query) => $query->select('id', 'name')])
            ->select('study_program_id', 'id', 'name', 'nim')
            ->latest()
            ->get();
    }
    public function getStudentById($id)
    {
        try {
            return Student::with(['studyProgram' => fn(Builder $query) => $query->select('id', 'name')])
                ->select('study_program_id', 'id', 'name', 'nim')
                ->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
    public function getStudentByNim($nim)
    {
        try {
            return Student::where('nim', $nim)->firstOrFail();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function createStudent(array $data)
    {
        return Student::create($data);
    }
    public function updateStudent($id, array $data)
    {
        return $this->getStudentById($id)->update($data);
    }
    public function deleteStudent($id)
    {
        return Student::destroy($id);
    }
}
