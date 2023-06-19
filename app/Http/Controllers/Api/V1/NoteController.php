<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Api\NoteRequest;
use App\Http\Resources\Api\V1\NoteResource;

class NoteController extends BaseApiController
{

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->model = new Note;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model
            ->paginate(10)
            ->appends(request()->input());

        return NoteResource::collection($data)->additional(['message' => 'Data fetched']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $data = $this->model->create([
            'uuid' => Str::uuid()->toString(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return $this->successResponse(NoteResource::make($data), 'Data stored');
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $data = $this->model->where('uuid', $uuid)->first();

        if (!$data) {
            return $this->errorResponse();
        }

        return $this->successResponse(NoteResource::make($data), 'Data fetched');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, $uuid)
    {
        $data = $this->model->where('uuid', $uuid)->first();

        if (!$data) {
            return $this->errorResponse();
        }

        $data->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $data = $this->model->where('uuid', $uuid)->first();

        return $this->successResponse(
            NoteResource::make($data),
            'Data updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $data = $this->model->where('uuid', $uuid)->first();

        if (!$data) {
            return $this->errorResponse();
        }

        $data->delete();

        return $this->successResponse(
            null,
            'Data deleted'
        );
    }
}
