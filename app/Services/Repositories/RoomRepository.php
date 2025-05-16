<?php

namespace App\Services\Repositories;

use App\Models\Room;
use App\Services\Interfaces\RoomInterface;

class RoomRepository implements RoomInterface
{
    public function getAllRooms()
    {
        return Room::select('id', 'name')->lates()->get();
    }

    public function getRoomById($id)
    {
        try {
            return Room::select('id', 'name')->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
    public function createRoom(array $data)
    {
        return Room::create($data);
    }
    public function updateRoom($id, array $data)
    {
        return $this->getRoomById($id)->update($data);
    }
    public function deleteRoom($id)
    {
        return Room::destroy($id);
    }
}
