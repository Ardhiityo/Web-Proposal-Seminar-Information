<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\DashboardInterface;

class DashboardController extends Controller
{
    public function __construct(private DashboardInterface $dashboardRepository) {}

    public function index()
    {
        $data = $this->dashboardRepository->getDashboardData();

        return view('pages.dashboard', $data);
    }
}
