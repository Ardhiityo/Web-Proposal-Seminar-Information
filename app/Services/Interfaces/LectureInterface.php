<?php

namespace App\Services\Interfaces;

interface LectureInterface
{
    public function getAllLectures();
    public function getAllLecturesByPaginate();
    public function getLectureById($id);
    public function createLecture(array $data);
    public function updateLecture($id, array $data);
    public function deleteLecture($id);
    public function getTotalLectures();
}
