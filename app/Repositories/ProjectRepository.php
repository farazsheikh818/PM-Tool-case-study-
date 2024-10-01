<?php

namespace App\Repositories;

use App\Models\Project;
use App\IRepositories\IProjectRepository;

class ProjectRepository implements IProjectRepository
{
    public function all()
    {
        return Project::all();
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }

    public function create(array $data)
    {
        $validator = \Validator::make($data, [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return Project::create($data);
    }

    public function update($id, array $data)
    {
        $project = $this->find($id);
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        $project = $this->find($id);
        return $project->delete();
    }

    public function paginate($perPage = 10)
    {
        return Project::paginate($perPage);
    }

}
