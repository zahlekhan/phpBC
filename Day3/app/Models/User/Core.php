<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User;

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

    /**
     * Display a listing of the resource.
     *
     * @return Entity
     */
    public function find(int $id)
    {
        $user = $this->repo->find($id);
        return $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function allPosts(int $id)
    {
        $user = $this->find($id);
        $userPosts = $user->posts;
        return $userPosts;
    }
}
