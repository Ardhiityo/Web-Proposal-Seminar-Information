<?php

namespace App\Services\Interfaces;

interface RoomInterface
{
    public function getAllRooms();
    public function getAllRoomsByPaginate();
    public function getRoomById($id);
    public function createRoom(array $data);
    public function updateRoom($id, array $data);
    public function deleteRoom($id);
    public function getTotalRooms();
}
