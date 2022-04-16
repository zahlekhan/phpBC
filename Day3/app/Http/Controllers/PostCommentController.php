<?php

namespace App\Http\Controllers;

use App\Models\Comment\Core;
use App\Models\Comment\Entity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CommentResource;

class PostCommentController extends Controller
{
    protected $core;

    public function __construct(Core $core)
    {
        $this->core = $core;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $postID
     * @return Response
     */
    public function index(int $postID)
    {
        $comments = $this->core->findAllByPost($postID);
        return response([ 'comments' => CommentResource::collection($comments), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $postID
     * @return Response
     */
    public function store(Request $request,int $postID)
    {
        $data = $request->all();
        $data["post_id"] = $postID;
        $comment = $this->core->create($data);

        return response(['comment' => new CommentResource($comment), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $postID
     * @param int $id
     * @return Response
     */
    public function show(int $postID,int $id)
    {

        $comment = $this->core->findByPost($postID,$id);
        return response(['comment' => new CommentResource($comment), 'message' => 'Retrieved successfully'], 200);
    }
}
