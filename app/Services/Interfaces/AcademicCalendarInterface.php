<?php

namespace App\Services\Interfaces;

interface AcademicCalendarInterface
{
    public function getAllAcademicCalendars();
    public function createAcademicCalendar($data);
    public function getAcademicCalendarById($id);
    public function updateAcademicCalendar($data, $id);
    public function deleteAcademicCalendar($id);
}
