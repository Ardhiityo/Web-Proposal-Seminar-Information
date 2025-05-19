<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\RoomInterface;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{

    public function __construct(private RoomInterface $roomRepository) {}

    public function index()
    {
        $rooms = $this->roomRepository->getAllRoomsByPaginate();

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

    public function edit($id)
    {
        $room = $this->roomRepository->getRoomById($id);

        return view('pages.room.edit', compact('room'));
    }

    public function update(UpdateRoomRequest $request, $id)
    {
        $this->roomRepository->updateRoom($id, $request->validated());

        Alert::success('Sukses', 'Data Ruangan Berhasil Diperbarui');

        return redirect()->route('rooms.index');
    }

    public function destroy($id)
    {
        $this->roomRepository->deleteRoom($id);

        Alert::success('Sukses', 'Data Ruangan Berhasil Dihapus');

        return redirect()->route('rooms.index');
    }
}
