<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Collection;

class Core
{
    protected $repo;

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $attributes)
    {
        $post = $this->repo->create($attributes);
        return $post;
    }

    public function all()
    {
        $posts = $this->repo->all();
        return $posts;
    }

    public function find(int $id)
    {
        $post = $this->repo->find($id);
        return $post;
    }
}
