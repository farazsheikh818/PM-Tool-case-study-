<?php

namespace App\IRepositories;

use App\Models\Task;

interface ITaskRepository
{
    public function allByProject($projectId);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function paginateByProject($projectId, $perPage = 10);
}
