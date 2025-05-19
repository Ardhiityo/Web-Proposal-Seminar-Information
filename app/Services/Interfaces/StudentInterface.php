<?php

namespace App\Services\Interfaces;

interface StudentInterface
{
    public function getAllStudents();
    public function getAllStudentsByPaginate();
    public function getStudentById($id);
    public function createStudent(array $data);
    public function updateStudent($id, array $data);
    public function deleteStudent($id);
    public function getStudentByNim($nim);
    public function getTotalStudents();
}
