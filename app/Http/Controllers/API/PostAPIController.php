<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PostAPIController
 */
class PostAPIController extends AppBaseController
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Posts.
     * GET|HEAD /posts
     */
    public function index(Request $request): JsonResponse
    {
        $posts = $this->postRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully');
    }

    /**
     * Store a newly created Post in storage.
     * POST /posts
     */
    public function store(CreatePostAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $post = $this->postRepository->create($input);

        return $this->sendResponse($post->toArray(), 'Post saved successfully');
    }

    /**
     * Display the specified Post.
     * GET|HEAD /posts/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Post $post */
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        return $this->sendResponse($post->toArray(), 'Post retrieved successfully');
    }

    /**
     * Update the specified Post in storage.
     * PUT/PATCH /posts/{id}
     */
    public function update($id, UpdatePostAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Post $post */
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        $post = $this->postRepository->update($input, $id);

        return $this->sendResponse($post->toArray(), 'Post updated successfully');
    }

    /**
     * Remove the specified Post from storage.
     * DELETE /posts/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Post $post */
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        $post->delete();

        return $this->sendSuccess('Post deleted successfully');
    }
}
