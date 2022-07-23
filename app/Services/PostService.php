<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Repositories\PostRepository;
use Exception;

class PostService extends Service
{
    /**
     * @var $postRepository
     */
    protected $postRepository;

    /**
     * PostService constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    /**
     * Get all post.
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $posts = $this->postRepository->getAll();

        return $this->ApiSuccessResponse($posts);
    }

    /**
     * Store to DB if there are no errors.
     *
     * @param $data
     *
     * @return JsonResponse
     */
    public function savePostData($data): JsonResponse
    {
        $post = $this->postRepository->save($data);

        return $this->ApiSuccessResponse($post, 'Post Created Successfully');
    }

    /**
     * Get post by id.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $post = $this->postRepository->getById($id);

        return $this->ApiSuccessResponse($post);
    }

    /**
     * Update post data
     *
     * @param $data
     * @param $id
     *
     * @return JsonResponse
     */
    public function updatePost($data, $id): JsonResponse
    {
        $post = $this->postRepository->update($data, $id);

        return $this->ApiSuccessResponse($post);
    }

    /**
     * Delete post by id.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id): JsonResponse
    {
        $this->postRepository->delete($id);

        return $this->ApiSuccessResponse(null, 'Post Deleted Successfully');
    }

}
