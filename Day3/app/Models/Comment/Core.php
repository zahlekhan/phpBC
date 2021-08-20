<?php

namespace App\Models\Comment;

class Core
{
    protected $repo;

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $attributes)
    {
        $comment = $this->repo->create($attributes);
        return $comment;
    }

    public function all(int $postID)
    {
        $comments = $this->repo->all($postID);
        return $comments;
    }

    public function find(int $id)
    {
        $comment = $this->repo->find($id);
        return $comment;
    }

    public function findAllByPost(int $postID)
    {
        $comments = $this->repo->findAllByPost($postID);
        return $comments;
    }

    public function findByPost(int $postID, int $id)
    {
        $comment = $this->find($id);
        if ($comment->getAttribute("post_id") != $postID)
        {
            return NULL;
        }
        return $comment;
    }
}
