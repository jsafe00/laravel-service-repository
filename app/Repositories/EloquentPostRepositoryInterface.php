<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

class EloquentPostRepositoryInterface implements PostRepositoryInterface
{
    public function getAll()
    {
        return Post::all();
    }

    public function getById($id)
    {
        return Post::find($id);
    }

    public function save($data)
    {
        return Post::create($data);
    }

    public function update($data, $id)
    {
        return Post::where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return Post::where('id', $id)
            ->delete($id);
    }
}