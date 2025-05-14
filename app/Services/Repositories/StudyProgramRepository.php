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
        // Logic to get a study program by ID
    }

    public function createStudyProgram(array $data)
    {
        // Logic to create a new study program
    }

    public function updateStudyProgram($id, array $data)
    {
        // Logic to update an existing study program
    }

    public function deleteStudyProgram($id)
    {
        // Logic to delete a study program
    }
}
