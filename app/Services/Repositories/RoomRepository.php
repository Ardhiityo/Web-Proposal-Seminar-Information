<?php

namespace App\Services\Repositories;

use App\Models\Room;
use App\Services\Interfaces\RoomInterface;

class RoomRepository implements RoomInterface
{
    public function getAllRooms()
    {
        return Room::select('id', 'name')->get();
    }

    public function getRoomById($id)
    {
        // Logic to get a room by ID
    }
    public function createRoom(array $data)
    {
        return Room::create($data);
    }
    public function updateRoom($id, array $data)
    {
        // Logic to update an existing room
    }
    public function deleteRoom($id)
    {
        return Room::destroy($id);
    }
}
