<?php

namespace App\Models\Comment;

class Repository
{
    protected $comment;

    public function __construct(Entity $comment)
    {
        $this->comment = $comment;
    }

    public function create(array $attributes)
    {
        $comment = $this->comment->newInstance();
        $comment->fill($attributes);
        $comment->save();
        return $comment;
    }

    public function find(int $id)
    {
        $comment = $this->comment->newQuery()->findOrFail($id);
        return $comment;
    }

    public function findAllByPost(int $postID)
    {
        $comments = $this->comment->where("post_id",$postID)->get();
        return $comments;
    }
}
