<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IRepositories\ITaskRepository;
use App\Models\Task;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(ITaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index($projectId, Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
     
        return $this->taskRepository->paginateByProject($projectId, $perPage);
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
        $validator = \Validator::make($data, [
            'project_id' => 'required|exists:projects,id',
            'name'  => 'required|string',
            'description' => 'required|string',
            'status'  => 'required|string',
        ]);
      

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $data['project_id'] = $projectId;
        return $this->taskRepository->create($data);
    }

    public function update(Request $request, $id)
    {
        return $this->taskRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        
        $response =$this->taskRepository->delete($id);
        return response()->json(['message'=> 'Task has been deleted']);
    }

}
