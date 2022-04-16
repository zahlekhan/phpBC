<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id)
    {
        $user = $this->user->newQuery()->findOrFail($id);
        return $user;
    }

}
