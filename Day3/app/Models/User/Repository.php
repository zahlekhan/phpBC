<?php

namespace App\Models\User;

class Repository
{
    protected $user;

    public function __construct(Entity $user)
    {
        $this->user = $user;
    }

    public function create(array $attributes)
    {
        $user = $this->user->newInstance();
        $user->fill($attributes);
        $user->save();
        return $user;
    }

    public function all()
    {
        $users = $this->user->all();
        return $users;
    }

    public function find(int $id)
    {
        $user = $this->user->newQuery()->findOrFail($id);
        return $user;
    }
}
