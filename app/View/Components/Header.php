<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Services\Interfaces\HistoryInterface;

class Header extends Component
{
    public $histories;
    public $activity;

    /**
     * Create a new component instance.
     */
    public function __construct(private HistoryInterface $historyRepository)
    {
        $this->histories = $historyRepository->getHistoryByUser();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
