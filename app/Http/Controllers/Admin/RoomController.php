<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        if (!Auth::user()->can('create-room')) {
            abort(403, 'Unauthorized action.');
        }

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
        if (!Auth::user()->can('update-room')) {
            abort(403, 'Unauthorized action.');
        }

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
