<?php

namespace App\Repositories;

/**
* Interface PostRepositoryInterface
* @package App\Repositories
*/
interface PostRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}