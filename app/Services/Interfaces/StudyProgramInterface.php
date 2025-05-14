<?php

namespace App\Services\Interfaces;

interface StudyProgramInterface
{
    public function getAllStudyPrograms();

    public function getStudyProgramById($id);

    public function createStudyProgram(array $data);

    public function updateStudyProgram($id, array $data);

    public function deleteStudyProgram($id);
}
