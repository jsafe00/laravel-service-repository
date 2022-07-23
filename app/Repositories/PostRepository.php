<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get all posts.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->post::query()->get();
    }

    /**
     * Get post by id
     *
     * @param $id
     *
     * @return Model
     */
    public function getById($id): Model
    {
        return $this->post::query()->findOrFail($id);
    }

    /**
     * Save Post
     *
     * @param $data
     *
     * @return Model
     */
    public function save($data): Model
    {
        $post = new $this->post;
        $post->title = $data[ 'title' ];
        $post->description = $data[ 'description' ];
        $post->save();

        return $post->fresh();
    }

    /**
     * @param $data
     * @param $id
     *
     * @return Model
     * Update Post
     */
    public function update($data, $id): Model
    {
        $post = $this->getById($id);
        $post->title = $data[ 'title' ];
        $post->description = $data[ 'description' ];
        $post->update();

        return $post->refresh();
    }

    /**
     * Delete Post
     *
     * @param $id
     *
     * @return void
     * @throws \Exception
     */
    public function delete($id): void
    {
        $this->getById($id)->delete();
    }

}
