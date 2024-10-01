<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\IRepositories\IProjectRepository;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(IProjectRepository $projectRepository)
    {
        
        $this->projectRepository = $projectRepository;
        
    }

    public function index(Request $request)
    {
        if(!$request->ajax()){

            return view('dashboard');
        }
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        return $this->projectRepository->paginate($perPage);
        
    }

    public function show($id, Request $request)
    {
       
        if(!$request->ajax()){
            $project= $this->projectRepository->find($id);
            return view('project-detail', compact('project'));
        }
        return $this->projectRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->projectRepository->create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->projectRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->projectRepository->delete($id);
    }
}
