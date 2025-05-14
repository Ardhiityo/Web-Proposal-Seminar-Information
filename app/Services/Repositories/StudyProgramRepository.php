<?php

namespace App\Services\Repositories;

use App\Models\StudyProgram;
use App\Services\Interfaces\StudyProgramInterface;

class StudyProgramRepository implements StudyProgramInterface
{
    public function getAllStudyPrograms()
    {
        return StudyProgram::select('id', 'name')->get();
    }

    public function getStudyProgramById($id)
    {
        try {
            return StudyProgram::select('id', 'name')->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function createStudyProgram(array $data)
    {
        return StudyProgram::create($data);
    }

    public function updateStudyProgram($id, array $data)
    {
        // Logic to update an existing study program
    }

    public function deleteStudyProgram($id)
    {
        return StudyProgram::destroy($id);
    }
}
