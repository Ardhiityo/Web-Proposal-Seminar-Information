<?php

namespace App\Services\Repositories;

use App\Models\Lecture;
use App\Services\Interfaces\LectureInterface;

class LectureRepository implements LectureInterface
{
    public function getAllLectures()
    {
        return Lecture::select('id', 'name', 'phone')->latest()->get();
    }

    public function getLectureById($id)
    {
        try {
            return Lecture::select('id', 'name', 'phone')->findOrFail($id);
        } catch (\Exception $e) {
            return abort(404, 'Lecture not found');
        }
    }

    public function createLecture(array $data)
    {
        return Lecture::create($data);
    }

    public function updateLecture($id, array $data)
    {
        $lecture = $this->getLectureById($id);

        return $lecture->update($data);
    }

    public function deleteLecture($id)
    {
        return Lecture::destroy($id);
    }
}
