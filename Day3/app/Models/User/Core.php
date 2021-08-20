<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Validation\ValidationException;

class Core
{
    protected $repo;

    protected $rules = [
        'email' => 'required|email',
        'name' => 'required|string'
    ];

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     *
     * @param array $attributes
     * @return Entity
     * @throws ValidationException
     */
    public function create(array $attributes)
    {
        $validation = \Validator::make($attributes,$this->rules);
        if ($validation->failed())
        {
            throw new ValidationException($validation);
        }
        return $this->repo->create($attributes);
    }

    public function all()
    {
        return $this->repo->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return Collection
     */
    public function allPosts(int $id)
    {
        $user = $this->find($id);
        return $user->posts;
    }
}
