<?php

namespace App\View\Components;

use App\Services\Interfaces\HistoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $histories;

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
