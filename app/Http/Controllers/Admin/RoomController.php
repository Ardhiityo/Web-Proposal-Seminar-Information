<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\RoomInterface;
use App\Http\Requests\Room\StoreRoomRequest;

class RoomController extends Controller
{

    public function __construct(private RoomInterface $roomRepository) {}

    public function index()
    {
        $rooms = $this->roomRepository->getAllRooms();

        return view('pages.room.index', compact('rooms'));
    }

    public function create()
    {
        return view('pages.room.create');
    }

    public function store(StoreRoomRequest $request)
    {
        $this->roomRepository->createRoom($request->validated());

        Alert::success('Sukses', 'Data Ruangan Berhasil Ditambahkan');

        return redirect()->route('rooms.index');
    }

    public function destroy($id)
    {
        $this->roomRepository->deleteRoom($id);

        Alert::success('Sukses', 'Data Ruangan Berhasil Dihapus');

        return redirect()->route('rooms.index');
    }
}
