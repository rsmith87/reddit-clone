<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Resources\GroupPostCollection;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupCollection;
use App\Models\Group;
use App\Repositories\Eloquent\GroupRepository;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Cache;

class GroupController extends Controller
{
	protected GroupRepository $groupRepository;
	/**
	 * Construct the instance.
	 */
	public function __construct(GroupRepository $groupRepository)
	{
		$this->groupRepository = $groupRepository;
	}

	public function index(): GroupCollection
	{
		$userSettings = Cache::get('user_settings_' . \Auth::id());
		$groups = $this->groupRepository->all();

		return new GroupCollection($groups);
	}

	public function show(Group $group): GroupResource
	{
		return new GroupResource($group);
	}

	public function store(CreateGroupRequest $groupRequest): GroupResource
	{
		$group = $this->groupRepository->create($groupRequest->all());

		return new GroupResource($group);
	}

	public function update(Group $group): GroupResource
	{
		$group = $this->groupRepository->update($group->slug, request()->all());

		return new GroupResource($group);
	}

    public function delete(Group $group): bool
    {
		$this->groupRepository->delete($group);

        return true;
    }

	public function getPostsByGroup(Group $group): GroupPostCollection
	{
		//$userSettings = Cache::get('user_settings_' . \Auth::id());

		$posts = $group->posts()->paginate(10);

		return new GroupPostCollection($posts);
	}
}
