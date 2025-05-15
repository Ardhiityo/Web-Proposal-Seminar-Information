<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Services\Interfaces\AcademicCalendarInterface;

class Sidebar extends Component
{
    public $academicCalendars;

    /**
     * Create a new component instance.
     */
    public function __construct(private AcademicCalendarInterface $academicCalendarRepository)
    {
        $this->academicCalendars = $this->academicCalendarRepository->getAllAcademicCalendars();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
