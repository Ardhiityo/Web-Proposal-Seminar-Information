<?php

namespace App\Services\Repositories;

use App\Models\Lecture;
use App\Services\Interfaces\LectureInterface;

class LectureRepository implements LectureInterface
{
    public function getAllLectures()
    {
        return Lecture::select('id', 'name', 'phone')->get();
    }

    public function getLectureById($id)
    {
        // Implementation to get a lecture by ID
    }

    public function createLecture(array $data)
    {
        // Implementation to create a new lecture
    }

    public function updateLecture($id, array $data)
    {
        // Implementation to update a lecture
    }

    public function deleteLecture($id)
    {
        // Implementation to delete a lecture
    }
}
