<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Http\Resources\VoteResource;
use App\Http\Resources\VoteCollection;
use App\Models\Vote;

class VoteController extends Controller
{
    /**
     * Display a listing of the votes.
     *
     * @return VoteCollection
     */
    public function index()
    {
        $votes = Vote::all();

        return new VoteCollection($votes);
    }

    /**
     * Store a newly created vote in storage.
     *
     * @param  VoteRequest  $request
     * @return VoteResource
     */
    public function store(VoteRequest $request)
    {
        $vote = Vote::create($request->validated());

        return new VoteResource($vote);
    }

    /**
     * Display the specified vote.
     *
     * @param  int  $id
     * @return VoteResource
     */
    public function show($id): VoteResource
    {
        $vote = Vote::findOrFail($id);

        return new VoteResource($vote);
    }

    /**
     * Update the specified vote in storage.
     *
     * @param  VoteRequest  $request
     * @param  int  $id
     * @return VoteResource
     */
    public function update(VoteRequest $request, $id)
    {
        $vote = Vote::findOrFail($id);
        $vote->update($request->validated());

        return new VoteResource($vote);
    }

    /**
     * Remove the specified vote from storage.
     *
     * @param  Vote $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();

        return response()->noContent();
    }
}