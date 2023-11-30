<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\Group\GroupCollection;
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

	public function index()
	{
		$userSettings = Cache::get('user_settings_' . \Auth::id());
		$groups = $this->groupRepository->all();

		return new GroupCollection($groups);
	}

	public function store(GroupRequest $groupRequest)
	{
		$group = $this->groupRepository->create($groupRequest->all());

		return new GroupResource($group);
	}

	public function update(string $slug)
	{
		$group = $this->groupRepository->update($slug, request()->all());

		return new GroupResource($group);
	}

    public function delete(int $id = 0): bool
    {
		$this->groupRepository->delete($id);

        return true;
    }

	public function getPostsByGroupSlug(string $slug)
	{
		$group = $this->groupRepository->findBySlug($slug);
		if ( ! $group) {
			return response()->json([
				'message' => 'Group not found',
			], 404);
		}
		$userSettings = Cache::get('user_settings_' . \Auth::id());

		$posts = $group->posts()->paginate($userSettings->paginationSize ?? 10);

		return new PostCollection($posts);
	}
}
