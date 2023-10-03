<?php

namespace App\Services;

use App\Models\Post;

class PostService {

	/**
	 * 
	 */
	public function storePost(
		string $title,
		string $content
	): Post
	{
		$post = Post::create([
			'title' => $title,
			'content' => $content
		]);

		return $post;
	}
}