<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\HistoryInterface;

class HistoryController extends Controller
{
    public function __construct(private HistoryInterface $historyRepository) {}

    public function destroy()
    {
        $this->historyRepository->deleteAllHistories();

        Alert::success('Sukses', text: 'Riwayat Berhasil Dihapus');

        return Redirect::route('profile.edit');
    }
}
