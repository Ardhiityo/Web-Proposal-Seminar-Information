<?php

namespace App\Services\Repositories;

use App\Models\Lecture;
use App\Models\Student;
use App\Services\Interfaces\StudentInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudentRepository implements StudentInterface
{
    public function getAllStudents()
    {
        return Student::with([
            'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'nidn')
        ])
            ->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id')
            ->latest()
            ->get();
    }

    public function getAllStudentsByKeyword($keyword)
    {
        $keyword = trim($keyword);

        $lecture = Lecture::where('name', 'LIKE', '%' . $keyword . '%')->pluck('id');

        return Student::with([
            'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'nidn')
        ])
            ->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id')
            ->where('name', 'LIKE' . '%' .  $keyword . '%')
            ->orWhere('nim', 'LIKE', '%' . $keyword . '%')
            ->orWhereIn('lecture_1_id', $lecture)
            ->orWhereIn('lecture_2_id', $lecture)
            ->latest()
            ->paginate(perPage: 10);
    }

    public function getAllStudentsByPaginate()
    {
        return Student::with([
            'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'nidn')
        ])
            ->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id')
            ->latest()
            ->paginate(perPage: 10);
    }

    public function getStudentById($id)
    {
        try {
            return Student::with(
                [
                    'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
                    'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
                ]
            )
                ->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id')
                ->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function getStudentByNim($nim)
    {
        try {
            return Student::with([
                'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
                'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            ])
                ->select(
                    'id',
                    'name',
                    'nim',
                    'lecture_1_id',
                    'lecture_2_id',
                )->where('nim', $nim)
                ->firstOrFail();
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

    public function getTotalStudents()
    {
        return Student::count();
    }
}
