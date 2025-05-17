<?php

namespace App\Services\Interfaces;

interface HistoryInterface
{
    public function createHistory($keyword);
    public function getHistoryByUser();
}
