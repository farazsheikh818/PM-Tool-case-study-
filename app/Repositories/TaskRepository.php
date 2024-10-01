<?php

namespace App\Repositories;

use App\Models\Task;
use App\IRepositories\ITaskRepository;

class TaskRepository implements ITaskRepository
{
    public function allByProject($projectId)
    {
        return Task::where('project_id', $projectId)->get();
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = $this->find($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
       
        $task = Task::findOrFail($id); 
        return $task->delete();
     
       
    }
    public function paginateByProject($projectId, $perPage = 10)
    {
        return Task::where('project_id', $projectId)->paginate($perPage);
    }


}
