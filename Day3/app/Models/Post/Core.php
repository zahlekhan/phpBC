<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class Core
{
    protected $repo;

    protected $rules = [
        'user_id' => 'required|integer',
        'title' => 'required|string',
        'body' => 'required|string'
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

    public function find(int $id)
    {
        $post = $this->repo->find($id);
        return $post;
    }
}
