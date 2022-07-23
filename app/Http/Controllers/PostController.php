<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\PostRequest;

class PostController extends Controller
{
    /**
     * @var postService
     */
    protected $postService;

    /**
     * PostController Constructor
     *
     * @param PostService $postService
     *
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->postService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $post
     *
     * @return JsonResponse
     */
    public function store(PostRequest $post): JsonResponse
    {
        return $this->postService->savePostData($post->only('title', 'description'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->postService->show($id);
    }

    /**
     * Update post.
     *
     * @param PostRequest $post
     * @param             $id
     *
     * @return JsonResponse
     */
    public function update(PostRequest $post, $id): JsonResponse
    {
        return $this->postService->updatePost($post->only('title', 'description'), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id): JsonResponse
    {
        return $this->postService->delete($id);
    }
}
