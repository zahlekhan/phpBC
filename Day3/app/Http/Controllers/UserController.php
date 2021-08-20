<?php

namespace App\Http\Controllers;

use App\Models\User\Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $core;

    public function __construct(Core $core)
    {
        $this->core = $core;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->core->all();
        return response([ 'users' => UserResource::collection($users), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

//        $validator = Validator::make($data, [
//            'first' => 'required|max:255',
//            'last' => 'required|max:255',
//        ]);
//
//        if ($validator->fails()) {
//            return response(['error' => $validator->errors(), 'Validation Error']);
//        }

        $user = $this->core->create($data);

        return response(['user' => new UserResource($user), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Entity  $user
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = $this->core->find($id);
        return response(['user' => new UserResource($user), 'message' => 'Retrieved successfully'], 200);
    }

}
