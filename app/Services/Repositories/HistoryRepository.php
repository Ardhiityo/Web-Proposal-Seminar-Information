<?php

namespace App\Services\Repositories;

use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\HistoryInterface;

class HistoryRepository implements HistoryInterface
{
    public function createHistory($keyword)
    {
        if (!$this->checkHistoryAlreadyExists($keyword)) {
            return History::create([
                'user_id' => Auth::user()->id,
                'keyword' => $keyword
            ]);
        }
    }

    public function checkHistoryAlreadyExists($keyword)
    {
        return History::where('keyword', $keyword)->exists();
    }

    public function getHistoryByUser()
    {
        $userId = Auth::user()->id;

        return History::select('keyword')->where('user_id', $userId)
            ->latest()->take(3)->select('keyword')->get();
    }
}
