<?php

namespace App\Models\User;

class Core
{
    protected $repo;

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $attributes)
    {
        $user = $this->repo->create($attributes);
        return $user;
    }

    public function all()
    {
        $users = $this->repo->all();
        return $users;
    }

    public function find(int $id)
    {
        $user = $this->repo->find($id);
        return $user;
    }
}
