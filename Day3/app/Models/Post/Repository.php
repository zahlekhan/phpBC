<?php

namespace App\Models\Post;

class Repository
{
    protected $post;

    public function __construct(Entity $post)
    {
        $this->post = $post;
    }

    public function create(array $attributes)
    {
        $post = $this->post->newInstance();
        $post->fill($attributes);
        $post->save();
        return $post;
    }

    public function all()
    {
        $posts = $this->post->all();
        return $posts;
    }

    public function find(int $id)
    {
        $post = $this->post->newQuery()->findOrFail($id);
        return $post;
    }
}
