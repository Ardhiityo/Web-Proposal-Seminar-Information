<?php

namespace App\Services\Interfaces;

interface AcademicCalendarInterface
{
    public function getAllAcademicCalendars();
    public function createAcademicCalendar($data);
    public function getAcademicCalendarById($id);
    public function updateAcademicCalendar($id, $data);
    public function deleteAcademicCalendar($id);
}
