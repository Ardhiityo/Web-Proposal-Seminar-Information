<?php

namespace App\Services\Repositories;

use App\Models\User;
use App\Services\Interfaces\UserInterface;

class UserRepository implements UserInterface
{
    public function getUserById($id)
    {
        return User::select('name', 'email', 'password')->findOrFail($id);
    }
}
