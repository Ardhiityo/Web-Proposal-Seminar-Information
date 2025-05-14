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
        try {
            return Lecture::findOrFail($id);
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
        return Lecture::find($id)->update($data);
    }

    public function deleteLecture($id)
    {
        return Lecture::destroy($id);
    }
}
