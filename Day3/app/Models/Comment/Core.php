<?php

namespace App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class Core
{
    protected $repo;

    protected $rules = [
        'content' => 'required|string',
        'post_id' => 'required|integer'
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

    public function all(int $postID)
    {
        return $this->repo->all($postID);
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function findAllByPost(int $postID)
    {
        return $this->repo->findAllByPost($postID);
    }

    public function findByPost(int $postID, int $id)
    {
        $comment = $this->find($id);
        if ($comment->getAttribute("post_id") != $postID)
        {
            throw new ModelNotFoundException('Comment not found by ID ');
        }
        return $comment;
    }
}
